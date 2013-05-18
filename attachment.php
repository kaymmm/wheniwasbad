<?php
/**
 * The WordPress template hierarchy first checks for any
 * MIME-types and then looks for the attachment.php file.
 *
 * @link codex.wordpress.org/Template_Hierarchy#Attachment_display 
 */ 

get_header(); ?>
			
	<div id="content" class="clearfix container">
	
		<div id="main" class="clearfix" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

				<header class="page-header"> 

					<h1 class="single-title" itemprop="headline">

						<?php if ($post->post_parent) : ?>

							<a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a> &raquo; 

						<?php endif; ?>

						<?php the_title(); ?>

					</h1>

				</header> <!-- end article header -->
				
				<div class="row-fluid">
										
					<div class="span9">
					
						<section class="post_content clearfix" itemprop="articleBody">

							<div class="well">

								<?php if (has_excerpt()) : ?>
									
									<?php the_excerpt(); ?>
									
								<?php endif; ?>

								<p><i class="icon-download-alt"></i> Download <a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php the_title(); ?></a></p>

							</div>
							
							<?php the_content(); ?>

						</section> <!-- end article section -->

						<?php comments_template(); ?>

					</div>

					<div class="span3">

						<?php get_template_part('postmeta','attachment'); ?>

					</div>

				</div>
									
			</article> <!-- end article -->
			
			<?php endwhile; ?>			
			
		<?php else : ?>
		
			<?php not_found('attachment'); ?>
		
		<?php endif; ?>
			
	
		</div> <!-- end #main -->

	</div> <!-- end #content -->

<?php get_footer(); ?>