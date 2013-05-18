<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>
			
	<?php

	$use_carousel = of_get_option('showhidden_slideroptions');
	if ($use_carousel) :

	?>

	<div id="myCarousel" class="carousel">

	    <!-- Carousel items -->
	    <div class="carousel-inner">

	    	<?php
			global $post;
			$tmp_post = $post;
			$show_posts = of_get_option('slider_options');
			$args = array( 'numberposts' => $show_posts ); // set this to how many posts you want in the carousel
			$myposts = get_posts( $args );
			$post_num = 0;
			foreach( $myposts as $post ) :	setup_postdata($post);
				$post_num++;
				$post_thumbnail_id = get_post_thumbnail_id();
				$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'wpbs-featured-carousel' );
			?>

		    <div class="<?php if($post_num == 1){ echo 'active'; } ?> item">
		    	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'wpbs-featured-carousel' ); ?></a>

			   	<div class="carousel-caption">

	                <h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
	                <p>
	                	<?php
	                		$excerpt_length = 100; // length of excerpt to show (in characters)
	                		$the_excerpt = get_the_excerpt(); 
	                		if($the_excerpt != ""){
	                			$the_excerpt = substr( $the_excerpt, 0, $excerpt_length );
	                			echo $the_excerpt . '... ';
	                	?>
	                	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="btn btn-primary">Read more &rsaquo;</a>
	                	<?php } ?>
	                </p>

                </div>
		    </div>

		    <?php endforeach; ?>
			<?php $post = $tmp_post; ?>

		    </div>

		    <!-- Carousel nav -->
		    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	    </div>
		
	</div> <!-- container for carousel -->

	<?php endif; // ends the if use carousel statement ?>

	<div id="content" class="container clearfix">

		<div id="main" class="clearfix" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
					
					<header>

						<?php 
							$post_thumbnail_id = get_post_thumbnail_id();
							$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'wpbs-featured-home' );
						?>
						
						<div class="hero-unit" style="background-image: url('<?php echo $featured_src[0]; ?>'); background-repeat: no-repeat; background-position: 0 0;">

							<h1><?php the_title(); ?></h1>
							
							<?php echo get_post_meta($post->ID, 'custom_tagline' , true);?>
						
						</div>

					</header>
						
					<section class="row-fluid post_content">
					
					<?php if (is_active_sidebar('sidebar2')) { ?>
					
						<?php get_sidebar('sidebar2'); // sidebar 2 ?>
						
						<div class="span9">
							
							<?php the_content(); ?>
							
						</div>
					
					<?php } else { ?>
							
						<div class="span12">
							
							<?php the_content(); ?>
							
						</div>

						<?php } ?>
												
					</section> <!-- end article header -->
					
				</article> <!-- end article -->
					
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
    
		<?php //get_sidebar(); // sidebar 1 ?>
    
	</div> <!-- end #content -->

<?php get_footer(); ?>