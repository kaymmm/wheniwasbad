	<article id="post-<?php the_ID(); ?>" <?php post_class("row-fluid clearfix"); ?> role="article">
		<div class="span9">
			<span class="label-postformat-status clearfix"><i class="icon-info-sign"></i></span>
			<?php if ( get_the_title() != '') : ?>
			<header class="entry-header">
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<span class="label-postformat-status clearfix"><i class="icon-info-sign"></i></span>
			</header>
			<?php endif; ?>
			<section class="post_content clearfix">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bonestheme' ) ); ?>
			</section><!-- .post_content -->
		</div>
		<div class="span3">
			<?php get_template_part('postmeta','status'); ?>
		</div>
	</article>