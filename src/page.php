<?php
/*
Default Page Template
*/
?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php
		global $wheniwasbad_options;
		$sidebar_position = get_post_meta($post->ID, 'sidebar_position' , true);
		$sidebar_widget_group = get_post_meta($post->ID, 'sidebar_widgets' , true);
		$hide_empty_sidebar = $wheniwasbad_options['hide_widgets'];
		if ( ! is_active_sidebar($sidebar_widget_group) && $hide_empty_sidebar) {
			$main_class = "col-xs-12";
			$sidebar_class = "";
		} else {
			if ( $sidebar_position == 'left' ) {
				$main_class = "col-xs-12 col-sm-9 col-sm-push-3";
				$sidebar_class = "col-xs-12 col-sd-3 col-sm-pull-9";
			} elseif ( $sidebar_position == 'right' ) {
				$main_class = "col-xs-12 col-sm-9";
				$sidebar_class = "col-xs-12 col-sm-3";
			}
		}
	?>

	<div id="content" class="container clearfix">

		<header class="page-header">

			<h1><?php the_title(); ?></h1>

			<?php get_template_part('postmeta-horizontal'); ?>

		</header>

		<div class="row clearfix">

			<section id="main" class="<?php echo $main_class; ?> clearfix" role="main">

				<?php get_template_part( 'content-page' ); ?>

				<?php if ( comments_open() || get_comments_number() ) {
					echo "<!-- comments open:". comments_open() . "-->";
					comments_template();
				} ?>

			</section> <!-- end #main -->

			<?php if ($sidebar_class != ''): ?>

				<section class="<?php echo $sidebar_class; ?> clearfix">

					<?php get_sidebar($sidebar_widget_group); ?>

				</section>

			<?php endif; ?>

		</div>

	</div> <!-- end #content -->

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
