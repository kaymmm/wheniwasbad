<?php get_header(); ?>
	
	<div id="content" class="container clearfix">
	
		<div id="main" class="clearfix" role="main">

			<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
		
				<?php get_template_part( 'content' ); ?>

					<?php //comments_template( '', true ); //moved to content.php?>

			<?php endwhile; // end of the loop. ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'bonestheme' ), 'after' => '</div>' ) ); ?>
			<?php else : ?>
		
				<?php not_found('single'); ?>
		
			<?php endif; ?>
	
		</div> <!-- end #main -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
