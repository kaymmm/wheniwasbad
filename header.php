<?php $options = get_option('wheniwasbad'); ?>
<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		<meta charset="utf-8">

		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title><?php bloginfo('name'); ?><?php is_front_page() ? bloginfo('description') : wp_title('|'); ?></title>
		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
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
		<?php $favicon_url = ($options['favicon_url']!='') ? $options['favicon_url'] : get_template_directory_uri() . '/favicon.ico'; ?>
		<link rel="shortcut icon" href="<?php echo $favicon_url; ?>">
		
		<!-- or, set /favicon.ico for IE10 win -->
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
		
		<!-- Google/Typekit Webfont Loader Scripts (need to load before everything else) -->
		<script type="text/javascript">
			WebFontConfig = {
				google: { families: [ 'Raleway:300,400,700', 'Enriqueta:400,700', 'Inconsolata:400'] }
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
}
.wf-inactive body {
font-family: serif;
}
.wf-active body {
font-family: "Enriqueta", Georgia, "Times New Roman", Times, serif;
}
		</style>
		
				
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
				
	</head>
	
	<?php
	$nav_position = $options['nav_position'];
	switch ($nav_position) {
		case 'fixed':
			$navbar_class = 'navbar-fixed-top';
			$body_style = 'navbar-fixed-offset';
			break;
		case 'fixed-bottom':
			$navbar_class = 'navbar-fixed-bottom';
			$body_style = 'navbar-no-offset';
			break;
		case 'scroll':
		default: 
			$navbar_class = 'navbar-static-top';
			$body_style = 'navbar-no-offset';
	}
	?>
		
	<body <?php body_class($body_style); ?>>
				
		<header role="banner">
		
			<div id="inner-header" class="clearfix">
			
				<div class="navbar <?php echo $navbar_class; ?>">
					<div class="navbar-inner">
<!--						<div class="container-fluid nav-container"> -->
							<nav role="navigation">
								<a class="brand" id="logo" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
									<?php if($options['branding_logo']!='') { ?>
										<img src="<?php echo $options['branding_logo']; ?>" alt="<?php echo get_bloginfo('description'); ?>">
										<?php }
										if($options['site_name']) bloginfo('name'); ?></a>
								
								<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							        <span class="icon-bar"></span>
							        <span class="icon-bar"></span>
							        <span class="icon-bar"></span>
								</a>
								<?php $nav_align = $options['nav_alignment']; ?>
								<?php if ($nav_align=='left') : ?>
									<div class="nav-collapse pull-left">
										<?php bones_main_nav(); // Adjust using Menus in Wordpress Admin ?>
									</div>
								<?php endif; ?>

								<?php if($options['search_bar']) : ?>
								<form class="navbar-search pull-right" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
									<input name="s" id="s" type="text" class="search-query" autocomplete="off" placeholder="<?php _e('Search','bonestheme'); ?>" >
								</form>
								<?php endif; ?>
									
								<?php if ($nav_align=='right') : ?>
									<div class="nav-collapse pull-right">
										<?php bones_main_nav(); // Adjust using Menus in Wordpress Admin ?>
									</div>
								<?php endif; ?>
								
							</nav>
							
						<!--</div>  end .nav-container -->
					</div> <!-- end .navbar-inner -->
				</div> <!-- end .navbar -->
			
			</div> <!-- end #inner-header -->
		
		</header> <!-- end header -->