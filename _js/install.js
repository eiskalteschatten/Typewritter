// Scripts for the Installer

// Setup the database

$(document).ready(function() {
	$.ajax({ url: 'ajax.php',
		data: {action: 'install'},
		type: 'post',
		success: function(msg) {
			placeMessage(msg);		// Show success message
		},
		error: function(msg) {
			placeMessage(msg);		// Show error message
		}
	});
});

function placeMessage(msg) {
	$('.loader').hide();
	
	if (msg == "1") {
		msg = "Typewritter was successfully installed!"
	}
	else {
		msg = msg.replace("1", "");
	}
	
	$('.message').text(msg);
	$('.message').show();
}