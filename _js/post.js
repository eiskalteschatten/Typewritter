// Scripts for the "Create post" page

// Saving and publishing functions

function savePost(button, publish) {
	$(button).stop().animate({opacity: 0}, 200, function() {
		var id = $('#postId').val();
		var title = $('#postTitle').val();
		var markdown = $('.markdown-editor').val();
		var html = $('.html-editor').val();

		if (publish) {
			published = 1;		

			$('.draft-buttons').removeClass('visible');
			$('.published-buttons').addClass('visible');
		}
		else {
			published = 0;
			
			$('.published-buttons').removeClass('visible');
			$('.draft-buttons').addClass('visible');
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

function autoSavePost() {
    var button = document.getElementById("saveDraft");
    savePost(button, false);
}

function publish(button) {
	openPopup("confirmpublish-popup");

	$("#publishPost").click(function() {
		savePost(button, true);
		closePopup("confirmpublish-popup");
                clearInterval(autoSave);
	});
}

function unpublish(button) {
	openPopup("confirmunpublish-popup");

	$("#unpublishPost").click(function() {
		savePost(button, false);
		closePopup("confirmunpublish-popup");
                autoSave = setInterval(autoSavePost, autoSaveInterval);
	});
}


// Live preview functions

function updateHtml() {
	var markdownContent = $('.markdown-editor').val();
	
	marked(markdownContent, function (err, content) {
  		if (err) {
  			throw err;
	  		console.log(content);
	  	}
	  	else {
			$('.html-editor').val(content);
			updatePreview();
		}
	});
}

function updatePreview() {
	var html = $('.html-editor').val();
	$('.preview-content').html(html);
}

function showLivePreview(button) {
	$('.markdown-guide').removeClass('visible');
	$('.preview-content').addClass('visible');
	
	$('.markdown-help').find('a').removeClass('selected');
	$(button).addClass('selected');
}

function showMarkdownGuide(button) {
	$('.preview-content').removeClass('visible');
	$('.markdown-guide').addClass('visible');
	
	$('.markdown-help').find('a').removeClass('selected');
	$(button).addClass('selected');
}


// Editor functions

function showmarkdownEditor(button) {
	$('.html-editor').removeClass('visible');
	$('.markdown-editor').addClass('visible');
	
	$('.editor-type').find('a').removeClass('selected');
	$(button).addClass('selected');
}

function showHtmlEditor(button) {
	$('.markdown-editor').removeClass('visible');
	$('.html-editor').addClass('visible');
	
	$('.editor-type').find('a').removeClass('selected');
	$(button).addClass('selected');
}