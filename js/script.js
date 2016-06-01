(function($){
	$(document).ready(function(){


	var responsive_slider_settings = [];
	var breakpoints = [ 1140, 860, 670];
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
	      // centerMode: true,
	      centerPadding: '60px',
	      responsive: responsive_slider_settings
	    }
	  }

	$('.collections-slide').slick( getSlickSettings() );	

	
	});

	$(document).ready(function(){
	//   // $('.your-class').slick({
	//   // });


	//   var responsive_slider_settings = [];
	//   var breakpoints = [ 1400, 1265, 1075, 860, 670, 480 ];
	//   var total_breakpoints = breakpoints.length;

	//   $(breakpoints).each(function(index, element) {

	//     var num_slides = total_breakpoints - index;
	//     var infinite = ( num_slides > 1) ;
	//     var obj = {
	//       breakpoint: element,
	//       settings: {
	//         slidesToShow: 5,
	//         slidesToScroll: 5,
	//         infinite: infinite,
	//       }
	//     };
	//     responsive_slider_settings.push(obj);
	//   });

	//   function getSlickSettings() {
	//     return {
	//       infinite: true,
	//       slidesToShow: 5,
	//       slidesToScroll: 5,
	//       responsive: responsive_slider_settings
	//     }
	//   }

	// 	$('.collections-slide').slick( getSlickSettings() );
	
	$('.colslections-slide').slick({
	  slidesToShow: 4,
	  // slidesToScroll: 1,
	  // dots: true,
	  // centerMode: true,
	  // focusOnSelect: true
	});
	});

})(jQuery);