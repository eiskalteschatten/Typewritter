// Scripts for the Installer

// Setup the database

$(document).ready(function() {
	$.ajax({ url: '_app/ajax.php',
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
	
	if (msg == "") {
		msg = "Typewritter was successfully installed!"
	}
	
	$('.message').text(msg);
	$('.message').show();
}