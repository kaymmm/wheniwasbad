<?php
/*
Template Name: Right Sidebar
*/
?>

<?php get_header(); ?>
	
	<div id="content" class="container clearfix">
	
		<div id="main" class="clearfix" role="main">

			<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
		
				<header class="page-header">
					<h1><?php the_title(); ?></h1>
				</header>
				<div class="row-fluid">
					<div class="span9">
						<article id="post-<?php the_ID(); ?>" <?php post_class("clearfix row-fluid"); ?> role="article">
							<div class="span3">
								<?php get_template_part('postmeta'); ?>
							</div>
							<div class="span9">
								<section class="post_content clearfix">
									<?php the_content( __("<span class='btn btn-primary'>Read more &raquo;</span>","bonestheme") ); ?>
								</section> <!-- post-content -->
								<?php comments_template( '', true ); ?>
							</div>
						</article>
					</div> <!-- span9 -->
					<?php get_sidebar(); // sidebar 1 ?>
				</div> <!-- row-fluid -->

			<?php endwhile; // end of the loop. ?>
			<?php wp_link_pages( $args ); ?>
			<?php else : ?>
		
				<?php not_found(); ?>
		
			<?php endif; ?>
	
		</div> <!-- end #main -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
