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
    if (jQuery('.widget-promotion .owl-carousel').length > 0) {
        jQuery('.widget-promotion .owl-carousel').owlCarousel({
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
    if (jQuery('.widget-rate .owl-carousel').length > 0) {
        jQuery('.widget-rate .owl-carousel').owlCarousel({
            nav:false,
            items:4,
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
                    item: 3,
                }
            }
        });
    }
    if (jQuery('.galery-bus-tab .owl-carousel').length > 0) {
        jQuery('.galery-bus-tab .owl-carousel').owlCarousel({
            items:3,
            margin: 10,
            responsive:{
                320: {
                    items: 1,
                },
                480:{
                    items:2,
                },
                600:{
                    items:2,
                },
                992: {
                    item: 3,
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
    if (jQuery('#choose_start_time').length > 0) {
        $('#choose_start_time').select2({
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
    if (jQuery('.match_height_as').length > 0) {
        $('.match_height_as>div').matchHeight();
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
    jQuery('.close-notice').on('click', function() {
        jQuery(this).closest('.notice-success').css('display', 'none');
    });
    jQuery('.button-time').on('click', function() {
        var type_bus = jQuery(this).attr('data-type');
        var time_bus = jQuery(this).attr('data-time');
        jQuery('.button-time').each(function() {
            jQuery(this).removeClass('active');
        });
        jQuery(this).addClass('active');
        jQuery('#type-bus').val(type_bus);
        jQuery('#time-bus').val(time_bus);
    });
    jQuery(document).on('click', '.rating span', function () {
        var rateNumber = jQuery(this).attr('data-value');
        var parent = jQuery(this).closest('.comment-form-rating');
        parent.find('.rating-number').val(rateNumber);
        parent.find('.rating span').removeClass('active');
        parent.find('.rating span').each(function (index) {
            if (jQuery(this).attr('data-value') <= rateNumber) {
                jQuery(this).addClass('active');
            }
        });
    });
    jQuery(document).on('click', '.show-hidden', function() {
        var widget = jQuery(this).closest('.widget-filter');
        var content = jQuery(this).closest('.widget-filter').find('.widget-content');
        if (content.hasClass('active')) {
            content.removeClass('active');
            widget.removeClass('active');
            jQuery(this).removeClass('active');
        } else {
            content.addClass('active');
            widget.addClass('active');
            jQuery(this).addClass('active');
        }
    });
    if (jQuery('.widget-payment-custom-info-bus').length > 0) {
        jQuery('.select2-results__option').css('font-size', '13px');
    }
});
function showCustomerComment (element) {
    //TO DO update id for form modal
    $("#customer-comment").modal();
}