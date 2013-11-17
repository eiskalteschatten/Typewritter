// Scripts for the "Create post" page

// Saving and publishing functions

function saveDraft() {
	var id = $('#postId').val();
	var published = $('#published').val();
	var title = $('#postTitle').val();
	var body = $('.markup-editor').val();

	$.ajax({ url: '_app/ajax.php',
		data: {action: 'save', id: id, published: published, title: title, body: body},
		type: 'post',
		success: function(msg) {
			console.log("Success\n"+msg);
		},
		error: function(msg) {
			console.log("Error\n"+msg);			
		}
	});
}

function publish() {

}


// Live preview functions

function updatePreview() {
	
}

function updateMarkup() {


	updatePreview();
}

function updateHtml() {
	
	
	updatePreview();
}


// Editor functions

function showMarkupEditor(button) {
	$('.html-editor').removeClass('visible');
	$('.markup-editor').addClass('visible');
	
	$('.editor-type').find('a').removeClass('selected');
	$(button).addClass('selected');
	
	$('.markup-help').addClass('visible');
}

function showHtmlEditor(button) {
	$('.markup-editor').removeClass('visible');
	$('.html-editor').addClass('visible');
	
	$('.editor-type').find('a').removeClass('selected');
	$(button).addClass('selected');
	
	$('.markup-help').removeClass('visible');
}