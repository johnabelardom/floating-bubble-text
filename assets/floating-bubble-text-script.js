// jQuery(window).bind('scroll', function () {
//     if (jQuery(window).scrollTop() > 300) {
//         jQuery('.jenus-social-share ').addClass('fixed-social-share');
//     } else {
//         jQuery('.jenus-social-share ').removeClass('fixed-social-share');
//     }
// });

// var tooltip.css({
// 	top: linkPosition.top - tooltip.outerHeight() - 13,
// 	left: linkPosition.left - (tooltip.width()/2)
// });
  var char = jQuery('#fbt-image img');
  var tooltip = jQuery('#fbt-tooltip');
  var charPosition = char.position();
  var slideIndex = 1;
  var last_y = 0;
  var data_pos;
  var element = jQuery("#fbt-tooltip");
  var newWidth = element.length > 1 ? element.css('width').replace('px', '') : 0;
  var newHeight = element.length > 1 ? element.css('height').replace('px', '') : 0;
  var floating_bubble_text;

  function checkForChanges() {
      w = element.css('width').replace('px', '');
      newWidth = w;
      h = element.css('height').replace('px', '');
      newHeight = h;

      // console.log("New Width", newWidth);
      // console.log("New Height", newHeight);
  }

  function plusDivs(n) {
    showDivs(slideIndex += n);
  }

  function showDivs(n) {

    var tooltip = document.getElementById('fbt-tooltip');
    if (tooltip == null)
    	return;
    var i;

    var x = jQuery(".linkSlides");
    if (n > x.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
       x[i].style.opacity = "0";
       x[i].style.display = "none";
    }
    x[slideIndex-1].style.opacity = "1"; 
    x[slideIndex-1].style.display = "block";   
  }

	jQuery(document).ready(function() {
  		floating_bubble_text = jQuery('#floating-bubble-text').attr('data-name');
  		console.log(floating_bubble_text);
	  	jQuery('.close_btn').click(function() {
	  		var cookie = jQuery(this).attr('data-cookie');
	  		if (! cookie) {
	  			console.log(cookie);
	  			return;
	  		}
	  		cookies = cookie.split(';');
	  		createCookie(cookies[0], cookies[1], cookies[2]);
	  		jQuery('#floating-bubble-text').fadeOut();
	  		jQuery('#floating-bubble-text').remove();
	  	});
		data_pos = jQuery('#fbt-tooltip').attr('data-position-bubble');
		if (data_pos != 'top')
			jQuery('#fbt-tooltip').addClass(data_pos == 'right' ? 'left' : 'right');
		else
			jQuery('#fbt-tooltip').addClass(data_pos);

		jQuery('[data-link-slide=1]').attr('style', '');
		secs = jQuery('#fbt-content').attr('data-seconds');

		if (! checkForExpiration(floating_bubble_text)) {
			setInterval(function() { plusDivs(1) }, secs);
			if (data_pos == 'left') {
				followLeftCenter();
				setInterval(function() { checkForChanges(); followLeftCenter(); }, 300);
			}
			if (data_pos == 'right') {
				followRightCenter();
				setInterval(function() { checkForChanges(); followRightCenter(); }, 300);
			}
			jQuery(window).on('resize', function() {
				if (data_pos == 'left')
					followLeftCenter();
				if (data_pos == 'right')
					followRightCenter();

				// (function(w){w = w || window; var i = w.setInterval(function(){},100000); while(i>=0) { w.clearInterval(i--); }})(/*window*/);
			});
		} else {
			jQuery('[data-name=' + floating_bubble_text + ']').fadeOut();
			jQuery('[data-name=' + floating_bubble_text + ']').remove();
		}
	})

  function followRightCenter() {
    var tooltip = document.getElementById('fbt-tooltip');
    if (tooltip == null)
    	return;
    var imgPos = jQuery('#fbt-image img').position();
    var img = jQuery('#fbt-image img');
    var x = (imgPos.left + img.width()) - (newWidth * .1);
    var y = (imgPos.top + ((img.height() / 2 + 1) - (newHeight / 2))) - (newHeight * .8);

    // if (last_y == 0)
    //   last_y = y;
    // else
    //   y = last_y;
    tooltip.style.position = "absolute";
    tooltip.style.left = x + 'px';
    tooltip.style.top = y + 'px';
  }
  function followLeftCenter() {
    var tooltip = document.getElementById('fbt-tooltip');
    if (tooltip == null)
    	return;
    var imgPos = jQuery('#fbt-image img').position();
    var img = jQuery('#fbt-image img');
    var x = imgPos.left - (newWidth);
    // console.log(imgPos.left);
    var y = (imgPos.top + ((img.height() / 2 + 1) - (newHeight / 2))) - (newHeight * .8);

    // if (last_y == 0) {
    //   last_y = y;
    // } else {
    //   y = last_y;
    // }
    tooltip.style.position = "absolute";
    tooltip.style.left = x + 'px';
    tooltip.style.top = y + 'px';
  }
	/*var check_ ;
  function cookie() {
  	console.log(localStorage);
  	var cookie = jQuery('#floating-bubble-text').attr('data-cookie');

  	if (cookie == '')
  		return;

  	cookies = cookie.split(';');
  	var cookie_name = cookies[0];
  	var expire = cookies[1] * 1;

  	var d = new Date();
    var expires = d.getTime() + (expire);;
	console.log(expires);

	if (! localStorage.getItem(cookie_name))
		localStorage.setItem(cookie_name, expires);

	check_ = setInterval(check(cookie_name), 1000);

	setInterval(function() {
		console.log(localStorage);
	}, 1000);

	function check(name) {
  		var expire = localStorage.getItem(name);
  		var cur = (new Date()).getTime();
  		console.log(expire - cur);
  		console.log((new Date(expire * 1)).toString());
  		console.log((new Date(cur)).toString());

	  	if (! localStorage.getItem(name)) {
	  		jQuery('#floating-bubble-text').fadeIn();
	  	} else {
	  		if (! cur >= expire) {
		  		jQuery('#floating-bubble-text').fadeOut();
		  	} else {
		  		localStorage.setItem(name, '');
		  		jQuery('#floating-bubble-text').fadeOut();
		  		clearInterval(check_)
		  	}
	  	}
	}
  }*/

	function createCookie(name, value, days) {
	    var date, expires;
	    if (days) {
	        date = new Date();
	        date.setTime(date.getTime()+(days*24*60*60*1000));
	        expires = "; expires="+date.toGMTString();
	    } else {
	        expires = "";
	    }
	    document.cookie = name+"="+value+expires+"; path=/";
	    console.log('created exp');
	}

	function checkForExpiration(name) {
		var value = "; " + document.cookie;
		var parts = value.split("; " + name + "=");
		if (parts.length == 2) {
			console.log(parts.pop().split(";").shift());
			return true;
		} else
			return false
	}