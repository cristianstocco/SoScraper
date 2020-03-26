var $chooses_select = jQuery('#chooses');
function Media() {
    return {
        services: _services,
    };

    function _services() {
        var postData = $( '#chooses_form' ).serialize();

        $.ajax({
            "type": "POST",
            "url": "/api/create/content",
            "data": postData,
            "success": function( response, status, xhr ) {
                if( xhr.getResponseHeader('Content-Type') == "application/json" ) {
                    var _location = response.location;

                    if( _location )
                        window.location = _location;
                }
                else {
                    $chooses_select.html( $(response) ).addClass('loaded');
                    jQuery('#full_api_submit').addClass('no_visible');
                    jQuery('html, body').animate({

                        scrollTop:$chooses_select.offset().top -250

                    }, 500);
                    $('#select_chooses').bind('submit', function(event) {
                        var $this = $(this),
                            url = $this.attr('action'),
                            postData = $this.serialize();
                        	event.preventDefault();

                        $.ajax({
                            "type": "POST",
                            "url": url,
                            "data": postData,
                            "success": function( response, status, xhr ) {
                                $chooses_select.html('').removeClass('loaded');
                                jQuery('#sources').css('margin-top', '50px');
                                jQuery(response).appendTo('#sources').addClass('view');
                                jQuery('#full_api_submit').removeClass('no_visible');
                            }
                        });
                    });
                }
            }
        });
    }

 }

$(document).ready(function() {

	$('input[type="range"]').val(10).change();
	var width_element = jQuery('.img_clients').width();
	jQuery('#clients_section .img_clients a').height(width_element);


});
jQuery(window).on('resize', function() {
	var width_element = jQuery('.img_clients').width();
	jQuery('#clients_section .img_clients a').height(width_element);

});
jQuery('#fp-nav a[href*="#"]').click(function() {
	jQuery('#fp-nav .active').removeClass('active');
	jQuery(this).addClass('active');
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	  var target = jQuery(this.hash);
	  if (target.length) {
	    jQuery('html, body').animate({
	      scrollTop: target.offset().top - jQuery('#mast_head').height()
	    }, 1000);
	    return false;
	  }
	}

});

jQuery(document).on('click', '.content_esample a', function(e){
	e.preventDefault();
	jQuery('.active').removeClass('active');
	jQuery(this).addClass('active');

	var box_code = jQuery(this).attr('href');
	console.log(box_code);
	jQuery('.content_script').hide();
	jQuery(box_code).show("fast", "linear");
});





jQuery(document).on('click', ".box_labeling", function () {
	jQuery('.active').removeClass('active');
	jQuery(this).addClass('active');
	var scelta = jQuery(this).attr('data-scelta');
	console.log(scelta);
	jQuery('.description').hide();
	jQuery('#'+scelta).show("fast", "linear");
    var _this = $(this);
   	jQuery('input:radio').attr('checked', false).removeClass('checkedRadio').removeProp('checked');
    _this.addClass('checkedRadio');
    _this.children('input:radio').attr('checked', true).prop('checked', true);
});


jQuery(document).on('click', ".box_source", function () {
	jQuery('.active').removeClass('active');
	jQuery(this).addClass('active');
    var _this = $(this);
    jQuery('#chooses').removeClass('loaded');
   	jQuery('input:checkbox').attr('checked', false).removeClass('checkedRadio').removeProp('checked');
    _this.addClass('checkedRadio');
    _this.children('input:checkbox').attr('checked', true).prop('checked', true);
    //if( _this.children('input:checkbox').hasClass('checkedRadio')){
		    new Media().services();
	//	}

});


jQuery(document).on('click', ".box_chooses", function () {
	jQuery(this).toggleClass('active');
    var _this = $(this);
   	jQuery('input:checkbox').attr('checked', false).removeClass('checkedRadio').removeProp('checked');
    _this.addClass('checkedRadio');
    _this.children('input:checkbox').attr('checked', true).prop('checked', true);

});

$(function() {
    $( '.apiHealth a.delete' ).click( function( event ) {
        event.preventDefault();
                
        $.get(
            '/api/delete/' + $( this ).parents( 'li.group' ).data( 'id' ),
            function( response, xhr ) {
                $chooses_select.html('').removeClass('loaded');
                jQuery( '.respond' ).text( response.message ).addClass( 'response_view' );
            }
        );
        
        return false;
    });
    
    $( '.apiHealth a.refresh' ).click( function( event ) {
        event.preventDefault();
        
        $.get(
            '/api/refresh/' + $( this ).parents( 'li.group' ).data( 'id' ),
            function( response, xhr ) {
                
                $chooses_select.html('').removeClass('loaded');
                jQuery( '.respond' ).text( jQuery(response).text().trim() ).addClass('response_view');
            }
        );
        
        return false;
    });
		    $('.toggle_menu').on('click', function(e) {
                e.preventDefault();
			jQuery(this).toggleClass('mobile_menu_open');
	      	$('#menu').toggleClass('mobile_menu_open');
	    });

});