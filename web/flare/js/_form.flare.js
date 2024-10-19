/*
 * _form.js - Sophisticated flare for creating, validating and saving form data
 * 
 * Copyright (c) 2024 Greg Strange
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, subject to
 * including this permission notice in all copies or substantial portions
 * of the Software.
 */

class _form
{
	constructor( _opts )
	{
		// Should have a form_id at the minimum
		new _log( '_form constructor' );
		new _log( _opts );

		let _defaults = { form_id: null, autoform: false };
		this.opts = { ..._defaults, ..._opts };

		new _log( '_form constructor opts' );
		new _log( this.opts );

		this.setup();
	}

	autoform()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				let _selector = 'form.autoform';
				if( $this.opts.autoform )
				{
					_selector = $this.opts.form_id;
				}

				new _log( 'autoform selector ' + _selector );
				$( _selector ).each(
					( _index, _elem ) =>
					{
						new _log( 'elem' );
						new _log( _elem );
						new _log( $( _elem ) );

						// These two lines allow for a dynamic setting of the form input and to use a generic form container
						let _formId = $( _elem ).attr( 'data-form-input-id' ) ? $( _elem ).attr( 'data-form-input-id' ) : $( _elem ).attr( 'id' );
						let _formSelector = $( _elem ).attr( 'id' );

						new _log( 'autoform ' + _selector + ' formId -->' + _formId );
						new _api({ url: '/_valid_field/form_fields/' + _formId }).poll().then(
							( _ret ) =>
							{
								if( 1 == _ret.return )
								{
									new _log( 'autoform success' );

									new _log('#' + _formSelector + '_fields');
									let _cFormFields = $( '#' + _formSelector + '_fields' );
									_cFormFields.empty();

									if( 0 == _ret.count )
									{
										_cFormFields.html( 'No fields to display' );
									}
									else
									{
										for( let _i in _ret.data )
										{
											let _field = _ret.data[_i];
											new _log( _field );
											let _fieldHtml = '';
											let _fieldLabel = '';
											let _table = '';
											if( !_field.default )
											{
												_field.default = '';
											}

											switch( _field.type )
											{
												case 'textarea':
													_fieldLabel = '<label for="' + _field.id + '">' + _field.name + '</label>';
													_fieldHtml = '<textarea name="' + _field.name + '" id="' + _field.id + '" class="form-control';
													if( _field.required )
													{
														_fieldHtml += " required";
													}
													_fieldHtml += '">' + _field.default + '</textarea>';

													break;
												case 'email':
												case 'password':
												case 'hidden':
												case 'date':
												case 'datetime-local':
												case 'number':
												case 'text':
													if( 'hidden' != _field.type )
													{
														_fieldLabel = '<label for="' + _field.id + '">' + _field.name + '</label>';
													}
													_fieldHtml = '<input type="' + _field.type + '" name="' + _field.name + '" id="' + _field.id + '" value="' + _field.default + '" class="form-control';
													if( _field.required )
													{
														_fieldHtml += " required";
													}
													_fieldHtml += '" />';
													break;
												case 'checkbox':
													_fieldLabel = '<label for="' + _field.id + '" class="form-check-label">' + _field.name + '</label><br />';
													if( !_field.default )
													{
														_field.default = 1;
													}

													_fieldHtml = '<input type="checkbox" name="' + _field.name + '" id="' + _field.id + '" value="' + _field.default + '" class="form-check-input';
													if( _field.required )
													{
														_fieldHtml += " required";
													}
													_fieldHtml += '" />';
													break;
												case 'select':
													new _log( 'select autoform' );
													new _log( _field );
													_table = _field.name.split( '_' );
													if( 'fk' == _table.shift() && 'id' == _table.pop() )
													{
														_table = _table.join( '_' );
													}

													_fieldLabel = '<label for="' + _field.id + '"><a href="javascript:void(0);" onClick="new _loader({}).load( \'' + _field.id + '\' );">' + _field.name + '</a></label>';
													_fieldHtml = '<select name="' + _field.name + '" id="' + _field.id + '" class="form-control">';
													_fieldHtml += '<option value="" class="keep">Select</option></select>';
													_fieldHtml += '<template id="' + _field.id + '_tpl"><option value="~~' + _table + '_id~~">~~' + _table + '_name~~</option></template>';
													break;
											}

											_cFormFields.append( '<div class="form-row">' + _fieldLabel + ' ' + _fieldHtml + '</div>' );
											if( 'select' == _field.type && _field.src )
											{
												new _loader({ src: _field.src, tpl: _field.id + '_tpl', populate: _field.id }).load( _field.id );
											}
										}
									}
								}
							}
						);
					}
				);
				return _success( 'autoformed' );
			}
		);
	}

	popForm()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				let _formId = $this.opts.form_id;

				new _log( '_form popForm data' );
				new _log({ msg: $this.opts.data, publish: 'console.table' });

				for( let _i in $this.opts.data )
				{
					let _val = $this.opts.data[_i];
					new _log( '_i' );
					new _log( _i );
					new _log( _val );
					new _log( 'selector' );
					let _sel = _formId + ' [name="' + _i + '"]';
					new _log( _sel );
					let _type = $( _sel ).prop( 'type' );
					new _log( 'type' );
					new _log( _type );
					switch( _type )
					{
						case 'radio':
						case 'checkbox':
							if( !!_val )
							{
								$( _sel ).prop( 'checked', true );
							}
							else
							{
								$( _sel ).prop( 'checked', false );
							}
							break;
						case 'date':
							let _date = new moment( _val );
							$( _sel ).val( _date.format( 'YYYY-MM-DD') );
							break;
						default:
							new _log( 'default popForm type' );
							new _log( _type );
							$( _sel ).val( _val );
							break;
					}
				}

				return _success( 'popped' );
			}
		);
	}

	setup()
	{
		if( this.opts.form_id )
		{
			if( '#' != this.opts.form_id.substring( 0, 1 ) )
			{
				// We add it here in case it was left off so that the form can be found without throwing unnecessary errors.
				this.opts.form_id = '#' + this.opts.form_id;
			}
		}

		if( 'undefined' === typeof $( this.opts.form_id ) || !$( this.opts.form_id ).length )
		{
			new _log( 'form_id ' + this.opts.form_id + ' not in DOM' );
			return false;
		}

		// Gather some information from the form itself and save for later send()
		if( 'undefined' === typeof this.opts.action || !this.opts.action )
		{
			this.opts.action = $( this.opts.form_id ).prop( 'action' );
		}

		if( 'undefined' === typeof this.opts.method || !this.opts.method )
		{
			this.opts.method = $( this.opts.form_id ).prop( 'method' );
		}
	}

	validate()
	{
		let _validErrors = 0;

		// First we'll process all the required fields so that we can then do conditional requireds
		$( this.opts.form_id + ' .required' ).filter( ':input' ).each(
			function( _index, _elem )
			{
				new _log( 'required' );
				new _log( 'validate elem' );
				new _log( _elem );
				_elem = $( _elem );
				new _log( _elem );
				let _elemId = _elem.prop( 'id' );
				let _elemType = _elem.prop( 'type' );
				new _log( _elemId );
				new _log( _elemType );

				let _elemVal = _elem.val();
				new _log( 'elemVal' );
				new _log( _elemVal );
				switch( _elemType )
				{
					case 'select-one':
					case 'select-multiple':
						_elemVal = $( '#' + _elemId + ' option:selected' ).val();
						break;
				}
				new _log( _elemVal );

				if( !_elemVal )
				{
					new _log( _elem.val() );
					new _log( 'form field missing value' );
					new _log( _elemId );
					$( _elemId ).addClass( 'error' );
					_validErrors++;
				}
				else
				{
					$( _elemId ).removeClass( 'error' );
				}
			}
		);

		if( 0 == _validErrors )
		{
			return true;
		}

		new _log( 'error counts ' + _validErrors );
		return false;
	}

	send()
	{
		return new Promise( ( _success, _fail ) =>
		{
			if( !this.validate() )
			{
				new _log( 'not valid form ' + this.opts.form_id );
				return _fail( 'form_has_errors' );
			}

			var _data = new FormData( $( this.opts.form_id )[0] );

			let o_store = new _store();

			new _api({
				url: this.opts.url,
				method: this.opts.method,
				data: _data,
				enctype: 'multipart/form-data',
			})
			.then(
				function( _ret )
				{
					new _log( 'form send ret' );
					new _log( _ret );
					return _success( _ret );
				}
			)
			.catch(
				function( _ret )
				{
					new _log( 'form send catch ret' );
					new _log( _ret );
					return _fail( _ret );
				}
			);
		});
	}

	getFormData()
	{
		let _formId = this.opts.form_id;
		new _log( 'getformData' );
		new _log( _formId );
		let _data = $( _formId ).serializeArray();
		new _log( _data );

		let _return = {};
		for( let _i in _data )
		{
			new _log( 'formData' );
			new _log( _i );
			new _log( _data[_i] );
			_return[_data[_i].name] = _data[_i].value;
		}

		return _return
	}

	resetForm()
	{
		let _formId = this.opts.form_id;
		new _log( 'resetform' );
		new _log( _formId );

		$( _formId )[0].reset();
		$( _formId + ' input:hidden' ).val( '' );

		return this;
	}
}
