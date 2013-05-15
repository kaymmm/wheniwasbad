<?php get_header(); ?>
			
			<div id="content" class="clearfix row-fluid">			
			
				<div id="main" class="span12 clearfix" role="main">

					<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
				
						<?php get_template_part( 'content' ); ?>

								<?php //comments_template( '', true ); //moved to content.php?>

					<?php endwhile; // end of the loop. ?>
					<?php else : ?>
				
						<?php not_found('author'); ?>
				
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>