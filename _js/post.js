// Scripts for the "Create post" page

// Saving and publishing functions

function savePost(button, publish) {
	$(button).stop().animate({opacity: 0}, 200, function() {
		var id = $('#postId').val();
		var title = $('#postTitle').val();
		var markdown = $('.markdown-editor').val();
		var html = $('.html-editor').val();
		var published = $('#published').val();

		if (publish) {
			published = 1;		
		}

		$.ajax({
			url: '_app/ajax.php',
			data: {action: 'save', id: id, published: published, title: title, markdown: markdown, html: html},
			type: 'post',
			success: function(msg) {
				var values = JSON.parse(msg);
				$('#postId').val(values.id);
				$('.date-updated').show();
				$('.date-updated').find('.date').text(values.date);
		
				$(button).stop().animate({opacity: 1}, 200);
			},
			error: function(msg) {
				console.log("Error\n"+msg);	
				$(button).stop().animate({opacity: 1}, 200);	
			}
		});	
	});
}

function publish(button) {
	openPopup("confirmpublish-popup");

	$("#publishPost").click(function() {
		savePost(button, true);
		closePopup("confirmpublish-popup");
	});
}


// Live preview functions

function updateHtml() {


	updatePreview();
}

function updatePreview() {
	var html = $('.html-editor').val();
	$('.preview').html(html);
}

function showLivePreview() {

}

function showMarkdownGuide() {

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