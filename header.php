<?php
/*
* header.php
* adds header information to every page
*/
?>
<?php global $wheniwasbad_options; ?>
<!DOCTYPE html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title><?php bloginfo('name'); ?><?php is_front_page() ? bloginfo('description') : wp_title('|'); ?></title>

		<!-- icons & favicons -->
		<?php if (isset($wheniwasbad_options['favicon_url']) && isset($wheniwasbad_options['favicon_url']['url'])) : ?>

			<!-- Custom Favicon -->
			<link rel="icon" type="image/png" href="<?php echo $wheniwasbad_options['favicon_url']['url']; ?>">

		<?php else : ?>
			<!-- Opera Speed Dial Favicon -->
			  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/speeddial-160px.png" />

			<!-- For Apple displays: -->
			<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/touch-icon-iphone.png">
			<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/touch-icon-ipad.png">
			<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/touch-icon-iphone-retina.png">
			<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/touch-icon-ipad-retina.png">

			<!-- For Nokia -->
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/touch-icon-iphone.png">
			<!-- For everything else -->
			<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/favicon.png">

		<?php endif; ?>

		<!-- or, set /favicon.ico for IE10 win -->
		<meta name="msapplication-TileColor" content="#f01d4f">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- WordPress head functions -->
		<?php wp_head(); ?>
	</head>

	<?php
	$navbar_style = $wheniwasbad_options['nav_style'];

	$navheader_class='navbar-default ';

	switch ($wheniwasbad_options['opt-header-scroll']) {
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

	<body <?php body_class($body_style); ?> data-navpos="<?php echo $wheniwasbad_options['opt-header-scroll']; ?>">

		<header id="main_header" class="navbar <?php echo $navheader_class; ?> clearfix" role="banner" >

			<div class="container" style="position: relative;">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
					  <span class="sr-only">Toggle navigation</span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					</button>
					<?php if ( ($wheniwasbad_options['branding_logo'] && $wheniwasbad_options['branding_logo']['url']) || ($wheniwasbad_options['site_name'] && get_bloginfo()) ): ?>

					    <a class="navbar-brand" id="logo" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>">

							<?php if($wheniwasbad_options['branding_logo'] && $wheniwasbad_options['branding_logo']['url']) : ?>

								<img id="branding-logo" src="<?php echo $wheniwasbad_options['branding_logo']['url']; ?>" alt="<?php echo get_bloginfo('description'); ?>" />

							<?php endif; ?>

							<?php if($wheniwasbad_options['site_name'] && get_bloginfo()) bloginfo('name'); ?>

						</a>

					<?php endif; ?>
				</div> <!-- navbar-header -->

				<?php $nav_align = (! isset($wheniwasbad_options['nav_alignment']) ? 'right' : $wheniwasbad_options['nav_alignment']); ?>

				<?php if ($nav_align=='left') : ?>
				<nav class="collapse navbar-collapse pull-left navbar-main-collapse" role="navigation">
					<?php main_nav(); ?>
				</nav>
				<?php endif; ?>

				<?php if($wheniwasbad_options['search_bar']) : ?>
				<form class="navbar-form navbar-right" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
					<div class="input-group input-group-sm">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
								</span>
								<input name="s" id="s" type="text" class="form-control" autocomplete="off" placeholder="<?php _e('Search','gcwordpress'); ?>" >
							</div>
				</form>
				<?php endif; ?>

				<?php if ($nav_align=='right') : ?>
					<nav class="collapse navbar-collapse pull-right navbar-main-collapse" role="navigation">
						<?php main_nav(); ?>
					</nav>
				<?php endif; ?>

			</div> <!-- end container -->
		</header> <!-- end header -->
