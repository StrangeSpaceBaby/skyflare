<?php

use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use GuzzleHttp\Psr7;

class _doc extends _obj
{
	private string $storage_bucket;
	private string $storage_access_key;
	private string $storage_private_key;
	private object $credentials;
	private object $client;


	public function __construct()
	{
		parent::__construct( '_doc' );

		$this->setup();
	}

	/**
	 * Returns the SUM from _doc_library.
	 * 
	 * @TODO Needs to include only active
	 * @return float library size in mbytes
	 */
	public function get_doc_library_size() : float
	{
		$size = $this->get_by_col( [], FALSE, TRUE, [], 'SUM( _doc_size ) AS _doc_lib_size' );
		return $size['_doc_lib_size'];
	}

	/**
	 * Streams file content
	 *
	 * @param integer $doc_id
	 * @return mixed If the document is downloaded returns void, FALSE on error
	 */
	public function download( int $doc_id ) : mixed
	{
		$doc = $this->get_by_id( $doc_id );

		$stream = fopen( 's3://' . $this->storage_bucket . "/" . $doc['_doc_s3_loc'], 'r' );
		if( $stream )
		{
			header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
			header( 'Content-Description: File Transfer' );
			header( 'Content-Type: ' . $doc['_doc_type'] );
			header( "Content-Disposition: attachment; filename=" . htmlentities( $doc['_doc_orig_name'] ) );
			header( "Pragma: public" );
			header( "Expires: 0" );

			while( !feof( $stream ) )
			{
				echo fread( $stream, 1024 );
			}

			fclose( $stream );
			exit;
		}
		else
		{
			$this->fail( 'failed_to_open_download_stream' );
			return FALSE;
		}
	}

	/**
	 * If there is content in the $vars, it is pushed all at once from memory.
	 *
	 * @deprecated
	 * @param array $vars doc_name, doc_Content
	 * @return void
	 */
	public function download_content( array $vars ) : void
	{
		header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header( 'Content-Description: File Transfer' );
		header( 'Content-Type: text/plain' );
		header( "Content-Disposition: attachment; filename=" . $vars['doc_name'] );
		header( "Pragma: public" );
		header( "Expires: 0" );

		echo $vars['doc_content'];
		exit;
	}

	/**
	 * Fails if no _doc_id is given; otherwise, unsets _doc_hash and _doc_orig_name
	 * and calls parent::save(). DOES NOT UPLOAD NEW DOC
	 *
	 * @param array $vars _doc*
	 * @return integer _doc_id
	 */
	public function update( array $vars ) : int|bool
	{
		if( !$vars['_doc_id'] )
		{
			$this->fail( 'no_doc_id_given_to_update' );
			return FALSE;
		}

		unset( $vars['_doc_hash'] );
		unset( $vars['_doc_orig_name'] );

		return parent::save( $vars );
	}

	/**
	 * Adds uploader_id before calling parent::save()
	 *
	 * @param array $vars
	 * @return boolean|integer
	 */
	public function save( array $vars ) : bool|int
	{
		$_mem = new _mem();
		$vars['fk_uploader__mem_id'] = $_mem->me( '_mem_id' );

		return parent::save( $vars );
	}

	/**
	 * Creates AWS client and returns $this
	 *
	 * @return object $this
	 */
	protected function setup() : object
	{
		$_setting = new _setting();
		$this->storage_access_key = $_setting->get_by_col([ '_setting_key' => 'storage_access_key' ])['_setting_value'];
		$this->storage_private_key = $_setting->get_by_col([ '_setting_key' => 'storage_private_key' ])['_setting_value'];
		$this->storage_bucket = $_setting->get_by_col([ '_setting_key' => 'storage_bucket' ])['_setting_value'];

		$this->credentials = new Aws\Credentials\Credentials( $this->storage_access_key, $this->storage_private_key );
		$this->client = new Aws\S3\S3Client([
			'version' => 'latest',
			'region' => 'us-east-2',
			'credentials' => $this->credentials
		]);

		$this->client->registerStreamWrapper();

		return $this;
	}

	/**
	 * Sends document to S# using LazyStream.
	 *
	 * @param array $vars
	 * @return string|boolean
	 */
	public function store( array $vars ) : string|bool
	{
		if( !$vars['fk__mem_id'] )
		{
			$_mem = new _mem();
			$vars['fk__mem_id'] = $_mem->me( '_mem_id' );
		}

		$related = $_mem->get_by_col([ '_mem_id' => $vars['fk__mem_id'] ], FALSE, TRUE, [], '_mem_id, _mem_ulid' );

		$vars['related__mem_ulid'] = $related['_mem_ulid'];

		try
		{
			$stream = new Psr7\LazyOpenStream( $vars['tmp_name'], 'r' );
			$now = new DateTime();
			$key = $vars['related__mem_ulid'] . "/" . $now->format( 'U.u' ) . '-' . $vars['name'];

			$result = $this->client->putObject([
				'Bucket'		=> $this->storage_bucket,
				'Key'			=> $key,
				'Body'			=> $stream,
				'ContentLength'	=> $vars['size'],
				'ContentDisposition' => $vars['name']
			]);

			$this->success( 'file_stored' );
			return $key;
		}
		catch( Exception $e )
		{
			error_log( 'doc store error' );
			error_log( $e );

			$this->fail( 'aws_failure' );
			return FALSE;
		}
	}
}
