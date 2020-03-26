$(function() {
    var $overlay = $( "#overlay" );
    var $overlayContent = $overlay.find( "section.content" );
    initSubContent();
    initOverlay();

    function initSubContent() {
        $( "article.media input[type='checkbox']" ).click(function( event ) {
            var isChecked = $(this).prop( "checked" )
                $twinInputs = $( "input[name='" + $(this).attr('name') + "']" );

            $twinInputs.prop( "checked", false );
            $(this).prop( "checked", true );

            if( isChecked )
                new Media().services( $( this ) );
            else
                new Media().clear();
        });
    }

    function Media() {
        return {
            services: _services,
            clear: _clear
        };

        function _services( $element ) {
            var	$media			                    = $element.parents( "article" ).eq( 0 ),
                postData                            = $( 'form:first' ).serialize();

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
                        $overlayContent.html( $(response) );
                        $overlay.find('form').bind('submit', function(event) {
                            var $this = $(this),
                                url = $this.attr('action'),
                                postData = $this.serialize();
                            event.preventDefault();

                            $.ajax({
                                "type": "POST",
                                "url": url,
                                "data": postData,
                                "success": function( response, status, xhr ) {
                                    $overlayContent.html( response );
                                }
                            });
                        });
                        $overlay.show();
                    }
                }
            });
        }

        function _clear() {
            $overlay.hide();
        }
    }

    function initOverlay() {
        $overlay.find( "header a").click(function( event ) {
            event.preventDefault();

            $overlay.hide();
        });
    }
});
	