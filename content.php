	<article id="post-<?php the_ID(); ?>" <?php post_class("clearfix row-fluid"); ?> role="article">
		<div class="span9">
			<header class="entry-header">
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</header>
			<section class="post_content row-fluid clearfix">
			<?php if ( ! is_single() && has_post_thumbnail() ): ?>
				<div class="span3">
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( "wpbs-featured" ); ?></a>
				</div>
				<div class="span9">
			<?php else : ?>
				<div class="span12">
			<?php endif; ?>
					<?php the_content( __("<span class='btn btn-primary'>Read more &raquo;</span>","bonestheme") ); ?>
				</div>
			</section> <!-- post-content -->
		</div>
		<div class="span3">
			<?php get_template_part('postmeta',get_post_type()); ?>
		</div>
	</article>