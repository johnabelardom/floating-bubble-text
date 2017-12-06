// jQuery(window).bind('scroll', function () {
//     if (jQuery(window).scrollTop() > 300) {
//         jQuery('.jenus-social-share ').addClass('fixed-social-share');
//     } else {
//         jQuery('.jenus-social-share ').removeClass('fixed-social-share');
//     }
// });

var tooltip.css({
	top: linkPosition.top - tooltip.outerHeight() - 13,
	left: linkPosition.left - (tooltip.width()/2)
});
