<?php
/*
Template Name: Full Width Page
*/
?>

<?php get_header(); ?>
			
		<div id="content" class="container clearfix">
			
			<div id="main" class="clearfix" role="main">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<header class="page-header">
					
					<h1><?php single_post_title(); ?></h1>
				
				</header> <!-- end page header -->

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
											
					<section class="post_content">

						<?php the_content(); ?>
						
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'bonestheme' ), 'after' => '</div>' ) ); ?>
					
					</section> <!-- end article section -->
											
				</article> <!-- end article -->
					
				<?php comments_template(); ?>
					
			<?php endwhile; ?>	
					
			<?php else : ?>
				
				<?php not_found('page'); ?>
				
			<?php endif; ?>
					
			
			</div> <!-- end #main -->

		</div> <!-- end #content -->

<?php get_footer(); ?>