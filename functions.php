<?php
/*
Author: Keith Miyake
URL: htp://keithmiyake.info/wheniwasbad/
Version: 2.0
Modified: 20130905
*/

/* library/translation/translation.php	- adding support for other languages */
// require_once('library/translation/translation.php'); // this comes turned off by default

// Redux Options
require_once('redux-options.php');

// Shortcodes
require_once('library/shortcodes.php');

// Custom Metaboxes and Fields (https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress)
add_action( 'init', 'initialize_cmb_meta_boxes', 9999 );
function initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'library/cmb/init.php' );
	}
}

// custom function for displaying page not found info
add_action( 'init', 'initialize_not_found', 9999 );
function initialize_not_found() {
	if ( !function_exists( 'not_found' ) ) {
		require_once('notfound.php');
	}
}

// Menu output mod for bootstrap
require_once('library/wp-bootstrap-navwalker/wp_bootstrap_navwalker.php');
	
/************** General Theme Setup *****************/

// Clean up unwanted stuff from header
function clean_header() {
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
}
add_action('init', 'clean_header');

// Adding WP 3+ Functions & Theme Support
function theme_setup() {
	add_theme_support('post-thumbnails');      // wp thumbnails (sizes handled in functions.php)
	set_post_thumbnail_size(125, 125, true);   // default thumb size
	add_theme_support( 'custom-background' );  // wp custom background
	add_theme_support('automatic-feed-links'); // rss thingy
	add_theme_support('bootstrap-gallery'); //TODO: add theme support to turn off custom galleries
	add_theme_support( 'post-formats',      // post formats
		array( 
			'aside',   // title less blurb
			'gallery', // gallery of images
			'link',    // quick link to other site
			'image',   // an image
			'quote',   // a quick quote
			'status',  // a Facebook like status update
			'video',   // video 
			'audio',   // audio
			'chat'     // chat transcript 
		)
	);	
	add_theme_support( 'menus' );            // wp menus
	register_nav_menus(                      // wp3+ menus
		array( 
			'main_nav' => 'The Main Menu',   // main nav in header
			'footer_links' => 'Footer Links' // secondary nav in footer
		)
	);
	add_theme_support( 'infinite-scroll', array(
		'container'			=> 'main',
		'footer_widgets'	=> array( 'sidebar-3', 'sidebar-4', 'sidebar-5' ),
        'footer'			=> 'content',
		'wrapper'			=> false
	) );
}

add_action('after_setup_theme','theme_setup');	

// clean up gallery output in wp
add_filter('use_default_gallery_style', '__return_null');







/************* CUSTOM LOGIN PAGE *****************/

// custom login css
function login_css() { wp_enqueue_style( 'login_css', get_template_directory_uri() . '/library/css/login.css', false ); }
function login_url() {  return home_url(); }
function login_title() { return get_option('blogname'); }

// only call on the login page
add_action( 'login_enqueue_scripts', 'login_css', 10 );
add_filter('login_headerurl', 'login_url');
add_filter('login_headertitle', 'login_title');

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'wpbs-featured', 638, 300, true );
add_image_size( 'wpbs-featured-home', 970, 311, true);
add_image_size( 'wpbs-featured-carousel', 970, 400, true);

/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function wpbs_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Main Sidebar',
    	'description' => 'Used on every page BUT the homepage page template.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => 'Homepage Sidebar',
    	'description' => 'Used only on the homepage page template.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
      'id' => 'footer1',
      'name' => 'Footer 1',
      'before_widget' => '<div id="%1$s" class="widget col-md-4 %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer2',
      'name' => 'Footer 2',
      'before_widget' => '<div id="%1$s" class="widget col-md-4 %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer3',
      'name' => 'Footer 3',
      'before_widget' => '<div id="%1$s" class="widget col-md-4 %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));
    
    
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
} // don't remove this bracket!
add_action( 'widgets_init', 'wpbs_register_sidebars' );

/************* Excerpts *********************/
function new_excerpt_more( $more ) {
	return ' [&hellip;]</p><p><a class="read-more btn pull-right" href="'. get_permalink( get_the_ID() ) . '">Read more <i class="icon-chevron-sign-right"></i></a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


/************* Custom Get_Avatar *********************/
function bs_get_avatar($id_or_email,$size='96',$default='',$alt=false,$class='') {
	$ret = get_avatar($id_or_email,$size,$default,$alt);
	if (! empty($class)) {
		return str_replace("class='avatar", "class='avatar ".$class." ", $ret) ;
	}
	return $ret;
}

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function comments_layout($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<div class="comment-author vcard row clearfix">
				<div class="avatar col-md-3">
					<?php echo get_avatar( $comment, $size='75' ); ?>
				</div>
				<div class="col-md-9 comment-text">
					<?php printf('<h4>%s</h4>', get_comment_author_link()) ?>
					<?php edit_comment_link(__('Edit','wheniwasbad'),'<span class="edit-comment btn btn-sm btn-info"><i class="icon-white icon-pencil"></i>','</span>') ?>
                    
                    <?php if ($comment->comment_approved == '0') : ?>
       					<div class="alert-message success">
          				<p><?php _e('Your comment is awaiting moderation.','wheniwasbad') ?></p>
          				</div>
					<?php endif; ?>
                    
                    <?php comment_text() ?>
                    
                    <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
                    
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
			</div>
		</article>
    <!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

// Display trackbacks/pings callback function
function list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
?>
        <li id="comment-<?php comment_ID(); ?>"><i class="icon icon-share-alt"></i>&nbsp;<?php comment_author_link(); ?>
<?php 

}

// Only display comments in comment count (which isn't currently displayed in wp-bootstrap, but i'm putting this in now so i don't forget to later)
add_filter('get_comments_number', 'comment_count', 0);
function comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
	    $comments_by_type = separate_comments(get_comments('status=approve&post_id=' . $id));
	    return count($comments_by_type['comment']);
	} else {
	    return $count;
	}
}

/****************** password protected post form *****/

add_filter( 'the_password_form', 'custom_password_form' );

function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<div class="clearfix"><form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	' . '<p>' . __( "This post is password protected. To view it please enter your password below:" ,'wheniwasbad') . '</p>' . '
	<label for="' . $label . '">' . __( "Password:" ,'wheniwasbad') . ' </label><div class="input-group"><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" class="btn btn-primary" value="' . esc_attr__( "Submit",'wheniwasbad' ) . '" /></div>
	</form></div>
	';
	return $o;
}

/*********** update standard wp tag cloud widget so it looks better ************/

add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );

function my_widget_tag_cloud_args( $args ) {
	$args['number'] = 20; // show less tags
	$args['largest'] = 9.75; // make largest and smallest the same - i don't like the varying font-size look
	$args['smallest'] = 9.75;
	$args['unit'] = 'px';
	return $args;
}

// filter tag cloud output so that it can be styled by CSS
function add_tag_class( $taglinks ) {
    $tags = explode('</a>', $taglinks);
    $regex = "#(.*tag-link[-])(.*)(' title.*)#e";
    $term_slug = "(get_tag($2) ? get_tag($2)->slug : get_category($2)->slug)";

        foreach( $tags as $tag ) {
        	$tagn[] = preg_replace($regex, "('$1$2 label tag-'.$term_slug.'$3')", $tag );
        }

    $taglinks = implode('</a>', $tagn);

    return $taglinks;
}

add_action( 'wp_tag_cloud', 'add_tag_class' );

add_filter( 'wp_tag_cloud','wp_tag_cloud_filter', 10, 2) ;

function wp_tag_cloud_filter( $return, $args )
{
  return '<div id="tag-cloud">' . $return . '</div>';
}

// Enable shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );


// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

/******** Custom Metaboxes ********/
function cmb_add_metaboxes( array $meta_boxes ) {
	$prefix = '_cmb_';
	
	$meta_boxes[] = array(
		'id'         => 'jumbotron_meta_box',
		'title'      => 'Jumbotron',
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on' => array( 'key' => 'page-template', 'value' => array('page-homepage.php','page-jumbotron.php') ),
		'fields' => array(
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
					), 
		    )
		)
	);
	
	foreach($GLOBALS['wp_registered_sidebars'] as $key => $val) {
		$sidebar_list[] = array(
			'value' => $key,
			'name' => $val['name']
		);
	}
	$meta_boxes[] = array(
		'id'         => 'sidebar_options_meta_box',
		'title'      => 'Sidebar',
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on' => array( 'key' => 'page-template', 'value' => array('page-homepage.php','page-jumbotron.php','page.php') ),
		'fields' => array(
		    array(  
		        'name'=> 'Sidebar Position',  
		        'desc'  => 'Select the visibility and position of sidebars for this page.',  
		        'id'    => 'sidebar_position',
		        'type'  => 'select',
				'options' => array(
					array('value' => 'none', 'name' => 'No Sidebar'),
					array('value' => 'left', 'name' => 'Left Sidebar'), 
					array('value' => 'right', 'name' => 'Right Sidebar')
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
	
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'cmb_add_metaboxes' );

/******** Homepage Template ********/
/*
// Add the Meta Box to the homepage template
function add_jumbotron_meta_box() {  
	global $post;

	$prefix = 'custom_';  
	$custom_meta_fields = array(  
	    array(  
	        'label'=> 'Jumbotron Contents',  
	        'desc'  => 'Displayed in place of a page title. Only used on homepage and jumbotron templates. HTML can be used.',  
	        'id'    => 'jumbotron_contents',  
	        'type'  => 'textarea' 
	    )  
	);

	$post_id = $post->ID;
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

	if ( $template_file == 'page-homepage.php' || $template_file == 'page-jumbotron.php' ){
	    add_meta_box(  
	        'jumbotron_meta_box', // $id  
	        'Jumbotron Contents', // $title  
	        'wiwb_show_meta_box', // $callback  
	        'page', // $page  
	        'normal', // $context  
	        'high', // $priority
			$custom_meta_fields ); // $callback_args
    }
}
add_action( 'add_meta_boxes', 'add_jumbotron_meta_box' );

function add_sidebar_options_meta_box() {  
	global $post;

	$post_id = $post->ID;
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
	foreach($GLOBALS['wp_registered_sidebars'] as $key => $val) {
		$sidebar_list[$key] = $val['name'];
	}
	$sidebar_options_meta_fields = array(  
	    array(  
	        'label'=> 'Sidebar Position',  
	        'desc'  => 'Select the visibility and position of sidebars for this page.',  
	        'id'    => 'sidebar_position',
	        'type'  => 'select',
			'options' => array('none'=>'No Sidebar','left'=>'Left Sidebar', 'right'=>'Right Sidebar')
	    ),
	    array(  
	        'label'=> 'Widget Group',  
	        'desc'  => 'Select a widget group to display in the sidebar on this page.',  
	        'id'    => 'sidebar_widgets',
	        'type'  => 'select',
			'options' => $sidebar_list
	    )
	);
	$haystack = array('page-homepage.php','page-jumbotron.php','page.php');
	if ( in_array($template_file,$haystack ) ) {
	    add_meta_box(
	        'sidebar_options_meta_box', // $id  
	        'Widget Sidebar', // $title  
	        'wiwb_show_meta_box', // $callback
	        'page', // $page  
	        'normal', // $context  
	        'default', // $priority
			$sidebar_options_meta_fields); // $callback_args  
    }
}
add_action( 'add_meta_boxes', 'add_sidebar_options_meta_box' );

// The Meta Box Callback  
function wiwb_show_meta_box($post, $metabox) {  
  //global $post;
  // Use nonce for verification
  wp_nonce_field( basename( __FILE__ ), 'wpbs_nonce' );
    
  // Begin the field table and loop
  echo '<table class="form-table">';

  $custom_meta_fields = $metabox['args'];

  foreach ( $custom_meta_fields as $field ) {
      // get value of this field if it exists for this post  
      $meta = get_post_meta($post->ID, $field['id'], true);  
      // begin a table row with  
      echo '<tr> 
              <th><label for="'.$field['id'].'"><strong>'.$field['label'].'</strong></label><br /><span class="description">'.$field['desc'].'</span></th> 
              <td>';  
              switch($field['type']) {  
                  // select  
				  case 'select':
				  $options = $field['options'];
				  echo '<select name="'.$field['id'].'" id="'.$field['id'].'" />';
				  foreach ($options as $key => $val) {
					  $selected = ($meta == $key) ? ' selected' : '';
					  echo '<option value="'.$key.'"'.$selected.'>'.$val.'</option>';
				  }
				  echo '</select>';
				  break;
				  // text
                  case 'text':  
                      echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="60" />';  
                  break;
                  
                  // textarea  
                  case 'textarea':  
                      echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="80" rows="4">'.$meta.'</textarea>';  
                  break;  
              } //end switch  
      echo '</td></tr>';  
  } // end foreach  
  echo '</table>'; // end table  
}  

// Save the Post Meta Data  
function wiwb_save_post_meta( $post_id ) {    
  
    // verify nonce  
    if ( !isset( $_POST['wpbs_nonce'] ) || !wp_verify_nonce($_POST['wpbs_nonce'], basename(__FILE__)) )  
        return $post_id;

    // check autosave
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;

    // check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return $post_id;
        } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
    }
  
    // loop through fields and save the data  
    foreach ( $custom_meta_fields as $field ) {
        $old = get_post_meta( $post_id, $field['id'], true );
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta( $post_id, $field['id'], $new );
        } elseif ( '' == $new && $old ) {
            delete_post_meta( $post_id, $field['id'], $old );
        }
    } // end foreach
}
add_action( 'save_post', 'wiwb_save_post_meta' );
*/

/******* Misc. Filters *********/

// Add thumbnail class to thumbnail links
function add_class_attachment_link( $html ) {
    $postid = get_the_ID();
    $html = str_replace( '<a','<a class="img-thumbnail"',$html );
    return $html;
}
add_filter( 'wp_get_attachment_link', 'add_class_attachment_link', 10, 1 );

// Add lead class to first paragraph
function first_paragraph( $content ){
    global $post;

    // if we're on the homepage, don't add the lead class to the first paragraph of text
    if( is_page_template( 'page-homepage.php' ) )
        return $content;
    else
        return preg_replace('/<p([^>]+)?>/', '<p$1 class="lead">', $content, 1);
}
add_filter( 'the_content', 'first_paragraph' );

// Filter post title for tumblr-style "link" post format
function sd_link_filter($link, $post) {
     if (has_post_format('link', $post)) {
		 if (get_post_meta($post->ID, 'LinkFormatURL', true)) {
	          $link = get_post_meta($post->ID, 'LinkFormatURL', true);
	     } else {
		 // look for the first URL in the post content
		 	if (preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $post->post_content, $match)) {
				$link = $match[0][0];
			}
		 }
	 }
     return $link;
}
add_filter('post_link', 'sd_link_filter', 10, 2);


// Add Twitter Bootstrap's standard 'active' class name to the active nav link item
add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );

function add_active_class($classes, $item) {
	if( $item->menu_item_parent == 0 && in_array('current-menu-item', $classes) ) {
    $classes[] = "active";
	}
  
  return $classes;
}

// enqueue styles
if( !function_exists("theme_styles") ) {  
    function theme_styles() { 
        // This is the compiled css file from LESS - this means you compile the LESS file locally and put it in the appropriate directory if you want to make any changes to the master bootstrap.css.
		if (!is_admin()){
        wp_register_style( 'bootstrap', get_template_directory_uri() . '/library/css/bootstrap-themed.css', array(), '2.3.2', 'all' );
        wp_register_style( 'bootstrap-docs', get_template_directory_uri() . '/library/css/docs.css', array(), '2.3.2', 'all' );
		wp_register_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.min.css', array(), '3.1.1', 'all' );
		wp_register_style( 'font-awesome-ie7', '//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome-ie7.min.css', array(), '3.1.1', 'all' );			
        wp_register_style( 'theme-base', get_stylesheet_uri(), array(), '1.0', 'all' );
        
        wp_enqueue_style( 'bootstrap' );
        wp_enqueue_style( 'bootstrap-responsive' );
        wp_enqueue_style( 'bootstrap-docs' );
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'font-awesome-ie7' );
        wp_enqueue_style( 'theme-base');
		}
    }
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );	
add_action( 'wp_head', function() {
	include('redux-styles.php');
});

// enqueue javascript
if( !function_exists( "theme_js" ) ) {  
  function theme_js(){
	  if (!is_admin()) {
		  /*
	wp_register_script( 'bootstrap-transition', get_template_directory_uri() . '/library/bootstrap/js/bootstrap-transition.js', array('jquery'), '2.3.2', true );
    wp_register_script( 'bootstrap-affix', get_template_directory_uri() . '/library/bootstrap/js/bootstrap-affix.js', array('jquery'), '2.3.2', true );
	wp_register_script( 'bootstrap-alert', get_template_directory_uri() . '/library/bootstrap/js/bootstrap-alert.js', array('jquery'), '2.3.2', true );
	wp_register_script( 'bootstrap-button', get_template_directory_uri() . '/library/bootstrap/js/bootstrap-button.js', array('jquery'), '2.3.2', true );
	wp_register_script( 'bootstrap-carousel', get_template_directory_uri() . '/library/bootstrap/js/bootstrap-carousel.js', array('jquery'), '2.3.2', true );
	wp_register_script( 'bootstrap-collapse', get_template_directory_uri() . '/library/bootstrap/js/bootstrap-collapse.js', array('jquery','bootstrap-transition'), '2.3.2', true );
	wp_register_script( 'bootstrap-dropdown', get_template_directory_uri() . '/library/bootstrap/js/bootstrap-dropdown.js', array('jquery'), '2.3.2', true );
	wp_register_script( 'bootstrap-modal', get_template_directory_uri() . '/library/bootstrap/js/bootstrap-modal.js', array('jquery'), '2.3.2', true );
	wp_register_script( 'bootstrap-tooltip', get_template_directory_uri() . '/library/bootstrap/js/bootstrap-tooltip.js', array('jquery'), '2.3.2', true );
	wp_register_script( 'bootstrap-popover', get_template_directory_uri() . '/library/bootstrap/js/bootstrap-popover.js', array('jquery','bootstrap-transition','bootstrap-tooltip'), '2.3.2', true );
	wp_register_script( 'bootstrap-scrollspy', get_template_directory_uri() . '/library/bootstrap/js/bootstrap-scrollspy.js', array('jquery'), '2.3.2', true );
	wp_register_script( 'bootstrap-tab', get_template_directory_uri() . '/library/bootstrap/js/bootstrap-tab.js', array('jquery'), '2.3.2', true );
	wp_register_script( 'bootstrap-typeahead', get_template_directory_uri() . '/library/bootstrap/js/bootstrap-typeahead.js', array('jquery'), '2.3.2', true );

	wp_enqueue_script('bootstrap-transition');
    wp_enqueue_script('bootstrap-affix');
	wp_enqueue_script('bootstrap-alert');
	wp_enqueue_script('bootstrap-button');
	wp_enqueue_script('bootstrap-collapse');
	wp_enqueue_script('bootstrap-dropdown');
	wp_enqueue_script('bootstrap-modal');
	wp_enqueue_script('bootstrap-tooltip');
	wp_enqueue_script('bootstrap-popover');
	wp_enqueue_script('bootstrap-scrollspy');
	wp_enqueue_script('bootstrap-tab'); */
//	wp_enqueue_script('bootstrap-typeahead'); //disabled since it's not used

	  //use CDN for loading Bootstrap
	wp_register_script('bootstrap', '//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js', array('jquery'), '2.3.1', true);
	wp_enqueue_script('bootstrap');

    wp_register_script( 'wpbs-bones-scripts', get_template_directory_uri() . '/library/js/scripts.js',array('jquery'),'1.2', true );
    wp_register_script( 'bones-modernizr', get_template_directory_uri() . '/library/js/modernizr.custom.min.js', array(), '2.5.3', true );
	// only enqueue the following script when needed, but register it so that it's available.
	wp_register_script( 'bs-tooltips',get_template_directory_uri() . '/library/js/bs-tooltips.js',array('jquery','bootstrap'),'1.1', true );
	
	wp_enqueue_script('wpbs-bones-scripts');
    wp_enqueue_script('bones-modernizr');
	}
  }
}
add_action( 'wp_enqueue_scripts', 'theme_js' );	
// IE js hacks
add_action( 'wp_head', function() {
	echo '<!--[if lt IE 9]>
	<script src="//css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->';
} );
add_action( 'wp_footer', function() {
	echo '<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
	<script>window.attachEvent(\'onload\',function(){CFInstall.check({mode:\'overlay\'})})</script>
<![endif]-->';
} );

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bs_wpsearch($form) {
	$form = '<form action="' . home_url( '/' ) . '" method="get" class="form-control">
    <fieldset>
		<div class="clearfix input-group">
			<input type="text" name="s" id="search" class="search-query input-medium" placeholder="' . __("Search","wheniwasbad") . '" value="' . get_search_query() . '" /><button type="submit" class="btn btn-primary" title="' . __("Search","wheniwasbad") . '" ><i class="icon-search"></i></button>
        </div>
    </fieldset>
</form>';
	return $form;
}
add_filter( 'get_search_form', 'bs_wpsearch' );


/************* NAVIGATION MENUS **************/
function main_nav() {
	// display the primary menu
    wp_nav_menu( 
    	array( 
    		'menu' => 'main_nav', /* menu name */
    		'menu_class' => 'nav navbar-nav',
    		'theme_location' => 'main_nav', /* where in the theme it's assigned */
    		'container' => 'false', /* container class */
			/*'container-class' => '', */
    		'fallback_cb' => 'nav_menu_fallback', /* menu fallback */
    		'depth' => '2', /* Bootstrap 3.0 doesn't support additional depths */
    		'walker' => new wp_bootstrap_navwalker()
    	)
    );
}

function footer_links() { 
	// display the footer menu
    wp_nav_menu(
    	array(
    		'menu' => 'footer_links', /* menu name */
			'menu_class' => 'nav nav-pills dropup',
    		'theme_location' => 'footer_links', /* where in the theme it's assigned */
    		'container' => 'div',
			'container_class' => 'pull-right', /* container class */
    		'fallback_cb' => 'nav_menu_fallback', /* menu fallback */
			'depth' => '2', /* Bootstrap 3.0 doesn't support additional depths */
			'walker' => new Bootstrap_Walker()
    	)
	);
}


// this is the fallback for header menu
function nav_menu_fallback() { 
	// Figure out how to make this output bootstrap-friendly html
	wp_page_menu(
		array(
			'show_home' => 'Home',
			'menu_class' => 'nav',
			'sort_column' => 'menu_order, post_title',
			'depth' => 0
		)
	); 
}

/************* Page Display Classes **************/

function page_navi() {
	global $wp_query;
	$bignum = 999999999;
	if ( $wp_query->max_num_pages <= 1 )
		return;

	echo '<nav class="pagination">';
  
	echo paginate_links( array(
		'base'       => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
		'format'     => '',
		'current'     => max( 1, get_query_var('paged') ),
		'total'     => $wp_query->max_num_pages,
		'prev_text'   => '&larr;',
		'next_text'   => '&rarr;',
		'type'      => 'list',
		'end_size'    => 3,
		'mid_size'    => 3
	) );

	echo '</nav>';
}

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');


?>