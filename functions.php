<?php
/*
Author: Keith Miyake
URL: htp://keithmiyake.info/wheniwasbad/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

// Get Bones Core Up & Running!
require_once('library/bones.php');            // core functions (don't remove)

/* library/translation/translation.php	- adding support for other languages */
// require_once('library/translation/translation.php'); // this comes turned off by default

// Options panel
require_once('library/options-panel.php');

// Shortcodes
require_once('library/shortcodes.php');

// custom function for displaying page not found info
require_once('notfound.php');

// Menu output mods
require_once('library/bootstrap-nav.php');

/************* CUSTOM LOGIN PAGE *****************/

// calling your own login css so you can style it

//Updated to proper 'enqueue' method
//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function bones_login_css() {
	wp_enqueue_style( 'bones_login_css', get_template_directory_uri() . '/library/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function bones_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function bones_login_title() { return get_option('blogname'); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'bones_login_css', 10 );
add_filter('login_headerurl', 'bones_login_url');
add_filter('login_headertitle', 'bones_login_title');


/************* CUSTOMIZE ADMIN *******************/

/*
I don't really recommend editing the admin too much
as things may get funky if WordPress updates. Here
are a few funtions which you can choose to use if
you like.
*/

// Custom Backend Footer
function bones_custom_admin_footer() {
	_e('<span id="footer-thankyou">Developed by <a href="http://yoursite.com" target="_blank">Your Site Name</a></span>. Built using <a href="http://themble.com/bones" target="_blank">Bones</a>.', 'bonestheme');
}

// adding it to the admin area
add_filter('admin_footer_text', 'bones_custom_admin_footer');

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
function bones_register_sidebars() {
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
      'before_widget' => '<div id="%1$s" class="widget span4 %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer2',
      'name' => 'Footer 2',
      'before_widget' => '<div id="%1$s" class="widget span4 %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer3',
      'name' => 'Footer 3',
      'before_widget' => '<div id="%1$s" class="widget span4 %2$s">',
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
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<div class="comment-author vcard row-fluid clearfix">
				<div class="avatar span3">
					<?php echo get_avatar( $comment, $size='75' ); ?>
				</div>
				<div class="span9 comment-text">
					<?php printf('<h4>%s</h4>', get_comment_author_link()) ?>
					<?php edit_comment_link(__('Edit','bonestheme'),'<span class="edit-comment btn btn-small btn-info"><i class="icon-white icon-pencil"></i>','</span>') ?>
                    
                    <?php if ($comment->comment_approved == '0') : ?>
       					<div class="alert-message success">
          				<p><?php _e('Your comment is awaiting moderation.','bonestheme') ?></p>
          				</div>
					<?php endif; ?>
                    
                    <?php comment_text() ?>
                    
                    <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
                    
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
			</div>
		</article>
    <!-- </li> is added by wordpress automatically -->
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
	' . '<p>' . __( "This post is password protected. To view it please enter your password below:" ,'bonestheme') . '</p>' . '
	<label for="' . $label . '">' . __( "Password:" ,'bonestheme') . ' </label><div class="input-append"><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" class="btn btn-primary" value="' . esc_attr__( "Submit",'bonestheme' ) . '" /></div>
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

/******** Homepage Template ********/

// Add the Meta Box to the homepage template
function add_homepage_meta_box() {  
	global $post;

	// Only add homepage meta box if template being used is the homepage template
	// $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : "");
	$post_id = $post->ID;
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

	if ( $template_file == 'page-homepage.php' || $template_file == 'page-hero-unit.php' ){
	    add_meta_box(  
	        'homepage_meta_box', // $id  
	        'Hero Unit Contents', // $title  
	        'show_homepage_meta_box', // $callback  
	        'page', // $page  
	        'normal', // $context  
	        'high'); // $priority  
    }
}

add_action( 'add_meta_boxes', 'add_homepage_meta_box' );

// Field Array  
$prefix = 'custom_';  
$custom_meta_fields = array(  
    array(  
        'label'=> 'Hero Unit Contents',  
        'desc'  => 'Displayed in place of a page title. Only used on homepage and hero-unit templates. HTML can be used.',  
        'id'    => $prefix.'tagline',  
        'type'  => 'textarea' 
    )  
);  

// The Homepage Meta Box Callback  
function show_homepage_meta_box() {  
  global $custom_meta_fields, $post;

  // Use nonce for verification
  wp_nonce_field( basename( __FILE__ ), 'wpbs_nonce' );
    
  // Begin the field table and loop
  echo '<table class="form-table">';

  foreach ( $custom_meta_fields as $field ) {
      // get value of this field if it exists for this post  
      $meta = get_post_meta($post->ID, $field['id'], true);  
      // begin a table row with  
      echo '<tr> 
              <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
              <td>';  
              switch($field['type']) {  
                  // text  
                  case 'text':  
                      echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="60" /> 
                          <br /><span class="description">'.$field['desc'].'</span>';  
                  break;
                  
                  // textarea  
                  case 'textarea':  
                      echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="80" rows="4">'.$meta.'</textarea> 
                          <br /><span class="description">'.$field['desc'].'</span>';  
                  break;  
              } //end switch  
      echo '</td></tr>';  
  } // end foreach  
  echo '</table>'; // end table  
}  

// Save the Data  
function save_homepage_meta( $post_id ) {  

    global $custom_meta_fields;  
  
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
add_action( 'save_post', 'save_homepage_meta' );

/******* Misc. Filters *********/

// Add thumbnail class to thumbnail links
function add_class_attachment_link( $html ) {
    $postid = get_the_ID();
    $html = str_replace( '<a','<a class="thumbnail"',$html );
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
        wp_register_style( 'bootstrap', get_template_directory_uri() . '/library/css/theme.css', array(), '2.3.2', 'all' );
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

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form action="' . home_url( '/' ) . '" method="get" class="form-search">
    <fieldset>
		<div class="clearfix">
			<div class="input-append">
				<input type="text" name="s" id="search" class="search-query input-medium" placeholder="' . __("Search","bonestheme") . '" value="' . get_search_query() . '" /><button type="submit" class="btn btn-primary" title="' . __("Search","bonestheme") . '" ><i class="icon-search"></i></button>
			</div>
        </div>
    </fieldset>
</form>';
	return $form;
} // don't remove this bracket!


// Get theme options
function get_wpbs_theme_options(){
  $theme_options_styles = '';
/*    
      $heading_typography = of_get_option( 'heading_typography' );
      if ( $heading_typography['face'] != 'Default' ) {
        $theme_options_styles .= '
        h1, h2, h3, h4, h5, h6{ 
          font-family: ' . $heading_typography['face'] . '; 
          font-weight: ' . $heading_typography['style'] . '; 
          color: ' . $heading_typography['color'] . '; 
        }';
      }
      
      $main_body_typography = of_get_option( 'main_body_typography' );
      if ( $main_body_typography['face'] != 'Default' ) {
        $theme_options_styles .= '
        body{ 
          font-family: ' . $main_body_typography['face'] . '; 
          font-weight: ' . $main_body_typography['style'] . '; 
          color: ' . $main_body_typography['color'] . '; 
        }';
      }
*/      
      $link_color = of_get_option( 'link_color' );
      if ($link_color) {
        $theme_options_styles .= '
        a{ 
          color: ' . $link_color . '; 
        }';
      }
      
      $link_hover_color = of_get_option( 'link_hover_color' );
      if ($link_hover_color) {
        $theme_options_styles .= '
        a:hover{ 
          color: ' . $link_hover_color . '; 
        }';
      }
      
      $link_active_color = of_get_option( 'link_active_color' );
      if ($link_active_color) {
        $theme_options_styles .= '
        a:active{ 
          color: ' . $link_active_color . '; 
        }';
      }
      
      $topbar_bg_color = of_get_option('top_nav_bg_color');
      $use_gradient = of_get_option('showhidden_gradient');
      if ( $topbar_bg_color && !$use_gradient ) {
        $theme_options_styles .= '
        .navbar-inner, .navbar .fill { 
          background-color: '. $topbar_bg_color . ';
          background-image: none;
        }';
      }
      
      if ( $use_gradient ) {
        $topbar_bottom_gradient_color = of_get_option( 'top_nav_bottom_gradient_color' );
      
        $theme_options_styles .= '
        .navbar-inner, .navbar .fill {
          background-image: -khtml-gradient(linear, left top, left bottom, from(' . $topbar_bg_color . '), to('. $topbar_bottom_gradient_color . '));
          background-image: -moz-linear-gradient(top, ' . $topbar_bg_color . ', '. $topbar_bottom_gradient_color . ');
          background-image: -ms-linear-gradient(top, ' . $topbar_bg_color . ', '. $topbar_bottom_gradient_color . ');
          background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, ' . $topbar_bg_color . '), color-stop(100%, '. $topbar_bottom_gradient_color . '));
          background-image: -webkit-linear-gradient(top, ' . $topbar_bg_color . ', '. $topbar_bottom_gradient_color . '2);
          background-image: -o-linear-gradient(top, ' . $topbar_bg_color . ', '. $topbar_bottom_gradient_color . ');
          background-image: linear-gradient(top, ' . $topbar_bg_color . ', '. $topbar_bottom_gradient_color . ');
          filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'' . $topbar_bg_color . '\', endColorstr=\''. $topbar_bottom_gradient_color . '2\', GradientType=0);
        }';
      }
      else{
      } 
      
      $topbar_link_color = of_get_option( 'top_nav_link_color' );
      if ( $topbar_link_color ) {
        $theme_options_styles .= '
        .navbar .nav li a { 
          color: '. $topbar_link_color . ';
        }';
      }
      
      $topbar_link_hover_color = of_get_option( 'top_nav_link_hover_color' );
      if ( $topbar_link_hover_color ) {
        $theme_options_styles .= '
        .navbar .nav li a:hover { 
          color: '. $topbar_link_hover_color . ';
        }';
      }

      $topbar_link_hover_bg = of_get_option( 'top_nav_link_background_color' );
      if ( $topbar_link_hover_bg ) {
        $theme_options_styles .= '
        .navbar .nav > li > a:focus,
		.navbar .nav > li > a:hover,
		.navbar .nav .active > a,
		.navbar .nav .active > a:hover,
		.navbar .nav .active > a:focus,
		.navbar .nav li.dropdown.open > .dropdown-toggle,
		.navbar .nav li.dropdown.active > .dropdown-toggle,
		.navbar .nav li.dropdown.open.active > .dropdown-toggle {
          background-color: '. $topbar_link_hover_bg . ';
        }';
      }      

      $topbar_dropdown_hover_bg_color = of_get_option( 'top_nav_dropdown_hover_bg' );
      if ( $topbar_dropdown_hover_bg_color ) {
        $theme_options_styles .= '
          .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover {
            background-color: ' . $topbar_dropdown_hover_bg_color . ';
          }
        ';
      }
      
      $topbar_dropdown_item_color = of_get_option( 'top_nav_dropdown_item' );
      if ( $topbar_dropdown_item_color ){
        $theme_options_styles .= '
          .dropdown-menu a{
            color: ' . $topbar_dropdown_item_color . ' !important;
          }
        ';
      }
      
      $hero_unit_bg_color = of_get_option( 'hero_unit_bg_color' );
      if ( $hero_unit_bg_color ) {
        $theme_options_styles .= '
        .hero-unit { 
          background-color: '. $hero_unit_bg_color . ';
        }';
      }
/*      
      $suppress_comments_message = of_get_option( 'suppress_comments_message' );
      if ( $suppress_comments_message ){
        $theme_options_styles .= '
        #main article {
          border-bottom: none;
        }';
      }
 */     
      $additional_css = of_get_option( 'wpbs_css' );
      if( $additional_css ){
        $theme_options_styles .= $additional_css;
      }
          
      if( $theme_options_styles ){
        echo '<style>' 
        . $theme_options_styles . '
        </style>';
      }
    
      $bootstrap_theme = of_get_option( 'wpbs_theme' );
      $use_theme = of_get_option( 'showhidden_themes' );
      
      if( $bootstrap_theme && $use_theme ){
        if( $bootstrap_theme == 'default' ){}
        else {
          echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/admin/themes/' . $bootstrap_theme . '.css">';
        }
      }
} // end get_wpbs_theme_options function

?>
