<?php

//define('WP_LESS_COMPILATION', 'always');
define('WP_LESS_ALWAYS_RECOMPILE', true);

function enqueue_debug_styles() {
	// use runtime-compiled less instead of compiled css
	//wp_dequeue_style( 'bootstrap' );
	wp_register_style( 'bootstrap-csst', get_template_directory_uri() . '/library/theme/less/bootstrap-themed.less', array(), '3.0.0', 'all' );
	wp_enqueue_style( 'bootstrap-csst' );
}

function enqueue_debug_scripts() {
	// include debugging php/js
wp_register_script('wpbs_debugging', get_template_directory_uri() . 'library/debugging.js',array(),'1.0', true );
//wp_enqueue_script('wpbs_debugging');
}

add_action( 'wp_enqueue_scripts', 'enqueue_debug_scripts', 100 );	
add_action( 'wp_enqueue_scripts', 'enqueue_debug_styles', 100 );	

	
function add_css_admin_bar_link() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	$wp_admin_bar->add_menu( array(
		'href' => '#',
		'id' => 'css_link',
		'title' => __( 'Toggle GC CSS'),
		'meta' => array(
			'onclick' => 'togglejscssfile("cuny-all.css","css","'.get_template_directory_uri().'/orig/css/cuny-all.css")'
		),
	) );
}
//add_action('admin_bar_menu', 'add_css_admin_bar_link',999);
	
?>