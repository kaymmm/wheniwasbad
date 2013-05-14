	<article id="post-<?php the_ID(); ?>" <?php post_class('row-fluid clearfix'); ?>>
		<div class="span9">
			<header class="entry-header">
				<span class="label-postformat-link clearfix"><i class="icon-link"></i></span>
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" rel="nofollow"><?php the_title(); ?> <i class="icon-external-link"></i></a></h2>
			</header>
			<section class="post_content row-fluid clearfix">
				<?php the_content( __( '<span class="btn">Continue reading <i class="icon-double-angle-right"></i></span>', 'bonestheme' ) ); ?>
			</section><!-- .post_content -->
		</div>
		<div class="span3">
			<?php get_template_part('postmeta','link'); ?>
		</div>
	</article><!-- #post -->
