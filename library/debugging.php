<?php

//define('WP_LESS_COMPILATION', 'always');
define('WP_LESS_ALWAYS_RECOMPILE', true);
/*
function enqueue_debug_styles() {
	// use runtime-compiled less instead of compiled css
	//wp_dequeue_style( 'bootstrap' );
	wp_register_style( 'bootstrap-csst', get_template_directory_uri() . '/library/theme/less/bootstrap-themed.less', array(), '3.0.0', 'all' );
	wp_enqueue_style( 'bootstrap-csst' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_debug_styles', 100 );	
*/

?>