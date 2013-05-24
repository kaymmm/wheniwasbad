<?php
/*
Template Name: Full Width Page
*/
?>

<?php get_header(); ?>
			
			<div id="content" class="container clearfix">
			
				<header class="page-header">
					
					<h1><?php single_post_title(); ?></h1>
				
				</header> <!-- end page header -->

				<div id="main" class="clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
											
						<section class="post_content">

							<?php the_content(); ?>
					
						</section> <!-- end article section -->
											
					</article> <!-- end article -->
					
					<?php comments_template(); ?>
					
					<?php endwhile; ?>	
					<?php wp_link_pages( $args ); ?>
				<?php else : ?>
				
					<?php not_found(); ?>
				
				<?php endif; ?>
					
			
				</div> <!-- end #main -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>