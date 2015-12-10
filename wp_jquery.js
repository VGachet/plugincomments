jQuery("a#cacher").hide();

jQuery("span#texte").hide();


jQuery(document).ready(function() {
	jQuery( "a#montrer" ).click(function(event) {	
		event.preventDefault();
		jQuery("a#cacher").show();
		jQuery("a#montrer").hide();
		jQuery("span#texte").show();
	});

		jQuery( "a#cacher" ).click(function(event) {	
		event.preventDefault();
		jQuery("span#texte").hide();
		jQuery("a#cacher").hide();
		jQuery("a#montrer").show();
	});
});