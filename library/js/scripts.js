// as the page loads, call these scripts
jQuery(document).ready(function($) {

    // position static header at the top of the screen, accounting for admin bar
    $('#main_header.navbar-fixed-top').css('top',$('#wpadminbar').outerHeight());


    // force footer to bottom of page
    var height_diff = $(window).height() - $('body').height();
    if ( height_diff > 0 ) {
        $('#page-footer').css( 'margin-top', height_diff );
    }

    // parallax scrolling
    $('.parallax-wheniwasbad').each(function() {
        var $bgobj = $(this); // assigning the object

        $(window).scroll(function() {
            var speed = ($bgobj.data('bg-speed') > 0 ? $bgobj.data('bg-speed') : 1)
            var yPos = -($(window).scrollTop() / speed);

            // Put together our final background position
            var coords = '50% ' + yPos + 'px';
            // Move the background
            $bgobj.css({
                backgroundPosition: coords
            });
        });
    });

	$('article.post').hover(function(){
		$('a.edit-post').show();
	},function(){
		$('a.edit-post').hide();
	});

	$('#s').focus(function(){
		if( $(window).width() < 940 ){
			$(this).animate({ width: '200px' });
		}
	});

	$('#s').blur(function(){
		if( $(window).width() < 940 ){
			$(this).animate({ width: '100px' });
		}
	});

    $('body').scrollspy({
        target: '#main-nav',
        offset: $('.navbar').height() + 50 //somewhat arbitrary, might need to be adjusted for various setups
    });

    // animate scrolling within a page on menu clicks

    $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        var thetop;
        if ($('body').hasClass('navbar-no-offset')) {
            thetop = target.offset().top + 1;
        } else if ($('body').hasClass('navbar-fixed-offset')) {
            thetop = target.offset().top - $('.navbar').height() + 1;
        }
        $('html,body').animate({
          scrollTop: thetop
        }, 1000);
        return false;
      }
    }
  });

}); /* end of as page load scripts */

/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
    var doc = w.document;
    if( !doc.querySelector ){ return; }
    var meta = doc.querySelector( "meta[name=viewport]" ),
        initialContent = meta && meta.getAttribute( "content" ),
        disabledZoom = initialContent + ",maximum-scale=1",
        enabledZoom = initialContent + ",maximum-scale=10",
        enabled = true,
		x, y, z, aig;
    if( !meta ){ return; }
    function restoreZoom(){
        meta.setAttribute( "content", enabledZoom );
        enabled = true; }
    function disableZoom(){
        meta.setAttribute( "content", disabledZoom );
        enabled = false; }
    function checkTilt( e ){
		aig = e.accelerationIncludingGravity;
		x = Math.abs( aig.x );
		y = Math.abs( aig.y );
		z = Math.abs( aig.z );
		// If portrait orientation and in one of the danger zones
        if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
			if( enabled ){ disableZoom(); } }
		else if( !enabled ){ restoreZoom(); } }
	w.addEventListener( "orientationchange", restoreZoom, false );
	w.addEventListener( "devicemotion", checkTilt, false );
})( this );