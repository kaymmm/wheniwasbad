	<?php if (is_single()) : ?>
	<header class="page-header">
		<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header>
	<div class="row-fluid">
		<?php get_sidebar(); // sidebar 1 ?>
		<div class="span9">
	<?php endif; ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class("clearfix row-fluid"); ?> role="article">
				<div class="span9">
					<?php if (!is_single()) : ?>
					<header class="entry-header">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					</header>
					<?php endif; ?>
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
					<?php if (is_single()) : ?>
						<?php comments_template( '', true ); ?>
					<?php endif; ?>
				</div>
				<div class="span3">
					<?php get_template_part('postmeta',get_post_type()); ?>
				</div>
			</article>

	<?php if (is_single()) : ?>
		</div> <!-- span9 -->
	</div> <!-- row-fluid -->
	<?php endif; ?>