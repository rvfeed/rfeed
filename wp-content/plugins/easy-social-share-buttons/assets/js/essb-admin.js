function essb_option_activate(id) {
	essb_options_deactivate_menus();
	jQuery("#essb-menu-"+id).addClass("active");
	jQuery("#essb-container-"+id).toggle();
}

function essb_options_deactivate_menus() {

	jQuery(".essb-options-group-menu").find(".essb-menu-item").each(function() {
		if (jQuery(this).hasClass("active")) {
			jQuery(this).removeClass("active");
		}
	});

	jQuery(".essb-options-container").find(".essb-data-container").each(function() {
		jQuery(this).hide();
	});
}

