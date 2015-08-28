<?php
/*
Template Name: Blank Page
*/
?>

<?php get_header(); ?>

<div id="content" class="content-no-margin clearfix parallax-wheniwasbad" data-type="background" data-bg-speed="15" >

<?php /* add the contents of additional pages */
	$additional_pages = get_post_meta( get_the_id(), 'homepage_additional_pages_above', false );
	foreach ($additional_pages as $addon_page_id) {
		$addon_page = get_post($addon_page_id);
		//echo "<div class='container'>\n";
		//echo "<h1>" . $addon_page->post_title . "</h1>\n";
		echo "<div class='pull-left'>";
		echo edit_post_link("Edit <span class='glyphicon glyphicon-edit'></span>",'','',$addon_page_id) . "</div>\n";
		echo apply_filters('the_content',$addon_page->post_content) . "\n";
		//echo "</div>\n";
	}
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php get_template_part( 'content', 'page' ); ?>

	<?php if ( comments_open() || get_comments_number() ) {
		comments_template();
	} ?>

<?php endwhile; ?>

<?php else : ?>

	<?php not_found(); ?>

<?php endif; ?>

<?php /* add the contents of additional pages */
	$additional_pages = get_post_meta( get_the_id(), 'homepage_additional_pages_below', false );
	foreach ($additional_pages as $addon_page_id) {
		$addon_page = get_post($addon_page_id);
		//echo "<div class='container'>\n";
		//echo "<h1>" . $addon_page->post_title . "</h1>\n";
		echo "<div class='pull-left'>";
		echo edit_post_link("Edit <span class='glyphicon glyphicon-edit'></span>",'','',$addon_page_id) . "</div>\n";
		echo apply_filters('the_content',$addon_page->post_content) . "\n";
		//echo "</div>\n";
	}
?>

</div>

<?php get_footer(); ?>