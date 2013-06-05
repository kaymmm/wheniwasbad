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
		
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- WordPress head functions -->
	<?php wp_head(); ?></head>
	
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
										<?php bones_main_nav(); ?>
									</div>
								<?php endif; ?>

								<?php if($options['search_bar']) : ?>
								<form class="navbar-search pull-right" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
									<input name="s" id="s" type="text" class="search-query" autocomplete="off" placeholder="<?php _e('Search','bonestheme'); ?>" >
								</form>
								<?php endif; ?>
									
								<?php if ($nav_align=='right') : ?>
									<div class="nav-collapse pull-right">
										<?php bones_main_nav(); ?>
									</div>
								<?php endif; ?>
								
							</nav>
							
						<!--</div>  end .nav-container -->
					</div> <!-- end .navbar-inner -->
				</div> <!-- end .navbar -->
			
			</div> <!-- end #inner-header -->
		
		</header> <!-- end header -->