jQuery(document).ready(function() {
	jQuery(".box-full-caption").click(function(event) {
		event.preventDefault();
		
		var url = jQuery(this).find("a").attr("href");
		
		if (window.matchMedia('(max-width: 1023px)').matches){
			setTimeout(function() {
				jQuery(location).attr('href', url);			
			}, 1500);
		}			
		else
			jQuery(location).attr('href', url);
	});
});