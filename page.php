<?php
/*
Template Name: Default Page Template
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>

	<?php 
		if (empty($options)) $options = get_option('wheniwasbad');
		$sidebar_position = get_post_meta($post->ID, 'sidebar_position' , true);
		$sidebar_widgets = get_post_meta($post->ID, 'sidebar_widgets' , true);
		$hide_widgets = $options['hide_widgets'];
		if ( is_active_sidebar($sidebar_widgets) && ! $hide_widgets ) {
			if ( $sidebar_position == 'left' ) {
				$main_class = "col-md-9 col-md-push-3";
				$sidebar_class = "col-md-3 col-md-pull-9";
			} elseif ( $sidebar_position == 'right' ) {
				$main_class = "col-md-9";
				$sidebar_class = "col-md-3";
			}
		} else {
			$main_class = "col-md-12";
			$sidebar_class = "";
		}		
	?>
	
	<div id="content" class="container clearfix">

		<header class="page-header">
	
			<h1><?php the_title(); ?></h1>
			
			<?php get_template_part('postmeta-horizontal'); ?>
	
		</header>

		<div class="row clearfix">

			<section id="main" class="<?php echo $main_class; ?> clearfix" role="main">
	
				<?php get_template_part( 'content' ); ?>
			
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wheniwasbad' ), 'after' => '</div>' ) ); ?>
		
			</section> <!-- end #main -->
	
			<?php if ($sidebar_class != ''): ?>
	
				<div class="<?php echo $sidebar_class; ?> clearfix">
	
					<?php get_sidebar($sidebar_widgets); ?>
	
				</div>
	
			<?php endif; ?>		

		</div>

	</div> <!-- end #content -->
	
<?php endwhile; // end of the loop. ?>

<?php else : ?>

	<?php not_found(); ?>

<?php endif; ?>

<?php get_footer(); ?>
