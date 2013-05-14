<?php get_header(); ?>

			<div id="content" class="clearfix row-fluid">

				<?php get_sidebar(); // sidebar 1 ?>
			
				<div id="main" class="span9 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
						<?php get_template_part( 'content', get_post_format() ); ?>

						<?php comments_template( '', true ); ?>

					<?php endwhile; ?>	
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "bonestheme"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "bonestheme"); ?></p>
					    </section>
					</article>
					
					<?php endif; ?>
								
				</div> <!-- end #main -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>