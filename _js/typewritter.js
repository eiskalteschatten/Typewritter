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