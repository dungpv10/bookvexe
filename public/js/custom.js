$( document ).ready(function($) {
    jQuery('.owl-carousel').owlCarousel({
	    nav:true,
	    items:3,
	    margin: 30,
	    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:3
	        },
	    }
	})
});