/*! OPEN POUPUP */
jQuery(document).on("click", 'a.edit', function(e){ // line 5
  e.preventDefault();
  pageurl = jQuery(this).attr('href');
	jQuery('body').addClass('no-scroll');
  jQuery('.preview').toggleClass('open');
  jQuery('.loader').show('fast');
  $.get(
      '/api/edit/' + $( this ).parents( 'li.group' ).data( 'id' ),
      function( response, xhr ) {
        jQuery('.loader').hide('fast');
          jQuery( '.load' ).html( response );
      }
  );

});
jQuery(document).on("click", '.icon_close', function(e){
	jQuery('body').removeClass('no-scroll');

  jQuery('.preview').removeClass('open');

  jQuery('.light-box').removeClass('view-lightbox');
});

jQuery(document).on('click', function(event) {
  if ($(event.target).has('.sfondo-light').length) {
    jQuery('body').removeClass('no-scroll');

    jQuery('.preview').removeClass('open');

    jQuery('.light-box').removeClass('view-lightbox');
  }
});