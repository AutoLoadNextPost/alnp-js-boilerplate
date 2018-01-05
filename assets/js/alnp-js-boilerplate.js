;( function ( $, window, document, undefined ) {

  // Used for when a post has changed. Useful for tracking page views with other anylytics.
  $('body').on( 'alnp-post-changed', function( e, post_title, post_url, post_id ) {
    // Put your code here.
  });

  // Used for before the next post is fetched.
  $('body').on( 'alnp-post-url', function( e, post_count, post_url ) {
    // Put your code here.
  });

  // Used to manipulate the post data before it is shown.
  $('body').on( 'alnp-post-data', function( e, post ) {
    // Put your code here.
  });

  // Used once a post has loaded.
  $('body').on( 'alnp-post-loaded', function( e, post_title, post_url, post_ID, post_count ) {
    // Put your code here.
  });

})( jQuery, window, document );
