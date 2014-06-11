<?php

//sanchothefat wp-less
/*
add_filter( 'less_vars', 'my_less_vars', 10, 2 );
function my_less_vars( $vars, $handle ) {
    // $handle is a reference to the handle used with wp_enqueue_style()
    $vars[ 'brand-primary' ] = '#00ff00';
    $vars[ 'icon-font-path' ] = get_template_directory_uri() . '/library/bootstrap/fonts/';
    return $vars;
}*/

//oncletom wp-less
/*if (class_exists('WPLessPlugin')){
	$less = WPLessPlugin::getInstance();

	$less->setVariables(array(
		'brand-primary' => '#9b59b6',//purple;
		'brand-success' => '#2ecc71',//green;
		'brand-warning' => '#f39c12',//orange;
		'brand-danger'  => '#c0392b',//red;
		'brand-info'    => '#f1c40f',//yellow;
		'body-bg'       => '#fff',//white;
		'text-color'    => '#34495e',//gray-darker;
		'link-color'    => '@brand-primary',
		'link-hover-color' => 'darken(@link-color, 15%);',
		'navbar-default-bg' => '@amethyst',
		'navbar-default-link-color' => '@white',
		'navbar-default-link-hover-color' => '@gray-light',
		'navbar-default-link-hover-bg' => 'rgba(0,0,0,0.1)',
		'dropdown-bg'	=> 'darken(@navbar-default-bg, 15%);',
		'dropdown-link-color' => '@gray-lighter',
		'jumbotron-bg'	=> '@gray-lighter',
		'jumbotron-color' => 'inherit',
	));

  // get options and set custom variables
  global $wheniwasbad_options;

	if ($wheniwasbad_options['link_color'])
		$less->addVariable('link-color',$wheniwasbad_options['link_color']);
	if ($wheniwasbad_options['link_hover_color'])
		$less->addVariable('link-hover-color',$wheniwasbad_options['link_hover_color']);
	if ($wheniwasbad_options['top_nav_bg_color'])
		$less->addVariable('navbar-default-bg',$wheniwasbad_options['top_nav_bg_color']);
	if ($wheniwasbad_options['top_nav_link_color'])
		$less->addVariable('navbar-default-link-color',$wheniwasbad_options['top_nav_link_color']);
	if ($wheniwasbad_options['top_nav_link_hover_color'])
		$less->addVariable('navbar-default-link-hover-color',$wheniwasbad_options['top_nav_link_hover_color']);
	if ($wheniwasbad_options['top_nav_link_background_color'])
		$less->addVariable('navbar-default-link-hover-bg',$wheniwasbad_options['top_nav_link_background_color']);
	if ($wheniwasbad_options['top_nav_dropdown_hover_bg'])
	    $less->addVariable('dropdown-bg',$wheniwasbad_options['top_nav_dropdown_hover_bg']);
	if ($wheniwasbad_options['top_nav_dropdown_item'])
	    $less->addVariable('dropdown-link-color',$wheniwasbad_options['top_nav_dropdown_item']);
	if ($wheniwasbad_options['jumbotron_bg_color'])
	    $less->addVariable('jumbotron-bg',$wheniwasbad_options['jumbotron_bg_color']);
	if ($wheniwasbad_options['jumbotron_color'])
	    $less->addVariable('jumbotron-color',$wheniwasbad_options['jumbotron_color']);
}*/

?>