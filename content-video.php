<?php
global $wheniwasbad_options;
?>

<?php if (is_singular()) : ?>
<div <?php post_class('col-xs-12'); ?>>
<!-- content single page tempate -->
	<?php
		the_content();
		wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'gcwordpresstheme' ), 'after' => '</div>' ) );
	?>

</div>
<?php else :?>

<?php $show_blog_sidebar = $wheniwasbad_options['blog_sidebar'];

if ($show_blog_sidebar) {
	$sidebar_position = $wheniwasbad_options['blog_sidebar_position'];
} else {
	$sidebar_position = 'left'; // default so postmeta is positioned on the right
}


$content_class = '';
if ( $sidebar_position == 'right' ) {
	$postmeta_class = 'col-xs-12 col-sm-3 col-sm-pull-9';
	$content_class .= 'col-xs-12 col-sm-9 col-sm-push-3';
} else {
	$postmeta_class = 'col-xs-12 col-sm-3';
	$content_class .= 'col-xs-12 col-sm-9';
}


	$featured_video = get_post_meta( get_the_id(), 'use_featured_video', true );
	$featured_video_url = get_post_meta( get_the_id(), 'featured_video_url', true );
	if ($featured_video && $featured_video_url !== '') {
		$Essence = Essence\Essence::instance( );
		$opts = array('maxwidth' => 800, 'maxheight' => 600);
		$media = $Essence->embed( $featured_video_url);
		$featured_video_embed = $media->html;
		$featured_video_ratio = $media->width / $media->height;
	}


?>

<article id="post-<?php the_ID(); ?>" <?php post_class("clearfix videeooo"); ?> role="article">
	<div class="<?php echo $content_class; ?>">
	<?php if ( get_the_title() != '' ) : ?>
		<header class="entry-header">
			<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" rel="bookmark"><?php the_title(); ?>
			<?php if (get_post_format() == 'link') : ?>
				<i class="glyphicon glyphicon-external-link"></i>
			<?php endif; ?>
			</a></h3>
		</header>
	<?php endif; ?>

		<?php if ($featured_video_embed !== '') {
			echo "<div class='featured_video'>$featured_video_embed</div>";
		} elseif ( has_post_thumbnail() ) {
		   $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
		   echo '<div class="blog_thumbnail"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" class="pull-left">';
		   echo get_the_post_thumbnail($post->ID, 'thumbnail',array('class' => 'media-object')); 
		   echo '</a></a>';
		} ?>

			<section class="post_content clearfix">

			<?php
				if ( ! is_singular()) {
					if ( $wheniwasbad_options['use_excerpts'] ) {
						the_excerpt();
						echo '<p class="text-right"><a class="read-more btn btn-primary btn-xs" href="'. get_permalink( get_the_ID() ) . '">Read more <i class="glyphicon glyphicon-chevron-right"></i></a>';
					} else {
						the_content( __("<span class='btn btn-primary btn-xs text-right'>Read more <i class='glyphicon glyphicon-chevron-sign-right'></i></span>","wheniwasbad") );
					}
				} else {
					the_content();
					wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'gcwordpresstheme' ), 'after' => '</div>' ) );
					if ( ! is_front_page() )
						comments_template( '', true );
				}
			?>
			</section> <!-- post-content -->


	</div>

	<?php if ($postmeta_class) : ?>

		<div class="<?php echo $postmeta_class; ?>">

			<?php get_template_part('postmeta',get_post_type()); ?>

		</div>

	<?php endif; ?>

</article>

<?php endif; ?>