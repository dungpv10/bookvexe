$( document ).ready(function($) {
	var dataLocation = function( request, response ) {
        $.ajax({
            url: "http://ws.geonames.org/searchJSON",
            dataType: "jsonp",
            data: {
                style: "MEDIUM",
                maxRows: 10,
                featureClass: "P",
                country: "VN,KH",
                name: request.term,
                username: "vuvanky"
            },
            success: function( data ) {

                response( $.map( data.geonames, function( item ) {
                    return {
                        label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryCode,
                        value: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryCode,
                        lat: item.lat,
                        lng: item.lng
                    }
                }));
                $('.wrap_location_start').find('li.ui-menu-item').css({fontSize: '13px'});
            }
        });
    };
    if (jQuery('.owl-carousel').length > 0) {
        jQuery('.owl-carousel').owlCarousel({
    	    nav:false,
    	    items:3,
    	    margin: 30,
            dots: false,
    	    responsive:{
                320: {
                    items: 1,
                    dots : false,
                },
    	        480:{
    	            items:2,
                    dots : false,
    	        },
    	        600:{
                    items:2,
    	        },
                992: {
                    item: 2,
                }
    	    }
    	});
    }
    if (jQuery('#start_point').length > 0) {
        $( "#start_point" ).autocomplete({
            source: dataLocation,
            minLength: 0,
            delay: 0,
            appendTo: ".wrap_location_start",
            close: function() {
                //UI plugin not removing loading gif, lets force it
                $( '#start_point' ).removeClass( "ui-autocomplete-loading" );
            }
        });
    }
    if (jQuery('#end_point').length > 0) {
        $( "#end_point" ).autocomplete({
            source: dataLocation,
            minLength: 0,
            delay: 0,
            appendTo: ".wrap_location_end",
            close: function() {
                //UI plugin not removing loading gif, lets force it
                $( '#end_point' ).removeClass( "ui-autocomplete-loading" );
            }
        });
    }
    if (jQuery('#number_customer').length > 0) {
        $('#number_customer').select2({
        });
    }
    if (jQuery('.timepicker input').length > 0) {
        $(".timepicker input").timepicker({
        	showMeridian: false,
    	    defaultTime: '11',
        });
    }
    if (jQuery('.datepicker input').length > 0) {
        $(".datepicker input").datetimepicker({
        	defaultDate: new Date(),
            format: 'MM/DD/YYYY'
        });
    }
    if (jQuery('.match_height>div').length > 0) {
        $('.match_height>div').matchHeight();
    }
    if (jQuery('.selectpicker').length > 0) {
        $('.selectpicker').selectpicker();
    }
    jQuery('.menu-mobile-con i').on('click', function() {
        if(jQuery('.header-rigth').hasClass('active')) {
            jQuery('.header-rigth').removeClass('active');
        } else {
            var height_window = jQuery( window ).height();
            jQuery('.header-rigth').height(height_window);
            jQuery('.header-rigth').addClass('active');
        }
    });
    jQuery('.close-notice').on('click', function(){
        jQuery(this).closest('.notice-success').css('display', 'none');
    });
});