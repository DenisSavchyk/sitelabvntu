/*!
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md.
 */
//# sourceMappingURL=ckeditor.js.map

$(function() {
	var editors = document.querySelectorAll(".ckeditor");
		for (var i = 0; i < editors.length; ++i) {
		ClassicEditor.create(editors[i], {
			toolbar: {items: ['heading', '|', 'alignment', 'bold', 'italic', 'underline', 'link', 'bulletedList', 'numberedList', '|', 'fontColor', 'fontBackgroundColor', 'fontSize', 'fontFamily', 'removeFormat', '|', 'outdent', 'indent', '|', 'codeBlock', 'code', 'blockQuote', 'insertTable', 'mediaEmbed', 'textPartLanguage', 'undo', 'redo']}, language: 'ru', image: { toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side', 'linkImage']},
			table: {
				contentToolbar: ['tableColumn',
				'tableRow',
				'mergeTableCells',
				'tableCellProperties',
				'tableProperties']
			}, licenseKey: '',
		}).then( editor => {
			window.editor = editor;
			editor.editing.view.change(writer=>{
				writer.setStyle('min-height', "150px", editor.editing.view.document.getRoot());
				writer.setStyle('max-height', "100%", editor.editing.view.document.getRoot());
		   });
		})
		.catch( error => {
			console.error( 'Oops, something went wrong!' );
			console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
			console.warn( 'Build id: oy57w6wxv2hz-bs2ow2rmou3t' );
			console.error( error );
		});
	}
});