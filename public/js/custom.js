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
            }
        });
    };
    jQuery('.owl-carousel').owlCarousel({
	    nav:true,
	    items:3,
	    margin: 30,
	    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
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
    $('#number_customer').select2({
    });
    $(".timepicker input").timepicker({
    	timeFormat: 'h:m',
	    defaultTime: '11',
    });
    $(".datepicker input").datetimepicker({
    	defaultDate: new Date(),
        format: 'MM/DD/YYYY'
    });
    $('.match_height>div').matchHeight();
});