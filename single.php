<?php get_header(); ?>
			
			<div id="content" class="clearfix row-fluid">
				
				<?php get_sidebar(); // sidebar 1 ?>
			
				<div id="main" class="span9 clearfix" role="main">

					<?php while ( have_posts() ) : the_post(); ?>
				
						<?php get_template_part( 'content', get_post_format() ); ?>

						<?php comments_template( '', true ); ?>

					<?php endwhile; // end of the loop. ?>
			
				</div> <!-- end #main -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>