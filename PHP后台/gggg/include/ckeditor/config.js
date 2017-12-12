/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	 config.filebrowserBrowseUrl = '/include/ckeditor/ckfinder/ckfinder.html'; //启用浏览功能
     config.filebrowserImageBrowseUrl = '/include/ckeditor/ckfinder/ckfinder.html?Type=Images';
     config.filebrowserFlashBrowseUrl = '/include/ckeditor/ckfinder/ckfinder.html?Type=Flash';
     config.filebrowserUploadUrl = '/include/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
     config.filebrowserImageUploadUrl = '/include/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
     config.filebrowserFlashUploadUrl = '/include/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
