// Scripts for the "Create post" page

// Saving and publishing functions

function saveDraft() {
	var id = $('#postId').val();
	var published = $('#published').val();
	var title = $('#postTitle').val();
	var markdown = $('.markdown-editor').val();
	var html = $('.html-editor').val();

	$.ajax({
		url: '_app/ajax.php',
		data: {action: 'save', id: id, published: published, title: title, markdown: markdown, html: html},
		type: 'post',
		success: function(msg) {
			console.log(msg);
			
			var values = JSON.parse(msg);
			$('#postId').val(values.id);
			$('.date-updated').show();
			$('.date-updated').find('.date').text(values.date);
		},
		error: function(msg) {
			console.log("Error\n"+msg);			
		}
	});
}

function publish() {

}


// Live preview functions

function updateHtml() {


	updatePreview();
}

function updatePreview() {
	var html = $('.html-editor').val();
	$('.preview').html(html);
}


// Editor functions

function showmarkdownEditor(button) {
	$('.html-editor').removeClass('visible');
	$('.markdown-editor').addClass('visible');
	
	$('.editor-type').find('a').removeClass('selected');
	$(button).addClass('selected');
	
	$('.markdown-help').addClass('visible');
}

function showHtmlEditor(button) {
	$('.markdown-editor').removeClass('visible');
	$('.html-editor').addClass('visible');
	
	$('.editor-type').find('a').removeClass('selected');
	$(button).addClass('selected');
	
	$('.markdown-help').removeClass('visible');
}