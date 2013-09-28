<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		
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
		<?php $options = get_option('wheniwasbad'); ?>
		<?php $favicon_url = ($options['favicon_url']!='') ? $options['favicon_url'] : get_template_directory_uri() . '/favicon.ico'; ?>
		<link rel="shortcut icon" href="<?php echo $favicon_url; ?>">
		
		<!-- or, set /favicon.ico for IE10 win -->
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
		
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- WordPress head functions -->
		<?php wp_head(); ?>
	</head>
	
	<?php
	$nav_position = $options['nav_position'];
	$navbar_style = $options['nav_style'];
	
	$navheader_class='navbar-default ';
	
	if ($navbar_style_inverted)
		$navheader_class = 'navbar-inverted ';
	
	switch ($nav_position) {
		case 'fixed':
			$navheader_class .= 'navbar-fixed-top';
			$body_style = 'navbar-fixed-offset';
			break;
		case 'fixed-bottom':
			$navheader_class .= 'navbar-fixed-bottom';
			$body_style = 'navbar-no-offset';
			break;
		case 'scroll':
		default: 
			$navheader_class .= 'navbar-static-top';
			$body_style = 'navbar-no-offset';
	}
	?>
		
	<body <?php body_class($body_style); ?>>
				
		<header class="navbar <?php echo $navheader_class; ?>" role="banner">
			<div class="container">
				
				<div class="navbar-header">
				    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
				      <span class="sr-only">Toggle navigation</span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				    </button>
					<a class="navbar-brand" id="logo" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
					<?php if($options['branding_logo']['url']) { ?>
						<img src="<?php echo $options['branding_logo']['url']; ?>" alt="<?php echo get_bloginfo('description'); ?>">
					<?php }
						if($options['site_name']) bloginfo('name'); ?>
					</a>
				</div> <!-- navbar-header -->
				
				<?php $nav_align = $options['nav_alignment']; ?>
				
				<?php if ($nav_align=='left') : ?>
				<nav class="collapse navbar-collapse pull-left navbar-main-collapse" role="navigation">
					<?php main_nav(); ?>
				</nav>
				<?php endif; ?>
				
				<?php if($options['search_bar']) : ?>
				<form class="navbar-search pull-right" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
					<input name="s" id="s" type="text" class="search-query" autocomplete="off" placeholder="<?php _e('Search','bonestheme'); ?>" >
				</form>
				<?php endif; ?>
					
				<?php if ($nav_align=='right') : ?>
					<nav class="collapse navbar-collapse pull-right navbar-main-collapse" role="navigation">
						<?php main_nav(); ?>
					</nav>
				<?php endif; ?>
					
			</div> <!-- end container -->		
		</header> <!-- end header -->
