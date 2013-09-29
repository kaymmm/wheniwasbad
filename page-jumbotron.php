<?php
/*
Template Name: Full-width Jumbotron
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
<?php 
	$post_thumbnail_id = get_post_thumbnail_id();
	$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'wpbs-featured-home' );
	
	global $wheniwasbad_options;
	$sidebar_position = get_post_meta($post->ID, 'sidebar_position' , true);
	$sidebar_widget_group = get_post_meta($post->ID, 'sidebar_widgets' , true);
	$hide_empty_sidebar = $wheniwasbad_options['hide_widgets'];
	if ( is_active_sidebar($sidebar_widget_group) && ! $hide_empty_sidebar ) {
		if ( $sidebar_position == 'left' ) {
			$main_class = "col-md-9 col-md-push-3";
			$sidebar_class = "col-md-3 col-md-pull-9";
		} elseif ( $sidebar_position == 'right' ) {
			$main_class = "col-md-9 col-md-pull-3";
			$sidebar_class = "col-md-3 col-md-push-9";
		}
	} else {
		$main_class = "col-md-12";
		$sidebar_class = "";
	}
?>

<div id="content" class="content-no-margin clearfix">
			
	<header>
	
		<div class="jumbotron" style="background-image: url('<?php echo $featured_src[0]; ?>'); background-repeat: no-repeat; background-position: 0 0;">
		
			<?php echo get_post_meta($post->ID, 'jumbotron_contents' , true);?>
	
		</div>

	</header>
	
	<div class="container">

		<div class="row clearfix">

			<section id="main" class="<?php echo $main_class; ?> clearfix" role="main">
							
				<?php the_content(); ?>
				
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wheniwasbad' ), 'after' => '</div>' ) ); ?>
				
				<?php comments_template( '', true ); ?>
												
			</section> <!-- main -->
			
			<?php if ($sidebar_class != ''): ?>
		
				<section class="<?php echo $sidebar_class; ?> clearfix" role="aside">
		
					<?php get_sidebar($sidebar_widget_group); ?>
					
				</section>
		
			<?php endif; ?>	
								
		</div>
    
	</div> <!-- end #content -->

<?php endwhile; ?>

<?php else : ?>

	<?php not_found(); ?>
		
<?php endif; ?>


<?php get_footer(); ?>