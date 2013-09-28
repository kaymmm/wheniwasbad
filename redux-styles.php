<style type="text/css">
/* CSS Generated from theme options */
<?php
	$options = get_option('wheniwasbad');

	$theme_options_styles = '';
/*
      $heading_typography = $options['heading_typography'];
      if ( $heading_typography['face'] != 'Default' ) {
        $theme_options_styles .= '
        h1, h2, h3, h4, h5, h6{
          font-family: ' . $heading_typography['face'] . ';
          font-weight: ' . $heading_typography['style'] . ';
          color: ' . $heading_typography['color'] . ';
        }';
      }

      $main_body_typography = $options['main_body_typography'];
      if ( $main_body_typography['face'] != 'Default' ) {
        $theme_options_styles .= '
        body{
          font-family: ' . $main_body_typography['face'] . ';
          font-weight: ' . $main_body_typography['style'] . ';
          color: ' . $main_body_typography['color'] . ';
        }';
      }
*/
      $link_color = $options['link_color'];
      if ($link_color) {
        $theme_options_styles .= '
		a{
			color: ' . $link_color . ';
		}';
      }

      $link_hover_color = $options['link_hover_color'];
      if ($link_hover_color) {
        $theme_options_styles .= '
		a:hover{
			color: ' . $link_hover_color . ';
		}';
      }

      $link_active_color = $options['link_active_color'];
      if ($link_active_color) {
        $theme_options_styles .= '
		a:active{
			color: ' . $link_active_color . ';
		}';
      }

      $topbar_bg_color = $options['top_nav_bg_color'];
      $use_gradient = $options['showhidden_gradient'];
      if ( $topbar_bg_color && !$use_gradient ) {
        $theme_options_styles .= '
		.navbar .fill {
			background-color: '. $topbar_bg_color . ';
			background-image: none;
		}';
      }

      if ( $use_gradient ) {
        $topbar_bottom_gradient_color = $options['top_nav_bottom_gradient_color'];

        $theme_options_styles .= '
		.navbar .fill {
			background-image: -khtml-gradient(linear, left top, left bottom, from(' . $topbar_bg_color . '), to('. $topbar_bottom_gradient_color . '));
			background-image: -moz-linear-gradient(top, ' . $topbar_bg_color . ', '. $topbar_bottom_gradient_color . ');
			background-image: -ms-linear-gradient(top, ' . $topbar_bg_color . ', '. $topbar_bottom_gradient_color . ');
			background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, ' . $topbar_bg_color . '), color-stop(100%, '. $topbar_bottom_gradient_color . '));
			background-image: -webkit-linear-gradient(top, ' . $topbar_bg_color . ', '. $topbar_bottom_gradient_color . '2);
			background-image: -o-linear-gradient(top, ' . $topbar_bg_color . ', '. $topbar_bottom_gradient_color . ');
			background-image: linear-gradient(top, ' . $topbar_bg_color . ', '. $topbar_bottom_gradient_color . ');
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'' . $topbar_bg_color . '\', endColorstr=\''. $topbar_bottom_gradient_color . '2\', GradientType=0);
		}';
      }

      $topbar_link_color = $options['top_nav_link_color'];
      if ( $topbar_link_color ) {
        $theme_options_styles .= '
		.navbar .nav li a {
			color: '. $topbar_link_color . ';
		}';
      }

      $topbar_link_hover_color = $options['top_nav_link_hover_color'];
      if ( $topbar_link_hover_color ) {
        $theme_options_styles .= '
		.navbar .nav li a:hover {
			color: '. $topbar_link_hover_color . ';
		}';
      }

      $topbar_link_hover_bg = $options['top_nav_link_background_color'];
      if ( $topbar_link_hover_bg ) {
        $theme_options_styles .= '
		.navbar .nav > li > a:focus,
		.navbar .nav > li > a:hover,
		.navbar .nav .active > a,
		.navbar .nav .active > a:hover,
		.navbar .nav .active > a:focus,
		.navbar .nav li.dropdown.open > .dropdown-toggle,
		.navbar .nav li.dropdown.active > .dropdown-toggle,
		.navbar .nav li.dropdown.open.active > .dropdown-toggle {
			background-color: '. $topbar_link_hover_bg . ';
		  }';
      }

      $topbar_dropdown_hover_bg_color = $options['top_nav_dropdown_hover_bg'];
      if ( $topbar_dropdown_hover_bg_color ) {
        $theme_options_styles .= '
		.dropdown-menu li > a:hover,
		.dropdown-menu .active > a,
		.dropdown-menu .active > a:hover {
			background-color: ' . $topbar_dropdown_hover_bg_color . ';
		}
        ';
      }

      $topbar_dropdown_item_color = $options['top_nav_dropdown_item'];
      if ( $topbar_dropdown_item_color ){
        $theme_options_styles .= '
          .dropdown-menu a{
            color: ' . $topbar_dropdown_item_color . ' !important;
          }
        ';
      }

      $jumbotron_bg_color = $options['jumbotron_bg_color'];
      if ( $jumbotron_bg_color ) {
        $theme_options_styles .= '
        .jumbotron {
          background-color: '. $jumbotron_bg_color . ';
        }';
      }
/*
      $suppress_comments_message = $options['suppress_comments_message'];
      if ( $suppress_comments_message ){
        $theme_options_styles .= '
        #main article {
          border-bottom: none;
        }';
      }
 */
      $additional_css = $options['wpbs_css'];
      if( $additional_css ){
        $theme_options_styles .= '
		'.$additional_css;
      }

      if( $theme_options_styles ){
		  // ensure consistent line endings
		  $s = str_replace("\r\n", "\n", $theme_options_styles);
		  $s = str_replace("\r", "\n", $s);
		  // Don't allow out-of-control blank lines
		  $s = preg_replace("/\n{2,}/", "\n\n", $s);
		  echo $s;
      }
/* bootswatch themes were turned off for now in preparation for Bootstrap v3
      $bootstrap_theme = $options['wpbs_theme'];
      $use_theme = $options['showhidden_themes'];

      if( $bootstrap_theme && $use_theme ){
        if( $bootstrap_theme == 'default' ){}
        else {
          echo '@include("' . get_template_directory_uri() . '/admin/themes/' . $bootstrap_theme . '.css")';
        }
      }
*/
?>
</style>