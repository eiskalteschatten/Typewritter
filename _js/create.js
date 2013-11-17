// Scripts for the "Create post" page

// Editor functions

function showMarkupEditor(button) {
	$('.html-editor').removeClass('visible');
	$('.markup-editor').addClass('visible');
	
	$('.editor-type').find('a').removeClass('selected');
	$(button).addClass('selected');
}

function showHtmlEditor(button) {
	$('.markup-editor').removeClass('visible');
	$('.html-editor').addClass('visible');
	
	$('.editor-type').find('a').removeClass('selected');
	$(button).addClass('selected');
}