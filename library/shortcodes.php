<?php

// shortcodes

// Gallery shortcode

// Override the standard gallery shortcode
// originally from https://github.com/retlehs/roots
// modified to support blueimp gallery http://blueimp.github.io/Gallery/
function bootstrap_gallery($attr) {
	wp_enqueue_style('blueimp-gallery-css');
	wp_enqueue_script('blueimp-gallery-js');
	wp_enqueue_script('blueimp-gallery-init-js');

	$post = get_post();

	static $instance = 0;

	$instance++;

	if (!empty($attr['ids'])) {
		if (empty($attr['orderby'])) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	$output = apply_filters('post_gallery', '', $attr);

	if ($output != '') {
		return $output;
	}

	if (isset($attr['orderby'])) {
		$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
		if (!$attr['orderby']) {
			unset($attr['orderby']);
		}
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => '',
		'icontag'    => '',
		'captiontag' => '',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'showcontrols'	=> 'true',
		'showtooltips'	 => 'true',
		'showcaptions'	=> 'true'
	), $attr));

	$id = intval($id);

	if ($order === 'RAND') {
		$orderby = 'none';
	}

	if (!empty($include)) {
		$_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
		$attachments = array();
		foreach ($_attachments as $key => $val) {
		  $attachments[$val->ID] = $_attachments[$key];
		}
	} elseif (!empty($exclude)) {
		$attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
	} else {
		$attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
	}

	if (empty($attachments)) {
		return '';
	}

	if (is_feed()) {
		$output = "\n";
		foreach ($attachments as $att_id => $attachment) {
		  $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		}
		return $output;
	}

	$col_span = floor(12/$columns);
	$col_gutter = 10/$columns;
	$col_width = 100/$columns-$col_gutter;
	$i=1;

	$gallery_id = 'blueimp-gallery-links_'.rand();

	$mosaic = '<div id="'.$gallery_id.'" class="clearfix">';
	foreach ($attachments as $id => $attachment) {
		$img_lg = wp_get_attachment_image_src($id,'large',false);
		$img_sm = wp_get_attachment_image_src($id,'thumbnail',false);
		
		$img = '<img src="' . $img_sm[0] . '" alt="' . $attachment->post_title . '"  />';
		if ($showtooltips) $tooltip = ' rel="tooltip" data-original-title="' . $attachment->post_excerpt . '" ';
		if ($showcaptions) $caption = ' data-description="'.$attachment->post_excerpt.'" ';
		$mosaic .= '<a href="' . $img_lg[0] . '" class="thumbnail pull-left" style="width: ' . $col_width . '%; margin: 0 2px 2px 0;" '.$tooltip.$caption.' data-gallery>'.$img.'</a>';
		if (trim($attachment->post_excerpt)) {
		  $mosaic .= '<p class="caption hidden">' . wptexturize($attachment->post_excerpt) . '</p>';
		}
		
		//$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_url($id) : get_attachment_link($id);
		
	}

	$mosaic .= "</div>";
	
	$mosaic .= '<script type="text/javascript">jQuery( document ).ready( function() { blueimpGalleryInit("'.$gallery_id.'"); });</script>';
	
	if ($showcontrols) {
		$mosaic .= '<script>jQuery( document ).ready( function() {if ( ! jQuery( "#blueimp-gallery").hasClass( "blueimp-gallery-controls" ) ) jQuery( "#blueimp-gallery").addClass("blueimp-gallery-controls"); });</script>';
	}
	
	if ($showtooltips) {
		wp_enqueue_script('bs-tooltips'); // bootstrap hover tooltips
	}

	return $mosaic;
}
//if (current_theme_supports('bootstrap-gallery')) {
remove_shortcode('gallery','gallery_shortcode');
add_shortcode('gallery', 'bootstrap_gallery');
//}


// Buttons
function buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'default', /* primary, default, info, success, danger, warning, inverse */
	'size' => 'default', /* mini, small, default, large */
	'url'  => '',
	'text' => '', 
	), $atts ) );
	
	if($type == "default"){
		$type = "";
	}
	else{ 
		$type = "btn-" . $type;
	}
	
	if($size == "default"){
		$size = "";
	}
	else{
		$size = "btn-" . $size;
	}
	
	$output = '<a href="' . $url . '" class="btn '. $type . ' ' . $size . '">';
	$output .= $text;
	$output .= '</a>';
	
	return $output;
}

add_shortcode('button', 'buttons'); 

// Alerts
function alerts( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">&times;</a>';
	}
	$output .= $text . '</div>';
	
	return $output;
}

add_shortcode('alert', 'alerts');

// Block Messages
function block_messages( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-block alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">&times;</a>';
	}
	$output .= '<p>' . $text . '</p></div>';
	
	return $output;
}

add_shortcode('block-message', 'block_messages'); 

// Block Messages
function blockquotes( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'float' => '', /* left, right */
	'cite' => '', /* text for cite */
	), $atts ) );
	
	$output = '<blockquote';
	if($float == 'left') {
		$output .= ' class="pull-left"';
	}
	elseif($float == 'right'){
		$output .= ' class="pull-right"';
	}
	$output .= '><p>' . $content . '</p>';
	
	if($cite){
		$output .= '<small>' . $cite . '</small>';
	}
	
	$output .= '</blockquote>';
	
	return $output;
}

add_shortcode('blockquote', 'blockquotes'); 
 



?>