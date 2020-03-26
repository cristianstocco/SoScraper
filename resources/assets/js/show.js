$(function() {
    var $overlay = $( "#overlay"),
        $overlayContent = $overlay.find( "section.content" ),
        $apiGroup = $( '#apiGroupPartial, #apiGroupFull, #apiGroupInfo' );
    initOverlay();

    $apiGroup.find( 'article.group' ).bind('click', function( $event ) {
        $this = $( this );

        $.ajax({
            'type': 'GET',
            'url': 'show/' + $this.attr( 'data-id' ),
            'success': function( response, xhr, status ) {
                $overlayContent.html( $(response) );

                $overlay.show();
            }
        });

    });

    $apiGroup.find( 'input[name="refresh"]' ).bind('click', function( $event ) {
        $event.preventDefault();
        var id = $( this ).parents( "article" ).eq(0).attr( 'data-id' );

        $.ajax({
            'type': 'GET',
            'url': 'refresh/' + id,
            'success': function( response, xhr, status ) {
                $overlayContent.html( $(response) );

                $overlay.show();
            }
        });

        return false;
    });

    $apiGroup.find( 'input[name="edit"]' ).bind('click', function( $event ) {
        $event.preventDefault();
        var id = $( this ).parents( "article" ).eq(0).attr( 'data-id' );

        $.ajax({
            'type': 'GET',
            'url': 'edit/' + id,
            'success': function( response, xhr, status ) {
                $overlayContent.html( $(response) );

                (function bindingForm() {
                    $overlayContent.find( 'form' ).submit( function( $event ) {
                        $event.preventDefault();
                        var $this = $(this);

                        $.ajax({
                            'type': 'POST',
                            'url': $this.attr( 'action' ),
                            'data': $this.serialize(),
                            'success': function( response, xhr, status ) {
                                $overlayContent.html( $(response) );

                                bindingForm();

                                $overlay.show();
                            }
                        });

                        return false;
                    });
                })();

                $overlay.show();
            }
        });

        return false;
    });

    $apiGroup.find( 'input[name="delete"]' ).bind('click', function( $event ) {
        $event.preventDefault();
        var id = $( this ).parents( "article" ).eq(0).attr( 'data-id' );

        $.ajax({
            'type': 'GET',
            'url': 'delete/' + id,
            'success': function( response, xhr, status ) {
                var $div = $( document.createElement('div') );
                $div.addClass( 'message' );
                $overlayContent.html( response[ 'message' ] );

                $overlay.show();
            }
        });

        return false;
    });

    function initOverlay() {
        $overlay.find( "header a").click(false, function( event ) {
            event.preventDefault();

            $overlay.hide();
        });
    }
});