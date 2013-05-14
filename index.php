<?php get_header(); ?>
			
		<?php
		$blog_hero = of_get_option('blog_hero');
		if ( $blog_hero && is_front_page() ) : ?>
			<div class="clearfix row-fluid">
				<div class="hero-unit">
				
					<h1><?php bloginfo('title'); ?></h1>
					
					<p><?php bloginfo('description'); ?></p>
				
				</div>
			</div>
		<?php endif; ?>
			
			<div id="content" class="clearfix row-fluid">

				<div id="main" class="span12 clearfix" role="main">

					<?php while ( have_posts() ) : the_post(); ?>
				
						<?php get_template_part( 'content', get_post_format() ); ?>

						<?php comments_template( '', true ); ?>

					<?php endwhile; // end of the loop. ?>
					
					<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
						
						<?php page_navi(); // use the page navi function ?>
						
					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "bonestheme")) ?></li>
								<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "bonestheme")) ?></li>
							</ul>
						</nav>
					<?php } ?>		
			
				</div> <!-- end #main -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>