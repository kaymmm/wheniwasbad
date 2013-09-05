<?php
/*
Template Name: Right Sidebar
*/
?>

<?php get_header(); ?>
	
	<div id="content" class="container clearfix">
	
		<div id="main" class="clearfix" role="main">

			<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
		
				<?php get_template_part( 'content' ); ?>

			<?php endwhile; // end of the loop. ?>
			
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wheniwasbad' ), 'after' => '</div>' ) ); ?>
			
			<?php else : ?>
		
				<?php not_found(); ?>
		
			<?php endif; ?>
	
		</div> <!-- end #main -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
