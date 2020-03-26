$(function() {
    $( '#providers' ).find( '.provider' ).click(function() {
        $( this ).find('input[name="provider"]').prop("checked", "checked");

        $( this).parent( 'form' ).find( 'input[name="submit"]' ).trigger( 'click' );
    });
});