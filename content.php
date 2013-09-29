<?php 
global $wheniwasbad_options; 
if (is_page()) {
	$sidebar_position = get_post_meta($post->ID, 'sidebar_position' , true);
} else {
	$sidebar_position = $wheniwasbad_options['blog_sidebar_position'];
}

if ( ! is_singular() || ! is_page() ) {
	if ( $sidebar_position == 'right' ) {
		$postmeta_class = 'col-md-3 col-md-pull-9';
		$content_class = 'col-md-9 col-md-push-3';
	} else {
		$postmeta_class = 'col-md-3';
		$content_class = 'col-md-9';
	} 
} else {
	$postmeta_class = '';
	$content_class = 'col-md-12';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("row clearfix"); ?> role="article">
	<div class="<?php echo $content_class; ?>">
	<?php if ( ! is_singular() && get_the_title() != '' ) : ?>
		<header class="entry-header">
			<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" rel="bookmark"><?php the_title(); ?>
				<?php if (get_post_format() == 'link') : ?>
					<i class="icon-external-link"></i>
				<?php endif; ?>
			</a></h3>
		</header>
	<?php endif; ?>
		<section class="post_content clearfix">
		<?php 
			if ( ! is_singular()) :
				if ( has_post_thumbnail() ):
					_e('<a href="' . get_permalink() . '" ' . the_title_attribute(array('before' => 'title="', 'after' => '"', 'echo' => false)) . '>' . get_the_post_thumbnail( "wpbs-featured" ) . '</a>');
				endif;
				if ( $wheniwasbad_options['use_excerpts'] ) :
					the_excerpt();
				else:
					the_content( __("<span class='btn btn-primary pull-right'>Read more <i class='icon-chevron-sign-right'></i></span>","wheniwasbad") );
				endif;
			else:
				the_content();
				//wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wheniwasbad' ), 'after' => '</div>' ) );
			endif; 
		?>
		</section> <!-- post-content -->

	</div>

	<div class="<?php echo $postmeta_class; ?>">

		<?php get_template_part('postmeta',get_post_type()); ?>

	</div>

</article>