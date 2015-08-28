<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage WhenIWasBad
 * @since WhenIWasBad 3.1
 */
?>

<div <?php post_class('col-xs-12'); ?>>
<!-- content-page tempate -->
	<?php
		the_content();
		wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'gcwordpresstheme' ), 'after' => '</div>' ) );
	?>

</div>