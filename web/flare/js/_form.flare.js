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
		let form_id = ('#' + this.opts.form_id).replace('##','#');

		let form = new _dom.elem( form_id );
		if(!form)
		{
			new _log( 'form_id ' + this.opts.form_id + ' not in DOM' );
			return false;
		}

		// Gather some information from the form itself and save for later send()
		if( 'undefined' === typeof this.opts.action || !this.opts.action )
		{
			this.opts.action = new _dom.attr( this.opts.form_id, 'action' );
		}

		if( 'undefined' === typeof this.opts.method || !this.opts.method )
		{
			this.opts.method = new _dom.attr( this.opts.form_id, 'method' );
		}
	}

	validate()
	{
		let _validErrors = 0;

		// First we'll process all the required fields so that we can then do conditional requireds
		let elems = new _dom.elemAllFilter( this.opts.form_id + ' .required', ':input' );
		if( !elems )
		{
			return false;
		}

		elems.forEach(
			function( _elem )
			{
				new _log( 'required' );
				new _log( 'validate elem' );
				new _log( _elem );
				_elem = new _dom.elem( _elem );
				new _log( _elem );
				let _elemId = new _dom.attr( _elem, 'id' );
				_elemId = ('#' + _elemId).replace('##','#');
				let _elemType = new _dom.attr( _elem, 'type' );
				new _log( _elemId );
				new _log( _elemType );

				let _elemVal = new _dom.val( _elemId );
				new _log( 'elemVal' );
				new _log( _elemVal );
				switch( _elemType )
				{
					case 'select-one':
					case 'select-multiple':
						_elemVal = new _dom.val( _elemId + ' option:selected' );
						break;
				}
				new _log( _elemVal );

				if( !_elemVal )
				{
					new _log( _elem.val() );
					new _log( 'form field missing value' );
					new _log( _elemId );
					new _dom.addClass( _elemId, 'error' );
					_validErrors++;
				}
				else
				{
					new _dom.removeClass( _elemId, 'error' );
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

			var _data = new _dom.getFormData( this.opts.form_id );

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

	resetForm()
	{
		let _formId = this.opts.form_id;
		new _log( 'resetform' );
		new _log( _formId );

		new _dom.elem( _formId ).reset();
		new _dom.val( _formId + ' input:hidden', '' );

		return this;
	}
}
