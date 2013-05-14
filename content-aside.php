	<article id="post-<?php the_ID(); ?>" <?php post_class('row-fluid clearfix'); ?> role="article">
		<div class="span9">
		<?php if ( get_the_title() != '' ): ?>
			<header class="entry-header">
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</header><!-- .entry-header -->
		<?php endif; ?>
			<section class="post_content row-fluid clearfix">
				<?php the_content( __( '<span class="btn">Continue reading <i class="icon-double-angle-right"></i></span>', 'bonestheme' ) ); ?>
			</section><!-- .post_content -->
		</div>
		<div class="span3">
			<?php get_template_part('postmeta','image'); ?>
		</div>
	</article><!-- #post -->