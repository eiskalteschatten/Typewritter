// General scripts

// Functions for the dropdown menus

function openDropdown(dropdown) {
	var obj = $(dropdown);
	var menu = obj.find('.dropdown-menu')
	
	obj.addClass('open');

// 	obj.attr('onmouseover', '');
// 	obj.attr('onmouseout', '');
	
	menu.show();	
// 	menu.stop().animate({width: 'show'}, 400, function() {
// 		resetDropdownMenu(dropdown);
// 	});
}

function closeDropdown(dropdown) {
	var obj = $(dropdown);
	var menu = obj.find('.dropdown-menu')

	obj.removeClass('open');

	menu.hide();
	
// 	obj.attr('onmouseover', '');
// 	obj.attr('onmouseout', '');
	
// 	menu.stop().animate({width: 'hide'}, 200, function() {
// 		menu.hide();
// 		resetDropdownMenu(dropdown);
// 	});
}

function resetDropdowMenu(dropdown) {
	$(dropdown).bind('mouseover', function() {
		openDropdown(dropdown);
	}).bind('mouseout', function() {
		closeDropdown(dropdown);
	});	
}


// Functions for popups

function openPopup(id) {
	var obj = $('#'+id);
	obj.show();
	
	var content = obj.find('.popup-content');
	var width = content.outerWidth();
	var height = content.outerHeight();
	
	content.css('margin-left', Math.round((width/2)) * -1 + 'px');
	content.css('margin-top', Math.round((height/2)) * -1 + 'px');
	
	obj.stop().animate({opacity: 1}, 200);
	
	obj.find('.popup-background').click(function() {
		closePopup(id);
	});
}

function closePopup(id) {
	var obj = $('#'+id);
	
	obj.stop().animate({opacity: 0}, 200, function() {
		$(this).hide();
	});
}