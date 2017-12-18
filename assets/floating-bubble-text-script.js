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
  var newWidth = element.css('width').replace('px', '');
  var newHeight = element.css('height').replace('px', '');

  function checkForChanges() {
      w = element.css('width').replace('px', '');
      newWidth = w;
      h = element.css('height').replace('px', '');
      newHeight = h;

      console.log("New Width", newWidth);
      console.log("New Height", newHeight);
  }

  function plusDivs(n) {
    showDivs(slideIndex += n);
  }

  function showDivs(n) {
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
    // setTimeout(function() {
      data_pos = jQuery('#fbt-tooltip').attr('data-position-bubble');
      console.log(data_pos);
      if (data_pos != 'top')
      	jQuery('#fbt-tooltip').addClass(data_pos == 'right' ? 'left' : 'right');
      else
      	jQuery('#fbt-tooltip').addClass(data_pos);

      jQuery('[data-link-slide=1]').attr('style', '');
      secs = jQuery('#fbt-content').attr('data-seconds');
      // setInterval(showDivs(1), 1);
      setInterval(function() { plusDivs(1) }, secs);
      // setInterval(function() { checkForChanges(); followLeftCenter(); }, secs / 2);
      if (data_pos == 'left') {
        followLeftCenter();
        setInterval(function() { checkForChanges(); followLeftCenter(); }, secs / 2);
      }
      if (data_pos == 'right') {
        followRightCenter();
        setInterval(function() { checkForChanges(); followRightCenter(); }, secs / 2);
      }
      if (data_pos == 'topLeft') {
        followTopLeft();
        setInterval(function() { checkForChanges(); followTopLeft(); }, secs / 2);
      }
      if (data_pos == 'TopRight') {
        followTopRight();
        setInterval(function() { checkForChanges(); followTopRight(); }, secs / 2);
      }
    // }, 3000)
  })

  jQuery(window).on('resize', function() {
    if (data_pos == 'left')
      followLeftCenter();
    if (data_pos == 'right')
      followRightCenter();
    if (data_pos == 'top-left')
      followTopLeft();
    if (data_pos == 'Top-right')
      followTopRight();
  });

  function followTopLeft() {
    var imgPos = jQuery('#fbt-image').position();
    var tooltip = document.getElementById('fbt-tooltip');
    var x = imgPos.left + 25;
    var y = imgPos.top - 50;

    if (last_y == 0)
      last_y = y;
    else
      y = last_y;

    tooltip.style.position = "absolute";
    tooltip.style.left = x +'px';
    tooltip.style.top = y +'px';
  }
  function followTopRight() {
    var imgPos = jQuery('#fbt-image').position();
    var tooltip = document.getElementById('fbt-tooltip');
    var x = imgPos.left + (imgPos.left / 2);
    var y = imgPos.top - 50;

    if (last_y == 0)
      last_y = y;
    else
      y = last_y;

    tooltip.style.position = "absolute";
    tooltip.style.left = x + 'px';
    tooltip.style.top = y + 'px';
  }
  function followRightCenter() {
    var imgPos = jQuery('#fbt-image img').position();
    var img = jQuery('#fbt-image img');
    var tooltip = document.getElementById('fbt-tooltip');
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
    var imgPos = jQuery('#fbt-image img').position();
    var img = jQuery('#fbt-image img');
    var tooltip = document.getElementById('fbt-tooltip');
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
