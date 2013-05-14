<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title>
			<?php if ( !is_front_page() ) { echo wp_title( ' ', true, 'left' ); echo ' | '; }
			echo bloginfo( 'name' ); echo ' - '; bloginfo( 'description', 'display' );  ?> 
		</title>
				
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- Google/Typekit Webfont Loader Scripts (need to load before everything else) -->
		<script type="text/javascript">
			WebFontConfig = {
				google: { families: [ 'Raleway:400,700,900', 'Lora:400,700,400italic,700italic', 'Inconsolata:400italic' ] }
			};
			(function() {
				var wf = document.createElement('script');
				wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
				wf.type = 'text/javascript';
				wf.async = 'true';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(wf, s);
			})();
		</script>
	    <style type="text/css">
/***
* Google/Typekit Webfont Loader styles
***/
.wf-loading h1,
.wf-loading h2,
.wf-loading h3,
.wf-loading h4,
.wf-loading h5,
.wf-loading h6 {
font-family: sans-serif
}
.wf-inactive h1,
.wf-inactive h2,
.wf-inactive h3,
.wf-inactive h4,
.wf-inactive h5,
.wf-inactive h6 {
font-family: sans-serif
}
.wf-active h1,
.wf-active h2,
.wf-active h3,
.wf-active h4,
.wf-active h5,
.wf-active h6 {
font-family: "Raleway", "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.wf-loading body {
font-family: serif;
font-weight: 400;
font-size: 16px
}
.wf-inactive body {
font-family: serif;
font-weight: 400;
font-size: 16px
}
.wf-active body {
font-family: "Lora", Georgia, "Times New Roman", Times, serif;
font-weight: 400;
font-size: 16px
}
		</style>
		
		
		<!-- icons & favicons -->
		<!-- For iPhone 4 -->
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/h/apple-touch-icon.png">
		<!-- For iPad 1-->
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/m/apple-touch-icon.png">
		<!-- For iPhone 3G, iPod Touch and Android -->
		<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/l/apple-touch-icon-precomposed.png">
		<!-- For Nokia -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/l/apple-touch-icon.png">
		<!-- For everything else -->
		<?php $favicon_url = (of_get_option('favicon_url','')!='') ? of_get_option('favicon_url') : get_template_directory_uri() . '/favicon.ico'; ?>
		<link rel="shortcut icon" href="<?php echo $favicon_url; ?>">
				
		<!-- media-queries.js (fallback) -->
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
		<![endif]-->

		<!-- html5.js -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

		<!-- theme options from options panel -->
		<?php get_wpbs_theme_options(); ?>

		<!-- typeahead plugin - if top nav search bar enabled -->
		<?php require_once('library/typeahead.php'); ?>
				
	</head>
	
	<?php
	$nav_position = of_get_option('nav_position');
	switch ($nav_position) {
		case 'fixed':
			$navbar_class = 'navbar-fixed-top';
			$body_style = 'style="padding-top: 40px;"';
			break;
		case 'fixed-bottom':
			$navbar_class = 'navbar-fixed-bottom';
			$body_style = 'style="padding-top: 0;"';
			break;
		case 'scroll':
		default: 
			$navbar_class = 'navbar-static-top';
			$body_style = 'style="padding-top: 0;"';
	}
	?>
		
	<body <?php body_class(); echo $body_style; ?>>
				
		<header role="banner">
		
			<div id="inner-header" class="clearfix">
			
				<div class="navbar <?php echo $navbar_class; ?>">
					<div class="navbar-inner">
<!--						<div class="container-fluid nav-container"> -->
							<nav role="navigation">
								<a class="brand" id="logo" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
									<?php if(of_get_option('branding_logo','')!='') { ?>
										<img src="<?php echo of_get_option('branding_logo'); ?>" alt="<?php echo get_bloginfo('description'); ?>">
										<?php }
										if(of_get_option('site_name','1')) bloginfo('name'); ?></a>
								
								<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							        <span class="icon-bar"></span>
							        <span class="icon-bar"></span>
							        <span class="icon-bar"></span>
								</a>
								
								<div class="nav-collapse">
									<?php bones_main_nav(); // Adjust using Menus in Wordpress Admin ?>
								</div>
								
							</nav>
							
							<?php if(of_get_option('search_bar', '1')) {?>
							<form class="navbar-search pull-right" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
								<input name="s" id="s" type="text" class="search-query" autocomplete="off" placeholder="<?php _e('Search','bonestheme'); ?>" data-provide="typeahead" data-items="4" data-source='<?php echo $typeahead_data; ?>'>
							</form>
							<?php } ?>
							
						<!--</div>  end .nav-container -->
					</div> <!-- end .navbar-inner -->
				</div> <!-- end .navbar -->
			
			</div> <!-- end #inner-header -->
		
		</header> <!-- end header -->
		
		<div class="container">
