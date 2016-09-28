/*
* This JS code for prevent the browser from showing default error bubble/ hint
*/
document.addEventListener('invalid', (function(){
	return function(e){
		//prevent the browser from showing default error bubble/ hint
		e.preventDefault();
		// optionally fire off some custom validation handler
		// myvalidationfunction();
  };
})(), true);

jQuery(document).ready(function() {
    /*
	* Quick Quote Form
	*/
	jQuery('#btn-quickquote-continue').click(function() {
		jQuery('#lookingto-err-msg, #state-err-msg, #email-err-msg').html('');
		
		if(!jQuery('#lookingto')[0].checkValidity()){
			jQuery('#lookingto-err-msg').html(jQuery('#lookingto')[0].validationMessage);
		}
		else if(!jQuery('#state')[0].checkValidity()){
			jQuery('#state-err-msg').html(jQuery('#state')[0].validationMessage);
		}
		else if(!jQuery('#email')[0].checkValidity()){
			jQuery('#email-err-msg').html(jQuery('#email')[0].validationMessage);
		}
				
		if(jQuery('#lookingto')[0].checkValidity() && jQuery('#state')[0].checkValidity() && jQuery('#email')[0].checkValidity()) {
			jQuery('#btn-quickquote-continue-section').fadeOut(500);
			jQuery('.form-slide').slideToggle(1000, function(){
				jQuery("#firstname, #lastname, #phone").attr("required", "true");
				jQuery("#firstname").focus();
				jQuery("#btn-quickquote-submit").removeAttr("disabled"); 
			});			
		}
		else {
			jQuery('#form-quickquote').find(':submit').click();
		}
		
		return false;
    });
	
	jQuery('#form-quickquote').find(':submit').click(function(event) {
		jQuery('#lookingto-err-msg, #state-err-msg, #email-err-msg, #firstname-err-msg, #lastname-err-msg, #phone-err-msg').html('');
		
		if(!jQuery('#lookingto')[0].checkValidity()){
			jQuery('#lookingto-err-msg').html(jQuery('#lookingto')[0].validationMessage);
		}
		else if(!jQuery('#state')[0].checkValidity()){
			jQuery('#state-err-msg').html(jQuery('#state')[0].validationMessage);
		}
		else if(!jQuery('#email')[0].checkValidity()){
			jQuery('#email-err-msg').html(jQuery('#email')[0].validationMessage);
		}
		else if(!jQuery('#firstname')[0].checkValidity()){
			jQuery('#firstname-err-msg').html(jQuery('#firstname')[0].validationMessage);
		}
		else if(!jQuery('#lastname')[0].checkValidity()){
			jQuery('#lastname-err-msg').html(jQuery('#lastname')[0].validationMessage);
		}
		else if(!jQuery('#phone')[0].checkValidity()){
			jQuery('#phone-err-msg').html(jQuery('#phone')[0].validationMessage);
		}
		else{
			submitFormQuickQuote();
		}			
		
		return false;		
	});
	
	jQuery("#phone").on("keyup paste", function() {
		// Remove invalid chars from the input
		var input = this.value.replace(/[^0-9\(\)\s\-]/g, "");
		var inputlen = input.length;
		// Get just the numbers in the input
		var numbers = this.value.replace(/\D/g,'');
		var numberslen = numbers.length;
		// Value to store the masked input
		var newval = "";

		// Loop through the existing numbers and apply the mask
		for(var i=0;i<numberslen;i++){
			if(i==0) newval="("+numbers[i];
			else if(i==3) newval+=")"+numbers[i];
			else if(i==6) newval+="-"+numbers[i];
			else newval+=numbers[i];
		}

		// Re-add the non-digit characters to the end of the input that the user entered and that match the mask.
		if(inputlen>=1&&numberslen==0&&input[0]=="(") newval="(";
		else if(inputlen>=6&&numberslen==3&&input[4]==")"&&input[5]==" ") newval+=")";
		else if(inputlen>=5&&numberslen==3&&input[4]==")") newval+=")";
		//else if(inputlen>=6&&numberslen==3&&input[5]==" ") newval+=" ";
		else if(inputlen>=10&&numberslen==6&&input[9]=="-") newval+="-";

		jQuery(this).val(newval.substring(0,13));
	});
	
	function submitFormQuickQuote() {
	//jQuery('#form-quickquote').submit(function(event) {
		event.preventDefault();
		
		if(!jQuery('#firstname')[0].checkValidity()){
			jQuery('#firstname-err-msg').html(jQuery('#firstname')[0].validationMessage);
		}
		
		//alert("using ajax");
		//jQuery.post(this.action, jQuery(this).serialize());
		
		btnElem = jQuery('#form-quickquote').find(':submit');
		var btnVal = jQuery(btnElem).attr("value");
		jQuery(btnElem).attr('disabled','disabled');			
		jQuery(btnElem).val('Please wait...');
			
		jQuery.ajax({
			type: "POST",
			url: my_ajax_object.ajax_url,
			data:jQuery("#form-quickquote").serialize() + "&utm_code=" + getCookie('utm_code'),
			success: function (data) {
				// Inserting html into the result div on success
				//jQuery('#btn-quickquote-continue-section').fadeIn(500);
				//jQuery('.form-slide').fadeOut(1000);
				//jQuery("#form-quickquote")[0].reset();
				//jQuery('#results-quickquote').html(data);
				eraseCookie('utm_code');
				window.location.replace("/thank-you-very-much");
			},
			error: function(jqXHR, text, error) {
            // Displaying if there are any errors
            	jQuery('#results-quickquote').html(error);
				
				jQuery(btnElem).val(btnVal);
				jQuery(btnElem).removeAttr('disabled');
			}			
		});
		//jQuery('.form-slide').slideToggle(1000);
		//jQuery('.msg-slide').fadeIn( 500 ).delay( 1500 ).fadeOut( 400 );
		return false;		
	//});
	};
	
	
	/*
	* Contact Us Form
	*/
	jQuery('#form-contactus').find(':submit').click(function(event) {
		jQuery('#firstname-err-msg, #lastname-err-msg, #email-err-msg, #phone-err-msg, #state-err-msg, #message-err-msg').html('');		
		
		if(!jQuery('#firstname')[0].checkValidity()){
			jQuery('#firstname-err-msg').html(jQuery('#firstname')[0].validationMessage);
		}
		else if(!jQuery('#lastname')[0].checkValidity()){
			jQuery('#lastname-err-msg').html(jQuery('#lastname')[0].validationMessage);
		}
		else if(!jQuery('#email')[0].checkValidity()){
			jQuery('#email-err-msg').html(jQuery('#email')[0].validationMessage);
		}
		else if(!jQuery('#phone')[0].checkValidity()){
			jQuery('#phone-err-msg').html(jQuery('#phone')[0].validationMessage);
		}		
		else if(!jQuery('#state')[0].checkValidity()){
			jQuery('#state-err-msg').html(jQuery('#state')[0].validationMessage);
		}
		else if(!jQuery('#message')[0].checkValidity()){
			jQuery('#message-err-msg').html(jQuery('#message')[0].validationMessage);
		}
		else {
			btnElem = this;
			var btnVal = jQuery(btnElem).attr("value");
			jQuery(btnElem).attr('disabled','disabled');			
			jQuery(btnElem).val('Please wait...');
			
			jQuery.ajax({
				type: "POST",
				url: my_ajax_object.ajax_url,
				data:jQuery("#form-contactus").serialize(),
				success: function (data) {	
					// Inserting html into the result div on success
					//jQuery("#form-contactus")[0].reset();
					//jQuery('#results-contactus').html(data);
					//jQuery('.msg-slide').fadeIn( 500 ).delay( 1500 ).fadeOut( 400 );
					window.location.replace("/thank-contact-request");
					
					jQuery(btnElem).val(btnVal);
					jQuery(btnElem).removeAttr('disabled');
				},
				error: function(jqXHR, text, error) {
					// Displaying if there are any errors
					jQuery('#results-contactus').html(error);
					jQuery('.msg-slide').fadeIn( 500 ).delay( 1500 ).fadeOut( 400 );
					
					jQuery(btnElem).val(btnVal);
					jQuery(btnElem).removeAttr('disabled');
				}			
			});			
		}
		return false;
	});
	
	
	/*
	* Email Subscription Form
	*/
	jQuery('#form-emailsubscription').find(':submit').click(function(event) {		
		jQuery('#ne-err-msg').html('');
		
		if(!jQuery('#ne')[0].checkValidity()){
			jQuery('#ne-err-msg').html(jQuery('#ne')[0].validationMessage);
		}
		else {
			btnElem = this;
			var btnVal = jQuery(btnElem).attr("value");
			jQuery(btnElem).attr('disabled','disabled');			
			jQuery(btnElem).val('Please wait...');
			
			jQuery.ajax({
				type: "POST",
				url: my_ajax_object.ajax_url,
				data:jQuery("#form-emailsubscription").serialize(),
				success: function (data) {
					// Inserting html into the result div on success
					jQuery("#form-emailsubscription")[0].reset();
					jQuery('#results-emailsubscription').html(data);
					jQuery('.msg-slide').fadeIn( 500 ).delay( 2500 ).fadeOut( 400 );
					//window.location.replace("/thank-you-very-much");
					
					jQuery(btnElem).val(btnVal);
					jQuery(btnElem).removeAttr('disabled');
				},
				error: function(jqXHR, text, error) {
					// Displaying if there are any errors
					jQuery('#results-emailsubscription').html(error);
					jQuery('.msg-slide').fadeIn( 500 ).delay( 2500 ).fadeOut( 400 );
					
					jQuery(btnElem).val(btnVal);
					jQuery(btnElem).removeAttr('disabled');
				}			
			});			
		}
		return false;
	});

	
	/*
	* This JS code for tabs
	*/
	jQuery(".tabs-menu a, .tab-link").click(function(event) {
		event.preventDefault();
		jQuery(this).parent().addClass("current");
		jQuery(this).parent().siblings().removeClass("current");
		var tab = jQuery(this).attr("href");
		//jQuery(".tab-content").not(tab).css("display", "none");
		jQuery(tab).siblings().not(tab).not(".tab-visible-static").css("display", "none"); // handle multiple group of tabs
		jQuery(tab).fadeIn();
		if(jQuery(tab).offset().top - jQuery(this).parent().offset().top > 500) {
			jQuery('html, body').animate({
				scrollTop: jQuery(tab).offset().top
			}, 1000);
		}	
	});
	
	
	/*
	* Set default tab from hash tag in URL
	*/
	var hash = jQuery.trim( window.location.hash );
	if (hash)
		jQuery('.tabs-menu a[href$="' + hash + '"]').trigger('click');

	
	/*
	* This JS code for toggle
	*/
	jQuery(".btn-toggle").click(function(event) {
		event.preventDefault();
		var target = jQuery(this).attr("href");
		jQuery(target).slideToggle(500);
	});
	
	
	/*
	* Replace all SVG images with inline SVG
	*/
	jQuery('img.svg').each(function(){
		var $img = jQuery(this);
		var imgID = $img.attr('id');
		var imgClass = $img.attr('class');
		var imgURL = $img.attr('src');

		jQuery.get(imgURL, function(data) {
			// Get the SVG tag, ignore the rest
			var $svg = jQuery(data).find('svg');

			// Add replaced image's ID to the new SVG
			if(typeof imgID !== 'undefined') {
				$svg = $svg.attr('id', imgID);
			}
			// Add replaced image's classes to the new SVG
			if(typeof imgClass !== 'undefined') {
				$svg = $svg.attr('class', imgClass+' replaced-svg');
			}

			// Remove any invalid XML tags as per http://validator.w3.org
			$svg = $svg.removeAttr('xmlns:a');

			// Replace image with new SVG
			$img.replaceWith($svg);

		}, 'xml');
	});
	
	
	/*
	* Disable .tooltip href
	*/
	jQuery('a.tooltip').click(function() {
		jQuery('a.tooltip').removeClass("hover");
		jQuery(this).addClass('hover');
		return false;
	});
	jQuery('a.tooltip span').append('<a href="#" class="close-thik"></a>');
	jQuery(document).click(function() {
		jQuery('a.tooltip').removeClass("hover");		
    });
	jQuery(".close-thik").click(function() {
		jQuery('a.tooltip').removeClass("hover");
		return false;
    });

	
	/*
	* Audio Player Control
	*/
	jQuery(".btn-audio").click(function(event) {
		event.preventDefault();
		/*var file = jQuery(this).attr("href");
		var currStat = jQuery(this).text();
		
		//jQuery(file).slideToggle(10, function(){});
		jQuery(file).animate({width: 'toggle'});
		var audio = (document.getElementById(file.replace("#", "")));
		if (audio.paused) {
			jQuery(this).hide();
			//jQuery(this).children().first().text('❙❙');
			jQuery(file).trigger('play');			
		}
		else {
			//jQuery(this).children().first().text('❭');
			jQuery(file).trigger('pause');
		}*/
		
		jQuery('#small-player').slideDown(1000, function(){});
	});
	
	
	/*
	* jQuery Visual Helpers
	*/
	jQuery('#small-player').hover(function(){
		jQuery('#small-player-middle-controls').show();
		jQuery('#small-player-middle-meta').hide();
	}, function(){
		jQuery('#small-player-middle-controls').hide();
		jQuery('#small-player-middle-meta').show();
	});
	
	jQuery(".amplitude-mute").click(function(event) {
		jQuery(".amplitude-mute").toggleClass( 'muted' );
	});
	
	jQuery(".amplitude-close").click(function(event) {
		jQuery('#small-player').slideUp(1000, function(){});
	});


	/*
	* Anchor Scroll
	*/
	jQuery('.anchor').click(function(){ 
		href = jQuery(this).attr("href");
		jQuery('html,body').animate({
			scrollTop: jQuery(href).offset().top
		}, 500, function(){
			jQuery(href + ' input:first').focus();
		});
		return false;
	});	
});

/*
* Marketing Tollfree Number
*/
jQuery(window).load(function () {
    var mkt_tfn = getCookie('mkt_tfn');  
	if( mkt_tfn ) {
		//alert('replace tollfree');
		jQuery('.mkt-tollfree').text(mkt_tfn).attr("title", mkt_tfn).attr("href", 'tel:' + mkt_tfn.replace(/[^0-9]/g,'')) ;
	}
});

function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}  

function eraseCookie(key) {
    document.cookie = encodeURIComponent(key) + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/;';	
}