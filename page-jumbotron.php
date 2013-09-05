<?php
/*
Template Name: Full-width Jumbotron
*/
?>

<?php get_header(); ?>
			
	<header>

		<?php 
			$post_thumbnail_id = get_post_thumbnail_id();
			$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'wpbs-featured-home' );
		?>
	
		<div class="jumbotron" style="background-image: url('<?php echo $featured_src[0]; ?>'); background-repeat: no-repeat; background-position: 0 0;">
		
			<?php echo get_post_meta($post->ID, 'custom_tagline' , true);?>
	
		</div>

	</header>

	<div id="content" class="container clearfix">

		<div id="main" class="clearfix" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
					<section class="row post_content">
													
						<div class="col-md-12">
							
							<?php the_content(); ?>
							
						</div>
												
					</section> <!-- end article header -->
					
				</article> <!-- end article -->
					
			<?php endwhile; ?>	
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wheniwasbad' ), 'after' => '</div>' ) ); ?>
			<?php else : ?>
					
				<article id="post-not-found">
				    <header>
				    	<h1><?php _e("Not Found", "wheniwasbad"); ?></h1>
					</header>
					<section class="post_content">
						<p><?php _e("Sorry, but the requested resource was not found on this site.", "wheniwasbad"); ?></p>
					</section>
				</article>
					
			<?php endif; ?>
			
		</div> <!-- end #main -->
    
	</div> <!-- end #content -->

<?php get_footer(); ?>