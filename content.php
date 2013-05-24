<?php if (is_singular()) : ?>
 	<header class="page-header">
 		<h1><?php the_title(); ?></h1>
 	</header>
 	<div class="row-fluid">
		<?php get_sidebar(); // sidebar 1 ?>
 		<div class="span9">
<?php endif; ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class("row-fluid clearfix"); ?> role="article">
 				<div class="span9">
				<?php if ( ! is_singular()) : ?>
					<header class="entry-header">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					</header>
				<?php endif; ?>
 					<section class="post_content clearfix">
					<?php if ( ! is_singular() && has_post_thumbnail() ): ?>
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( "wpbs-featured" ); ?></a>
					<?php endif; ?>
					<?php if (! is_singular() && of_get_option('use_excerpts')) : ?>
						<?php the_excerpt(); ?>
					<?php else: ?>
						<?php the_content( __("<span class='btn btn-primary pull-right'>Read more &raquo;</span>","bonestheme") ); ?>
					<?php endif; ?>
 					</section> <!-- post-content -->
				<?php if (is_singular()) : ?>
					<?php wp_link_pages( $args ); ?>
					<?php comments_template( '', true ); ?>
				<?php endif; ?>
				</div>
				<div class="span3">
					<?php get_template_part('postmeta',get_post_type()); ?>
 				</div>
 			</article>
<?php if (is_singular()) : ?>
		</div> <!-- span9 -->
	</div> <!-- row-fluid -->
<?php endif; ?>