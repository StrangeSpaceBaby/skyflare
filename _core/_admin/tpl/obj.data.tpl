<?php

class ~~obj~~_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
			~~cols~~
		];

		$this->select_cols = [
			~~select_cols~~
		];

		~~join_select_cols~~

		$this->full_join = [
			~~full_join~~
		];
	}
}
