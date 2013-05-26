<?php if (is_singular()) : ?>
 	<header class="page-header">
 		<h1><?php the_title(); ?></h1>
 	</header>
 	<div class="row-fluid">
	<?php if (! is_page_template('page-right-sidebar.php')) : ?>
		<div class="span3">
			<?php get_sidebar(); // sidebar 1 ?>
		</div>
	<?php endif; ?>
 		<div class="span9">
<?php endif; ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class("row-fluid clearfix"); ?> role="article">
				<?php if (is_page_template('page-right-sidebar.php')) : ?>
					<div class="span3">
						<?php get_template_part('postmeta',get_post_type()); ?>
	 				</div>
				<?php endif; ?>
 				<div class="span9">
				<?php if ( ! is_singular()) : ?>
					<header class="entry-header">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					</header>
				<?php endif; ?>
 					<section class="post_content clearfix">
					<?php 
						if ( ! is_singular()) :
							if ( has_post_thumbnail() ):
								_e('<a href="' . get_permalink() . '" ' . the_title_attribute(array('before' => 'title="', 'after' => '"', 'echo' => false)) . '>' . get_the_post_thumbnail( "wpbs-featured" ) . '</a>');
							endif;
							if ( of_get_option('use_excerpts')) :
								the_excerpt();
							else:
								the_content( __("<span class='btn btn-primary pull-right'>Read more <i class='icon-chevron-sign-right'></i></span>","bonestheme") );
							endif;
						else:
							the_content();
							wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'bonestheme' ), 'after' => '</div>' ) );
						endif; 
					?>
 					</section> <!-- post-content -->
				<?php if (is_singular()) : ?>
					<?php comments_template( '', true ); ?>
				<?php endif; ?>
				</div>
			<?php if (! is_page_template('page-right-sidebar.php')) : ?>
				<div class="span3">
					<?php get_template_part('postmeta',get_post_type()); ?>
 				</div>
			<?php endif; ?>
 			</article>
<?php if (is_singular()) : ?>
		</div> <!-- span9 -->
		<?php if (is_page_template('page-right-sidebar.php')) : ?>
			<div class="span3">
				<?php get_sidebar(); // sidebar 1 ?>
			</div>
		<?php endif; ?>
	</div> <!-- row-fluid -->
<?php endif; ?>