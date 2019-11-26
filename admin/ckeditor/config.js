/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	config.pasteFromWordPromptCleanup = false;
    config.pasteFromWordCleanupFile = false;
    config.pasteFromWordRemoveFontStyles = false;
    config.pasteFromWordNumberedHeadingToList = false;
    config.pasteFromWordRemoveStyles = false;
    config.allowedContent=true;
	config.selectMultiple = true; 
	 
	
	config.codemirror_theme = 'rubyblue';  // Go here for theme names: http://codemirror.net/demo/theme.html
	config.codemirror = {
	lineNumbers: true,
	highlightActiveLine: true,
	enableSearchTools: true,
	showSearchButton: true,
	showFormatButton: true,
	showCommentButton: true,
	showUncommentButton: true,
	showAutoCompleteButton: true
	};
	
	config.contentsCss = 'admin/ckeditor/fonts.css';
	config.font_names = 'Helvetica;' + 'Myriad Pro;' + 'Elle-futura-bold;' + 'Elle-futura;' + config.font_names;
	
	// Comment out or remove the 2 lines below if you want to enable the Advanced Content Filter	
	config.allowedContent = true;
	config.extraAllowedContent = '*{*}';
	config.allowedContent = 'div{*}';	
	config.uiColor = '#AADC6E';

	config.line_height = "1em; 1.1em; 1.2em; 1.3em; 1.4em; 1.5em; 1.6em; 1.7em; 1.8em; 1.9em; 2em; 2.1em; 2.2em; 2.3em; 2.4em; 2.5em; 2.6em; 2.7em; 2.8em; 2.9em; 3em";
	
	config.toolbar = 'Full';
 
	/*config.toolbar_Full =
	[
		{ name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
		{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 
	        'HiddenField' ] },
		'/',
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat','Letterspacing' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
		'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe','Youtube','Symbol','Slideshow' ] },
		'/',
		{ name: 'styles', items : [ 'Styles','Format','Font','FontSize','lineheight','Bgimage' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
	];
	 */
	config.toolbar_Basic =
	[
		['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','About']
	];
};

CKEDITOR.config.extraPlugins = 'codemirror,wenzgmap,googledocs,symbol,lineheight,youtube,entities,bootstrapVisibility,tableresize,slideshow,bgimage,letterspacing';