<?php
/**
 * Define the metabox and field configurations.
 * The full list of available metabox fields: https://github.com/humanmade/Custom-Meta-Boxes/wiki
 *
 * @param  array $meta_boxes
 * @return array
 */

function cmb_add_metaboxes( array $meta_boxes ) {

	/* Jumbotron */

	$meta_boxes[] = array(
		'title'      => 'Jumbotron',
		'pages'      => 'page', // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_on' => array( 'page-template' => array('page-homepage.php','page-jumbotron.php') ),
		'fields' => array(
			array(
		        'name'=> 'Jumbotron Background Color',
		        'desc'  => 'Pick a background color for the Jumbotron.',  
		        'id'    => 'jumbotron_bg_color',
		        'type'  => 'colorpicker'
		    ),
		    array( 
			    'id'   => 'jumbotron_bg_image', 
			    'name' => 'Jumbotron Background Image', 
			    'desc' => 'Upload or select an image to use as the jumbotron background. Overrides the background color.',
			    'type' => 'image', 
			),
		    array(  
		        'name'=> 'Jumbotron Contents',  
		        'desc'  => 'Displayed in place of a page title. Only used on homepage and jumbotron templates. HTML can be used.',  
		        'id'    => 'jumbotron_contents',  
		        'type'  => 'wysiwyg',
				'options' => array(
					    'wpautop' => true, // use wpautop?
					    'media_buttons' => true, // show insert/upload button(s)
					    //'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
					    'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
					    'tabindex' => '',
					    'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
					    'editor_class' => '', // add extra class(es) to the editor textarea
					    'teeny' => false, // output the minimal editor config used in Press This
					    'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
					    'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
					    'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()	
					) 
		    )
		)
	);


	/* Sidebar Options */
	
	foreach($GLOBALS['wp_registered_sidebars'] as $key => $val) {
		$sidebar_list[$key] = $val['name'];
	}

	$meta_boxes[] = array(
		'id'         => 'sidebar_options_meta_box',
		'title'      => 'Sidebar',
		'pages'      => 'page', // Post type
		'context'    => 'side',
		'priority'   => 'default',
		'fields' => array(
		    array(  
		        'name'=> 'Sidebar Position',  
		        'desc'  => 'Select the visibility and position of sidebars for this page.',  
		        'id'    => 'sidebar_position',
		        'type'  => 'select',
				'options' => array(
					'none' => 'No Sidebar',
					'left' => 'Left Sidebar', 
					'right' => 'Right Sidebar'
				)
		    ),
			array(  
		        'name'=> 'Widget Group',  
		        'desc'  => 'Select a widget group to display in the sidebar on this page.',  
		        'id'    => 'sidebar_widgets',  
		        'type'  => 'select',
				'options' => $sidebar_list
		    )
		)
	);

	/* Display/disable page title? */
	$meta_boxes[] = array(
		'title'      => 'Display Page Meta Info',
		'pages'      => 'page', // Post type
		'context'    => 'normal',
		'priority'   => 'core',
		'show_on' => array( 'page-template' => array('page-homepage.php', 'page-blog.php', 'page-jumbotron.php') ),
		'fields'	=> array(
			array(
				'id'	=> 'display_page_title',
				'name'	=> 'Display the page title for this page?',
				'type'	=> 'checkbox',
				'default' => false
			),
			array(
				'id'	=> 'display_page_meta',
				'name'	=> 'Display the meta info for this page?',
				'desc'	=> 'If checked, the date modified, author, and categories will be shown.',
				'type'	=> 'checkbox',
				'default' => false
			),
		)
	);


	/* Homepage include additional pages */

	$meta_boxes[] = array(
		'title'      => 'Include Other Pages',
		'pages'      => 'page', // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_on' => array( 'page-template' => array('page-homepage.php', 'page-blank.php', 'page-blog.php') ),
		'fields' => array(
			array(
			    'id'       => 'homepage_additional_pages_above',
			    'name'     => 'Include the contents of another page (only the content!) within the homepage, ABOVE the primary content and sidebars.',
			    'type'     => 'post_select',
			    'repeatable'     => true,
			    'use_ajax' => true,
			    'query' => array(
			        'post_type' => 'page'
			    )
			),
			array(
			    'id'       => 'homepage_additional_pages_below',
			    'name'     => 'Include the contents of another page (only the content!) within the homepage, BELOW the primary content and sidebars.',
			    'type'     => 'post_select',
			    'repeatable'     => true,
			    'use_ajax' => true,
			    'query' => array(
			        'post_type' => 'page'
			    )
			),
		)
	);
	/* Carousel */

	$meta_boxes[] = array(
		'title'		=> 'Carousel Options',
		'pages'		=> 'page',
		'context'	=> 'normal',
		'priority'	=> 'default',
		'show_on'	=> array( 'page-template' => array('page-homepage.php') ),
		'fields'	=> array(
			array(
				'id'	=> 'carousel_enable',
				'name'	=> 'Enable carousel for this page?',
				'desc'	=> 'When checked, a carousel slider will be displayed at the top of this page',
				'type'	=> 'checkbox',
				'default' => false
			),
			array(
				'id'	=> 'carousel_categories',
				'name'	=> 'Categories to use for carousel',
				'desc'	=> 'Select one or more categories from which to use posts to populate the carousel',
				'multiple' => true,
				'type'	=> 'taxonomy_select',
				'taxonomy' => 'category'
			),
			array(
				'id'	=> 'carousel_count',
				'name'	=> 'Posts to display',
				'desc'	=> 'Select the number of posts to include in the carousel',
				'type'	=> 'select',
				'default' => '5',
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10'
				)
			),
			array(
				'id'	=> 'carousel_height_ratio',
				'name'	=> 'Carousel Width/Height Ratio',
				'desc'	=> 'Enter a decimal number for the width/height aspect ratio for the carousel.',
				'default' => '1.78',
				'type'	=> 'text_small',
			),
			array(
				'id'	=> 'carousel_only_images',
				'name'	=> 'Only Display Posts with Featured Images',
				'desc'	=> 'Check to only include posts with a featured image.',
				'type'	=> 'checkbox',
			),
			array(
				'id'	=> 'carousel_hide_xs',
				'name'	=> 'Hide Carousel on Mobile Devices?',
				'desc'	=> 'Check to hide the carousel on mobile devices and small screens.',
				'type'	=> 'checkbox',
			)
		)
	);

	
	/* Table of Contents */

	$effect_speed = array(
		'slow' => 'Slow', 
		'medium' => 'Medium',
		'fast' => 'Fast'
	);

	$meta_boxes[] = array(
		'id'         => 'toc_meta_box',
		'title'      => 'Table of Contents Options',
		'pages'      => 'page', // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_on' => array( 'page-template' => array('page-toc.php') ),
		'fields' => array(
		    array(  
		        'name'=> 'DOM Selector',
		        'desc'  => 'Comma separated list of header elements to include in the TOC, in hierarchical order. Default is "h1,h2,h3".',  
		        'id'    => 'toc_selector',  
		        'type'  => 'text_small'
			),
			array(  
		        'name'=> 'TOC Context',
		        'desc'  => 'The container element that holds all of the elements used to generate the TOC. Can be any valid jQuery selector. Default is the container around the main content.',  
		        'id'    => 'toc_context',  
		        'type'  => 'text_small'
			),
			array(  
		        'name'=> 'Show and Hide Child Menu Levels',
		        'desc'  => 'When checked, nested child items are hidden until the parent level is displayed; when unchecked, all items are displayed.',  
		        'id'    => 'toc_showAndHide',  
		        'type'  => 'checkbox'
			),
			array(  
		        'name'=> 'Show Effect',
		        'desc'  => 'Animation effect used to display nested TOC items',  
		        'id'    => 'toc_showEffect',
		        'type'  => 'select',
		        'options' => array(
		        	'none' => 'None',
		        	'fadeIn' => 'Fade In',
		        	'show' => 'Show',
		        	'slideDown' => 'Slide Down'
		        )
			),
			array(  
		        'name'=> 'Show Effect Speed',
		        'desc'  => 'Animation speed used to display nested TOC items',  
		        'id'    => 'toc_showEffectSpeed',
		        'type'  => 'select',
		        'options' => $effect_speed
			),
			array(  
		        'name'=> 'Hide Effect',
		        'desc'  => 'Animation effect used to hide nested TOC items',  
		        'id'    => 'toc_hideEffect',
		        'type'  => 'select',
		        'options' => array(
		        	'none' => 'None',
		        	'fadeOut' => 'Fade Out',
		        	'hide' => 'Hide',
		        	'slideUp' => 'Slide Up',
		        )
			),
			array(  
		        'name'=> 'Hide Effect Speed',
		        'desc'  => 'Animation speed used to hide nested TOC items',  
		        'id'    => 'toc_hideEffectSpeed',
		        'type'  => 'select',
		        'options' => $effect_speed
			),
			array(  
		        'name'=> 'Smooth Scroll',
		        'desc'  => 'Animates the page scroll when specific table of content items are clicked and the page moves up or down.',  
		        'id'    => 'toc_smoothScroll',  
		        'type'  => 'checkbox'
			),
			array(  
		        'name'=> 'Smooth Scroll Speed',
		        'desc'  => 'Animation speed for the smooth scrolling effect.',  
		        'id'    => 'toc_smoothScrollSpeed',  
		        'type'  => 'select',
		        'options' => $effect_speed
			),
			array(  
		        'name'=> 'Item Scroll Offset',
		        'desc'  => 'Offset (in pixels) from the top of the page and the selected TOC item when jumping to that item.',  
		        'id'    => 'toc_scrollTo',  
		        'type'  => 'text_small'
			),
			array(  
		        'name'=> 'Highlight on Scroll',
		        'desc'  => 'When checked, current TOC item will be highlighted (different background color) while scrolling.',  
		        'id'    => 'toc_highlightOnScroll',  
		        'type'  => 'checkbox'
			),
			array(  
		        'name'=> 'Highlight Offset',
		        'desc'  => 'Offset (in pixels) from the top of the page and the selected TOC item when jumping to that item.',  
		        'id'    => 'toc_scrollTo',  
		        'type'  => 'text_small'
			),
			array(  
		        'name'=> 'Ignore Selector',
		        'desc'  => 'jQuery selector for items that should not appear in the TOC.',  
		        'id'    => 'toc_ignoreSelector',  
		        'type'  => 'text_small'
			)			
		)
	);

/* pinterest blog page settings */

	$meta_boxes[] = array(
		'title'      => 'Pinterest Style Grid Options',
		'pages'      => 'page', // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_on' => array( 'page-template' => array('page-blog.php') ),
		'fields' => array(
			array(
				'id'		=> 'pinterest_taxonomy',
				'name'		=> 'Categories to Include',
				'desc'		=> 'Select one or more categories from which to draw posts, or leave blank to include all posts.',
				'type'		=> 'taxonomy_select',
				'multiple'	=> true,
				'taxonomy'	=> 'category'
			),
			array(
				'id'		=> 'pinterest_args',
				'name'		=> '(Advanced) Custom WP_Query Arguments',
				'desc'		=> 'Enter a custom WP_Query string to select/order posts (e.g., "post_type=post&orderby=rand"). Leave blank if you don\'t know what this means.',
				'type'		=> 'text',
			)
		)
	);

	return $meta_boxes;

}
add_filter( 'cmb_meta_boxes', 'cmb_add_metaboxes' );
