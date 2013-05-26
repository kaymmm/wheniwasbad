<?php get_header(); ?>
	
	<?php 
	$blog_hero = of_get_option('blog_hero'); 
	$hero_content = of_get_option('blog_hero_content');
	$blog_widgets = of_get_option('blog_sidebar');
	?>

	<?php if ( $blog_hero && $hero_content ) : ?>
	
	<div class="hero-unit">
		
		<?php echo $hero_content; ?>
	
	</div>

	<?php endif; ?>
	
	<div id="content" class="container clearfix">
			
		<div id="wrapper" class="row-fluid clearfix">
				
		<?php if (is_active_sidebar('sidebar1') && $blog_widgets) { ?>
		
			<div class="span3">
				<?php get_sidebar('sidebar1'); // sidebar 2 ?>
			</div>
			
			<div id="main" role="main" class="span9">
							
		<?php } else { ?>
				
			<div id="main" role="main" class="span12">

		<?php } ?>

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
					<?php get_template_part( 'content', get_post_format() ); ?>

					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'bonestheme' ), 'after' => '</div>' ) ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>
		
				<?php else : ?>
			
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "bonestheme"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, there were no posts found.", "bonestheme"); ?></p>
					    </section>
					</article>
		
				<?php endif; ?>

			</div> <!-- end #main -->
		
		</div> <!-- wrapper -->
		
		<?php if (function_exists('page_navi')) : // if expirimental feature is active ?>
			
			<?php page_navi(); // use the page navi function ?>
			
		<?php else : // if it is disabled, display regular wp prev & next links ?>
			<nav class="wp-prev-next pagenavi">
				<ul class="clearfix">
					<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "bonestheme")) ?></li>
					<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "bonestheme")) ?></li>
				</ul>
			</nav>
		<?php endif; ?>
		
    
	</div> <!-- end #content -->

<?php get_footer(); ?>