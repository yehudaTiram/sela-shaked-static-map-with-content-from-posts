(function( $ ) {
	'use strict';
	$( document ).ready(function() {
		var map_and_postsPostsContainer = document.getElementById("map_and_posts_post_wrapper");
		//$("a[id^=map-and-posts-post-loader-btn-]").each(function(){
		$("a.map-tack-icon").each(function(){	
			$(this).click(function(event) {	
				var map_tack_id = $(this).data('post_id');	
				event.preventDefault();
				$(this).css('background', 'url(/wp-content/plugins/static-map-with-content-from-posts/public/images/map-tack-icon-green.png) no-repeat');
				$(this).siblings('.map-tack-icon').css('background', 'url(/wp-content/plugins/static-map-with-content-from-posts/public/images/map-tack-icon-red.png) no-repeat');
				//alert('line 14');
				$('.map-and-posts-spinner').show();
				var ourRequest = new XMLHttpRequest();
				ourRequest.open('GET', magicalData.siteURL + '/wp-json/wp/v2/posts/' + map_tack_id);
				ourRequest.onload = function() {
					if (ourRequest.status >= 200 && ourRequest.status < 400) {
						
						$('.map-and-posts-spinner').hide();
						
						var data = JSON.parse(ourRequest.responseText);
						
						var ourHTMLString = '';

						ourHTMLString += data.content.rendered;

						map_and_postsPostsContainer.innerHTML = ourHTMLString;
						
						/* Regenerate image carousel Avada */
						generateCarousel();
						
					} else {
						console.log("We connected to the server, but it returned an error.");
					}
				};

				ourRequest.onerror = function() {
					console.log("Connection error");
				};

				ourRequest.send();
			});					
		});

		  $('.trigger').click(function () {
			$(this).children().fadeIn(500);
			$(".trigger").not($(this)).children().fadeOut(500);
			$(this).unbind('mouseleave');
		  });		
		$('.trigger').hover(
			function () {
			$(this).children().fadeIn(500);
			$(".trigger").not($(this)).children().fadeOut(500);
		}, function () {
			$(this).children().fadeOut(500);
		});

	});	


$(function () {
  //$('.trigger').myTooltip();
});

$.fn.myTooltip = function () {
  
  var $this = $(this),
      $tooltip = $this.find('.map-tack-icon-tooltip');
  
  $this.mouseenter(function () {
    //$('.map-tack-icon-tooltip').fadeIn(500);
	$this.children().fadeIn(500);
  }).mouseleave(function () {
    $('.map-tack-icon-tooltip').stop(true, true).fadeOut(500);
  }); 
  
  $tooltip.click(function () {
    $('.map-tack-icon-tooltip').stop(true, true).fadeOut(500);
  });
};	
})( jQuery );



/*
	Click image and get coordinates
	http://www.emanueleferonato.com/2006/09/02/click-image-and-get-coordinates-with-javascript/
*/
// function point_it(event){
// pos_x = event.offsetX?(event.offsetX):event.pageX-document.getElementById("map-and-posts-map-div").offsetLeft;
// pos_y = event.offsetY?(event.offsetY):event.pageY-document.getElementById("map-and-posts-map-div").offsetTop;
// document.getElementById("cross").style.left = (pos_x-1).toString() + 'px'; ;
// document.getElementById("cross").style.top = (pos_y-15).toString() + 'px'; ;
// document.getElementById("cross").style.visibility = "visible" ;
// document.pointform.form_x.value = pos_x;
// document.pointform.form_y.value = pos_y;
// }