<?php
/*
 *
 * Set the text domain for the theme or plugin.
 *
 */
define('Redux_TEXT_DOMAIN', 'redux-opts');

/*
 *
 * Require the framework class before doing anything else, so we can use the defined URLs and directories.
 * If you are running on Windows you may have URL problems which can be fixed by defining the framework url first.
 *
 */
if(!class_exists('Redux_Options')) {
	define('Redux_OPTIONS_URL', get_stylesheet_directory_uri() . '/admin/redux-options/options/');
	require_once dirname( __FILE__ ) . '/admin/redux-options/options/defaults.php';
}


/*
 *
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for URLs, and directories will NOT be available at this point in a child theme,
 * so you must use get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections) {
    //$sections = array();
    $sections[] = array(
        'title' => __('A Section added by hook', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', Redux_TEXT_DOMAIN),
		'icon' => 'paper-clip',
		'icon_class' => 'icon-large',
        // Leave this as a blank section, no options just some intro text set above.
        'fields' => array()
    );

    return $sections;
}
//add_filter('redux-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by a theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args) {
    //$args['dev_mode'] = false;
    
    return $args;
}
//add_filter('redux-opts-args-twenty_eleven', 'change_framework_args');


/*
 *
 * Most of your editing will be done in this section.
 *
 * Here you can override default values, uncomment args and change their values.
 * No $args are required, but they can be over ridden if needed.
 *
 */
function setup_framework_options() {
    $args = array();

    // Setting dev mode to true allows you to view the class settings/info in the panel.
    // Default: true
    $args['dev_mode'] = false;

	// Set the icon for the dev mode tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$args['dev_mode_icon'] = 'info-sign';

	// Set the class for the dev mode tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['dev_mode_icon_class'] = 'icon-large';

    // If you want to use Google Webfonts, you MUST define the api key.
    //$args['google_api_key'] = 'xxxx';

    // Define the starting tab for the option panel.
    // Default: '0';
    //$args['last_tab'] = '0';

    // Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
    // If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
    // If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
    // Default: 'standard'
    //$args['admin_stylesheet'] = 'standard';

    // Add HTML before the form.
    $args['intro_text'] = __('<p>Customize the theme by changing these options</p>', Redux_TEXT_DOMAIN);

    // Add content after the form.
    $args['footer_text'] = __('<p>For more information about this theme, visit <a href="http://keithmiyake.info/wheniwasbad">http://keithmiyake.info/wheniwasbad</a></p>', Redux_TEXT_DOMAIN);

    // Set footer/credit line.
    //$args['footer_credit'] = __('<p>This text is displayed in the options panel footer across from the WordPress version (where it normally says \'Thank you for creating with WordPress\'). This field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

    // Setup custom links in the footer for share icons
    //$args['share_icons']['twitter'] = array(
    //    'link' => 'http://twitter.com/ghost1227',
    //    'title' => __('Follow me on Twitter', Redux_TEXT_DOMAIN),
    //    'img' => Redux_OPTIONS_URL . 'img/social/Twitter.png'
    //);
    //$args['share_icons']['linked_in'] = array(
    //    'link' => 'http://www.linkedin.com/profile/view?id=52559281',
    //    'title' => __('Find me on LinkedIn', Redux_TEXT_DOMAIN),
    //    'img' => Redux_OPTIONS_URL . 'img/social/LinkedIn.png'
    //);

    // Enable the import/export feature.
    // Default: true
    //$args['show_import_export'] = false;

	// Set the icon for the import/export tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: refresh
	//$args['import_icon'] = 'refresh';

	// Set the class for the import/export tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['import_icon_class'] = 'icon-large';

    // Set a custom option name. Don't forget to replace spaces with underscores!
    $args['opt_name'] = 'wheniwasbad';

    // Set a custom menu icon.
    //$args['menu_icon'] = '';

    // Set a custom title for the options page.
    // Default: Options
    $args['menu_title'] = __('Theme Options', Redux_TEXT_DOMAIN);

    // Set a custom page title for the options page.
    // Default: Options
    $args['page_title'] = __('Theme Options', Redux_TEXT_DOMAIN);

    // Set a custom page slug for options page (wp-admin/themes.php?page=***).
    // Default: redux_options
    $args['page_slug'] = 'redux_options';

    // Set a custom page capability.
    // Default: manage_options
    //$args['page_cap'] = 'manage_options';

    // Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
    // Default: menu
	// NOTE: got rid of the menu option since it is discouraged by WordPress
    //$args['page_type'] = 'submenu'; 

    // Set the parent menu.
    // Default: themes.php
    // A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    //$args['page_parent'] = 'options-general.php';

    // Set a custom page location. This allows you to place your menu where you want in the menu order.
    // Must be unique or it will override other items!
    // Default: null
    //$args['page_position'] = null;

    // Set a custom page icon class (used to override the page icon next to heading)
    //$args['page_icon'] = 'icon-themes';

	// Set the icon type. Set to "iconfont" for Font Awesome, or "image" for traditional.
	// Redux no longer ships with standard icons!
	// Default: iconfont
	//$args['icon_type'] = 'image';
	//$args['dev_mode_icon_type'] = 'image';
	//$args['import_icon_type'] == 'image';

    // Disable the panel sections showing as submenu items.
    // Default: true
    //$args['allow_sub_menu'] = false;
        
    // Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
    /*$args['help_tabs'][] = array(
        'id' => 'redux-opts-1',
        'title' => __('Theme Information 1', Redux_TEXT_DOMAIN),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', Redux_TEXT_DOMAIN)
    );
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-2',
        'title' => __('Theme Information 2', Redux_TEXT_DOMAIN),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', Redux_TEXT_DOMAIN)
    );*/

    // Set the help sidebar for the options page.                                        
    //$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', Redux_TEXT_DOMAIN);
	
    $sections = array();
	/*
    $sections[] = array(
		// Redux uses the Font Awesome iconfont to supply its default icons.
		// If $args['icon_type'] = 'iconfont', this should be the icon name minus 'icon-'.
		// If $args['icon_type'] = 'image', this should be the path to the icon.
		// Icons can also be overridden on a section-by-section basis by defining 'icon_type' => 'image'
		'icon_type' => 'image',
		'icon' => Redux_OPTIONS_URL . 'img/home.png',
		// Set the class for this icon.
		// This field is ignored unless $args['icon_type'] = 'iconfont'
		'icon_class' => 'icon-large',
        'title' => __('Getting Started', Redux_TEXT_DOMAIN),
		'desc' => __('<p class="description">This is the description field for this section. HTML is allowed</p>', Redux_TEXT_DOMAIN),
		'fields' => array(
			array(
				'id' => 'font_awesome_info',
				'type' => 'raw_html',
				'html' => '<h3 style="text-align: center; border-bottom: none;">Redux Framework is now powered by <a href="http://fortawesome.github.com/Font-Awesome/" target="_blank">Font Awesome</a>!</h3><h4 style="text-align: center; font-size: 1.3em;">What does this mean to you?</h4>
				<p>Well for one thing it means that Redux as a whole is a much leaner package than it used to be. Those annoying icons took up a <strong>lot</strong> of unnecessary space. Additionally, it means you have a lot more flexibility with your icons.
				Each icon field has an option for you to define custom classes. These are defined on an icon-by-icon basis and can be Font Awesome specific classes or your own custom ones. Want to see why this is so cool? Keep reading!</p>
				<br/><span style="font-weight: bold; text-decoration: underline;">The Icons</span><p>There&apos;s just too many to list! <a href="http://fortawesome.github.com/Font-Awesome/#icons-new" target="_blank">Click here</a> for the official list.</p>
				<br/><span style="font-weight: bold; text-decoration: underline;">The Classes</span><p>There are just as many built-in classes as icons! <a href="http://fortawesome.github.com/Font-Awesome/#examples" target="_blank">Click here</a> for a few examples.</p>
				<br/><span style="font-weight: bold; text-decoration: underline;">Anything Else?</span><p>Yep! Because it&apos;s iconfont and not image based, you can apply pretty much any CSS to an icon!</p>'
			)
		)
    );*/

    $sections[] = array(
		'icon' => 'font',
		'icon_class' => 'icon-large',
        'title' => __('Typography', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">Typography and font options</p>', Redux_TEXT_DOMAIN),
        'fields' => array(
            array(
                'id' => 'link_color',
                'type' => 'color',
                'title' => __('Link Color', Redux_TEXT_DOMAIN), 
                'desc' => __('Default used if no color is selected.', Redux_TEXT_DOMAIN),
                'std' => ''
            ),
            array(
                'id' => 'link_hover_color',
                'type' => 'color',
                'title' => __('Link:hover Color', Redux_TEXT_DOMAIN), 
                'desc' => __('Default used if no color is selected.', Redux_TEXT_DOMAIN),
                'std' => ''
            ),
            array(
                'id' => 'link_active_color',
                'type' => 'color',
                'title' => __('Link:active Color', Redux_TEXT_DOMAIN), 
                'desc' => __('Default used if no color is selected.', Redux_TEXT_DOMAIN),
                'std' => ''
			)
        )
    );
	
    $sections[] = array(
		'icon' => 'list-alt',
		'icon_class' => 'icon-large',
        'title' => __('Navigation Bar', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">Configure the top (or bottom) navigation bar layout and styles</p>', Redux_TEXT_DOMAIN),
        'fields' => array(
            array(
                'id' => 'nav_position',
                'type' => 'select',
                'title' => __('Position', Redux_TEXT_DOMAIN),
                'desc' => __('Fixed will stay in place, static scrolls with the page.', Redux_TEXT_DOMAIN),
				'options' => array("scroll" => "Scroll","fixed" => "Fixed (top)","fixed-bottom" => "Fixed (bottom)"),
                'std' => 'scroll'
			),
			array(
				'title' => __('Alignment',Redux_TEXT_DOMAIN),
				'desc' => __('Pull the nav menu to the left or right side of the page.', Redux_TEXT_DOMAIN),
				"id" => "nav_alignment",
				"std" => "right",
				"type" => "select",
				"options" => array('left'=>'Align Left', 'right'=>'Align Right')
			),
			array( 
				'title' => __('Top nav background color', Redux_TEXT_DOMAIN),
					'desc' => __('Default used if no color is selected.', Redux_TEXT_DOMAIN),
					'id' => 'top_nav_bg_color',
					'std' => '',
					'type' => 'color'
			),		
			array( 'title' => __('Check to use a gradient for top nav background', Redux_TEXT_DOMAIN),
					'desc' => __('Use gradient', Redux_TEXT_DOMAIN),
					'id' => 'showhidden_gradient',
					'std' => '',
					'type' => 'checkbox_hide_below'
			),
			array( 'title' => __('Bottom gradient color', Redux_TEXT_DOMAIN),
					'desc' => __('Top nav background color used as top gradient color.', Redux_TEXT_DOMAIN),
					'id' => 'top_nav_bottom_gradient_color',
					'std' => '',
					'type' => 'color'
			),		
			array( 'title' => __('Top nav item color', Redux_TEXT_DOMAIN),
					'desc' => __('Link color.', Redux_TEXT_DOMAIN),
					'id' => 'top_nav_link_color',
					'std' => '',
					'type' => 'color'
			),
			array( 'title' => __('Top nav item hover color', Redux_TEXT_DOMAIN),
					'desc' => __('Link hover color.', Redux_TEXT_DOMAIN),
					'id' => 'top_nav_link_hover_color',
					'std' => '',
					'type' => 'color'
			),			
			array( 'title' => __('Top nav item hover background', Redux_TEXT_DOMAIN),
					'desc' => __('Link hover background color.', Redux_TEXT_DOMAIN),
					'id' => 'top_nav_link_background_color',
					'std' => '',
					'type' => 'color'
			),											
			array( 'title' => __('Top nav dropdown item color', Redux_TEXT_DOMAIN),
					'desc' => __('Dropdown item color.', Redux_TEXT_DOMAIN),
					'id' => 'top_nav_dropdown_item',
					'std' => '',
					'type' => 'color'
			),
			array( 'title' => __('Top nav dropdown item hover bg color', Redux_TEXT_DOMAIN),
					'desc' => __('Background of dropdown item hover color.', Redux_TEXT_DOMAIN),
					'id' => 'top_nav_dropdown_hover_bg',
					'std' => '',
					'type' => 'color'
			),			
			array( 'title' => __('Search bar', Redux_TEXT_DOMAIN),
					'desc' => __('Show search bar in top nav', Redux_TEXT_DOMAIN),
					'id' => 'search_bar',
					'std' => '0',
					'type' => 'checkbox'
			),
			array( 'title' => __('Site Name', Redux_TEXT_DOMAIN),
					'desc' => __('Display site name in top nav', Redux_TEXT_DOMAIN),
					'id' => 'site_name',
					'std' => '1',
					'type' => 'checkbox'
			),
			array( 'title' => __('Branding Logo', Redux_TEXT_DOMAIN),
					'desc' => __('Select an image to use for site branding', Redux_TEXT_DOMAIN),
					'id' => 'branding_logo',
					'std' => '',
	        		'type' => 'upload'
			)
		)
	);

  /*  $sections[] = array(
		'icon' => 'list-alt',
		'icon_class' => 'icon-large',
        'title' => __('Navigation Bar', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">Configure the top (or bottom) navigation bar layout and styles</p>', Redux_TEXT_DOMAIN),
        'fields' => array(
			array( 'title' => __('Bootswatch.com Themes', Redux_TEXT_DOMAIN),
						'desc' => __('Use theme from bootswatch.com. Note: This may override other styles set in the theme options panel.', Redux_TEXT_DOMAIN),
						'id' => 'showhidden_themes',
						'std' => '0',
						'type' => 'checkbox'
			),
						
			array( 'title' => __('Select a theme', Redux_TEXT_DOMAIN),
						'id' => 'wpbs_theme',
						'std' => 'default',
						'class' => 'hidden',
						'type' => 'images',
						'options' => $theList
			),
						
			array( 'title' => __('Refresh themes from Bootswatch', Redux_TEXT_DOMAIN),
						'type' => 'themecheck',
						'id' => 'themecheck'
			)
		)
	);*/


    $sections[] = array(
		'icon' => 'level-down',
		'icon_class' => 'icon-large',
        'title' => __('Footer', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">Configure the top (or bottom) navigation bar layout and styles</p>', Redux_TEXT_DOMAIN),
        'fields' => array(
			array( 'title' => __('Footer Text', Redux_TEXT_DOMAIN),
						'desc' => __('Custom footer text (HTML OK)', Redux_TEXT_DOMAIN),
						'id' => 'footer_text',
						'std' => '',
						'type' => 'editor'
			),
			array( 'title' => __('Footer Menu', Redux_TEXT_DOMAIN),
						'desc' => __('Check to display a navigation menu in the footer area (configure using WordPress "Menus")', Redux_TEXT_DOMAIN),
						'id' => 'show_footer_menu',
						'std' => '0',
						'type' => 'checkbox'
			)
		)
	);
    $sections[] = array(
		'icon' => 'keyboard',
		'icon_class' => 'icon-large',
        'title' => __('Blog Page', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">Settings for the blog (post listing) page.</p>', Redux_TEXT_DOMAIN),
        'fields' => array(	
			array( 'title' => __('Blog page widgets sidebar', Redux_TEXT_DOMAIN),
						'desc' => __('Display sidebar widgets on the blog page?', Redux_TEXT_DOMAIN),
						'id' => 'blog_sidebar',
						'std' => '1',
						'type' => 'checkbox'
			),			
			array( 'title' => __('Blog page "hero" unit', Redux_TEXT_DOMAIN),
						'desc' => __('Display blog page hero unit', Redux_TEXT_DOMAIN),
						'id' => 'blog_hero',
						'std' => '1',
						'type' => 'checkbox'
			),			
			array( 'title' => __('Blog page "hero" unit content', Redux_TEXT_DOMAIN),
						'desc' => __('Content to display in the blog page hero unit (HTML OK)', Redux_TEXT_DOMAIN),
						'id' => 'blog_hero_content',
						'std' => '',
						'type' => 'editor'
			),
			array( 'title' => __('Use excerpts on blog/archive/search pages', Redux_TEXT_DOMAIN),
						'desc' => __('Show excerpts on all pages containing multiple posts; full posts only appear on single post pages', Redux_TEXT_DOMAIN),
						'id' => 'use_excerpts',
						'std' => '1',
						'type' => 'checkbox'
			)
		)
	);					


    $sections[] = array(
		'icon' => 'wrench',
		'icon_class' => 'icon-large',
        'title' => __('Other Settings', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">Miscellaneous settings</p>', Redux_TEXT_DOMAIN),
        'fields' => array(
			array( 'title' => __('Slider carousel on homepage', Redux_TEXT_DOMAIN),
						'desc' => __('Display the bootstrap slider carousel on homepage page template. This uses the WordPress featured images.', Redux_TEXT_DOMAIN),
						'id' => 'showhidden_slideroptions',
						'std' => '0',
						'type' => 'checkbox_hide_below'
			),			
			array( 'title' => __('Slider options', Redux_TEXT_DOMAIN),
						'desc' => __('Number of posts to show.', Redux_TEXT_DOMAIN),
						'id' => 'slider_options',
						'std' => '5',
						'type' => 'text'
			),						
			array( 'title' => __('Homepage page template hero-unit background color', Redux_TEXT_DOMAIN),
						'desc' => __('Default used if no color is selected.', Redux_TEXT_DOMAIN),
						'id' => 'hero_unit_bg_color',
						'std' => '',
						'type' => 'color'
			),
			array( 'title' => __('"Comments are closed" message on pages', Redux_TEXT_DOMAIN),
						'desc' => __('Suppress "Comments are closed" message', Redux_TEXT_DOMAIN),
						'id' => 'suppress_comments_message',
						'std' => '1',
						'type' => 'checkbox'
			),
			array( 'title' => __('Custom favicon', Redux_TEXT_DOMAIN),
						'desc' => __('URL for a valid .ico favicon', Redux_TEXT_DOMAIN),
						'id' => 'favicon_url',
						'std' => '',
						'type' => 'text'
			),
			array( 'title' => __('CSS', Redux_TEXT_DOMAIN),
						'desc' => __('Additional CSS', Redux_TEXT_DOMAIN),
						'id' => 'wpbs_css',
						'std' => '',
						'type' => 'textarea'
			)
		)
	);
                
    $tabs = array();

    if (function_exists('wp_get_theme')){
        $theme_data = wp_get_theme();
        $item_uri = $theme_data->get('ThemeURI');
        $description = $theme_data->get('Description');
        $author = $theme_data->get('Author');
        $author_uri = $theme_data->get('AuthorURI');
        $version = $theme_data->get('Version');
        $tags = $theme_data->get('Tags');
    }else{
        $theme_data = get_theme_data(trailingslashit(get_stylesheet_directory()) . 'style.css');
        $item_uri = $theme_data['URI'];
        $description = $theme_data['Description'];
        $author = $theme_data['Author'];
        $author_uri = $theme_data['AuthorURI'];
        $version = $theme_data['Version'];
        $tags = $theme_data['Tags'];
     }
    
    $item_info = '<div class="redux-opts-section-desc">';
    $item_info .= '<p class="redux-opts-item-data description item-uri">' . __('<strong>Theme URL:</strong> ', Redux_TEXT_DOMAIN) . '<a href="' . $item_uri . '" target="_blank">' . $item_uri . '</a></p>';
    $item_info .= '<p class="redux-opts-item-data description item-author">' . __('<strong>Author:</strong> ', Redux_TEXT_DOMAIN) . ($author_uri ? '<a href="' . $author_uri . '" target="_blank">' . $author . '</a>' : $author) . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-version">' . __('<strong>Version:</strong> ', Redux_TEXT_DOMAIN) . $version . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-description">' . $description . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-tags">' . __('<strong>Tags:</strong> ', Redux_TEXT_DOMAIN) . implode(', ', $tags) . '</p>';
    $item_info .= '</div>';

    $tabs['item_info'] = array(
		'icon' => 'info-sign',
		'icon_class' => 'icon-large',
        'title' => __('Theme Information', Redux_TEXT_DOMAIN),
        'content' => $item_info
    );
    
    if(file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
        $tabs['docs'] = array(
			'icon' => 'book',
			'icon_class' => 'icon-large',
            'title' => __('Documentation', Redux_TEXT_DOMAIN),
            'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
        );
    }

    global $Redux_Options;
    $Redux_Options = new Redux_Options($sections, $args, $tabs);

}
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value) {
    print_r($field);
    print_r($value);
}

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value) {
    $error = false;
    $value =  'just testing';
    /*
    do your validation
    
    if(something) {
        $value = $value;
    } elseif(somthing else) {
        $error = true;
        $value = $existing_value;
        $field['msg'] = 'your custom error message';
    }
    */
    
    $return['value'] = $value;
    if($error == true) {
        $return['error'] = $field;
    }
    return $return;
}
