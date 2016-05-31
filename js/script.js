(function($){

	$(document).ready(function(){
	  // $('.your-class').slick({
	  // });


	  var responsive_slider_settings = [];
	  var breakpoints = [ 1500, 1265, 1075, 860, 670, 480 ];
	  var total_breakpoints = breakpoints.length;
	  $(breakpoints).each(function(index, element) {
	    var num_slides = total_breakpoints - index;
	    var infinite = ( num_slides > 1) ;
	    var obj = {
	      breakpoint: element,
	      settings: {
	        slidesToShow: num_slides,
	        slidesToScroll: num_slides,
	        infinite: infinite,
	      }
	    };
	    responsive_slider_settings.push(obj);
	  });

	  function getSlickSettings() {
	    return {
	      infinite: true,
	      slidesToShow: total_breakpoints + 1,
	      slidesToScroll: total_breakpoints + 1,
	      responsive: responsive_slider_settings
	    }
	  }

		$('.collections').slick( getSlickSettings() );
	});

})(jQuery);
