<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
      return;
    }

    // Define the text domain
    define("Redux_TEXT_DOMAIN","wheniwasbad");

    // This is your option name where all the Redux data is stored.
    $opt_name = "wheniwasbad_options";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
      Redux_Functions::initWpFilesystem();

      global $wp_filesystem;

      $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

      if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
        $sample_patterns = array();

        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

          if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
            $name              = explode( '.', $sample_patterns_file );
            $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
            $sample_patterns[] = array(
              'alt' => $name,
              'img' => $sample_patterns_url . $sample_patterns_file
              );
          }
        }
      }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
      'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
      'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
      'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
      'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
      'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
      'menu_title'           => __( 'Sample Options', 'redux-framework-demo' ),
      'page_title'           => __( 'Sample Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
      'google_api_key'       => 'AIzaSyCOMpFLoX3Eh7Sma70MwR3iWKKWQ81oceA',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
      'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
      'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
      'admin_bar'            => true,
        // Show the panel pages on the admin bar
      'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
      'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
      'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
      'dev_mode'             => true,
        // Show the time the page took to load, etc
      'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
      'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
      'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
      'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
      'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
      'menu_icon'            => '',
        // Specify a custom URL to an icon
      'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
      'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
      'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
      'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
      'default_show'         => true,
        // If true, shows the default value next to each field that is not the default value.
      'default_mark'         => '*',
        // What to print by the field's title if the value shown is default. Suggested: *
      'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
      'transient_time'       => 60 * MINUTE_IN_SECONDS,
      'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
      'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
      'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
      'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
      'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
          'color'   => 'red',
          'shadow'  => true,
          'rounded' => false,
          'style'   => '',
          ),
        'tip_position'  => array(
          'my' => 'top left',
          'at' => 'bottom right',
          ),
        'tip_effect'    => array(
          'show' => array(
            'effect'   => 'slide',
            'duration' => '500',
            'event'    => 'mouseover',
            ),
          'hide' => array(
            'effect'   => 'slide',
            'duration' => '500',
            'event'    => 'click mouseleave',
            ),
          ),
        )
      );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
$args['admin_bar_links'][] = array(
  'id'    => 'redux-docs',
  'href'  => 'http://docs.reduxframework.com/',
  'title' => __( 'Documentation', 'redux-framework-demo' ),
  );

$args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
  'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
  'title' => __( 'Support', 'redux-framework-demo' ),
  );

$args['admin_bar_links'][] = array(
  'id'    => 'redux-extensions',
  'href'  => 'reduxframework.com/extensions',
  'title' => __( 'Extensions', 'redux-framework-demo' ),
  );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
$args['share_icons'][] = array(
  'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
  'title' => 'Visit us on GitHub',
  'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
  );
$args['share_icons'][] = array(
  'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
  'title' => 'Like us on Facebook',
  'icon'  => 'el el-facebook'
  );
$args['share_icons'][] = array(
  'url'   => 'http://twitter.com/reduxframework',
  'title' => 'Follow us on Twitter',
  'icon'  => 'el el-twitter'
  );
$args['share_icons'][] = array(
  'url'   => 'http://www.linkedin.com/company/redux-framework',
  'title' => 'Find us on LinkedIn',
  'icon'  => 'el el-linkedin'
  );

    // Panel Intro text -> before the form
if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
  if ( ! empty( $args['global_variable'] ) ) {
    $v = $args['global_variable'];
  } else {
    $v = str_replace( '-', '_', $args['opt_name'] );
  }
  $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
} else {
  $args['intro_text'] = __( '<p>Theme options built using <a href="http://reduxframework.com/">ReduxFramework</a></p>', 'redux-framework-demo' );
}

    // Add content after the form.
$args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );

Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
      array(
        'id'      => 'redux-help-tab-1',
        'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
        'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
      array(
        'id'      => 'redux-help-tab-2',
        'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
        'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
      );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // -> START Basic Fields
        Redux::setSection( $opt_name, array(
          'icon'      => 'el-icon-tint',
          'title'     => __('Styling Options', Redux_TEXT_DOMAIN),
          'fields'    => array(
            array(
              'id'        => 'opt-background',
              'type'      => 'background',
              'output'    => array('body'),
              'title'     => __('Body Background', Redux_TEXT_DOMAIN),
              'subtitle'  => __('Body background with image, color, etc.', Redux_TEXT_DOMAIN),
                        //'default'   => '#FFFFFF',
              ),
            array(
              'id'        => 'opt-footer-background',
              'type'      => 'background',
              'output'    => array('#page-footer'),
              'title'     => __('Footer Background', Redux_TEXT_DOMAIN),
              'subtitle'  => __('Footer background with image, color, etc.', Redux_TEXT_DOMAIN),
                        //'default'   => '#FFFFFF',
              ),
            array(
              'id'        => 'opt-link-color',
              'type'      => 'link_color',
              'title'     => __('Links Color Option', Redux_TEXT_DOMAIN),
              'subtitle'  => __('Primary link colors.', Redux_TEXT_DOMAIN),
                        //'desc'      => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                        //'regular'   => false, // Disable Regular Color
                        //'hover'     => false, // Disable Hover Color
                        //'active'    => false, // Disable Active Color
                        'visited'   => true,  // Enable Visited Color
                        'output'    => array('a')
                        ),
            array(
              'id'        => 'opt-typography-body',
              'type'      => 'typography',
              'title'     => __('Body Font', Redux_TEXT_DOMAIN),
              'subtitle'  => __('Specify the body font properties.', Redux_TEXT_DOMAIN),
              'output'    => array('body'),
              'google'    => true,
              'font-backup'   => true,
              'text-align'    => false,
                        /*'default'   => array(
                            'color'         => '#dd9933',
                            'font-size'     => '30px',
                            'font-family'   => 'Arial,Helvetica,sans-serif',
                            'font-weight'   => 'Normal',
                            ),*/
            ),
            array(
              'id'        => 'opt-typography-h1',
              'type'      => 'typography',
              'title'     => __('H1 Font', Redux_TEXT_DOMAIN),
              'subtitle'  => __('Specify the font properties for H1 heading tags.', Redux_TEXT_DOMAIN),
              'output'    => array('h1','.h1'),
              'google'    => true,
              'font-backup'   => true,
              'text-align'    => false,
                        /*'default'   => array(
                            'color'         => '#dd9933',
                            'font-size'     => '30px',
                            'font-family'   => 'Arial,Helvetica,sans-serif',
                            'font-weight'   => 'Normal',
                            ),*/
            ),
            array(
              'id'        => 'opt-typography-h2',
              'type'      => 'typography',
              'title'     => __('H2 Font', Redux_TEXT_DOMAIN),
              'subtitle'  => __('Specify the font properties for H2 heading tags.', Redux_TEXT_DOMAIN),
              'output'    => array('h1','.h1'),
              'google'    => true,
              'font-backup'   => true,
              'text-align'    => false,
                        /*'default'   => array(
                            'color'         => '#dd9933',
                            'font-size'     => '30px',
                            'font-family'   => 'Arial,Helvetica,sans-serif',
                            'font-weight'   => 'Normal',
                            ),*/
            ),
            array(
              'id'        => 'opt-typography-h3',
              'type'      => 'typography',
              'title'     => __('H3 Font', Redux_TEXT_DOMAIN),
              'subtitle'  => __('Specify the font properties for H3 heading tags.', Redux_TEXT_DOMAIN),
              'output'    => array('h1','.h1'),
              'google'    => true,
              'font-backup'   => true,
              'text-align'    => false,
                        /*'default'   => array(
                            'color'         => '#dd9933',
                            'font-size'     => '30px',
                            'font-family'   => 'Arial,Helvetica,sans-serif',
                            'font-weight'   => 'Normal',
                            ),*/
            ),
            array(
              'id'        => 'opt-typography-h4',
              'type'      => 'typography',
              'title'     => __('H4 Font', Redux_TEXT_DOMAIN),
              'subtitle'  => __('Specify the font properties for H4 heading tags.', Redux_TEXT_DOMAIN),
              'output'    => array('h1','.h1'),
              'google'    => true,
              'font-backup'   => true,
              'text-align'    => false,
                        /*'default'   => array(
                            'color'         => '#dd9933',
                            'font-size'     => '30px',
                            'font-family'   => 'Arial,Helvetica,sans-serif',
                            'font-weight'   => 'Normal',
                            ),*/
            ),
            array(
              'id'        => 'opt-typography-h5',
              'type'      => 'typography',
              'title'     => __('H5 Font', Redux_TEXT_DOMAIN),
              'subtitle'  => __('Specify the font properties for H5 heading tags.', Redux_TEXT_DOMAIN),
              'output'    => array('h1','.h1'),
              'google'    => true,
              'font-backup'   => true,
              'text-align'    => false,
                        /*'default'   => array(
                            'color'         => '#dd9933',
                            'font-size'     => '30px',
                            'font-family'   => 'Arial,Helvetica,sans-serif',
                            'font-weight'   => 'Normal',
                            ),*/
            ),
            array(
              'id'        => 'opt-typography-h6',
              'type'      => 'typography',
              'title'     => __('H6 Font', Redux_TEXT_DOMAIN),
              'subtitle'  => __('Specify the font properties for H6 heading tags.', Redux_TEXT_DOMAIN),
              'output'    => array('h1','.h1'),
              'google'    => true,
              'font-backup'   => true,
              'text-align'    => false,
                        /*'default'   => array(
                            'color'         => '#dd9933',
                            'font-size'     => '30px',
                            'font-family'   => 'Arial,Helvetica,sans-serif',
                            'font-weight'   => 'Normal',
                            ),*/
            ),
            )
));

Redux::setSection( $opt_name, array(
                'icon'      => 'el-icon-tint',
                'title'     => __('Styling Options', Redux_TEXT_DOMAIN),
                'fields'    => array(
                    array(
                        'id'        => 'opt-background',
                        'type'      => 'background',
                        'output'    => array('body'),
                        'title'     => __('Body Background', Redux_TEXT_DOMAIN),
                        'subtitle'  => __('Body background with image, color, etc.', Redux_TEXT_DOMAIN),
                        //'default'   => '#FFFFFF',
                    ),
                    array(
                        'id'        => 'opt-footer-background',
                        'type'      => 'background',
                        'output'    => array('#page-footer'),
                        'title'     => __('Footer Background', Redux_TEXT_DOMAIN),
                        'subtitle'  => __('Footer background with image, color, etc.', Redux_TEXT_DOMAIN),
                        //'default'   => '#FFFFFF',
                    ),
                    array(
                        'id'        => 'opt-link-color',
                        'type'      => 'link_color',
                        'title'     => __('Links Color Option', Redux_TEXT_DOMAIN),
                        'subtitle'  => __('Primary link colors.', Redux_TEXT_DOMAIN),
                        //'desc'      => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                        //'regular'   => false, // Disable Regular Color
                        //'hover'     => false, // Disable Hover Color
                        //'active'    => false, // Disable Active Color
                        'visited'   => true,  // Enable Visited Color
                        'output'    => array('a')
                    ),
                    array(
                        'id'        => 'opt-typography-body',
                        'type'      => 'typography',
                        'title'     => __('Body Font', Redux_TEXT_DOMAIN),
                        'subtitle'  => __('Specify the body font properties.', Redux_TEXT_DOMAIN),
                        'output'    => array('body'),
                        'google'    => true,
                        'font-backup'   => true,
                        'text-align'    => false,
                        /*'default'   => array(
                            'color'         => '#dd9933',
                            'font-size'     => '30px',
                            'font-family'   => 'Arial,Helvetica,sans-serif',
                            'font-weight'   => 'Normal',
                        ),*/
                    ),
                    array(
                        'id'        => 'opt-typography-h1',
                        'type'      => 'typography',
                        'title'     => __('H1 Font', Redux_TEXT_DOMAIN),
                        'subtitle'  => __('Specify the font properties for H1 heading tags.', Redux_TEXT_DOMAIN),
                        'output'    => array('h1','.h1'),
                        'google'    => true,
                        'font-backup'   => true,
                        'text-align'    => false,
                        /*'default'   => array(
                            'color'         => '#dd9933',
                            'font-size'     => '30px',
                            'font-family'   => 'Arial,Helvetica,sans-serif',
                            'font-weight'   => 'Normal',
                        ),*/
                    ),
                    array(
                        'id'        => 'opt-typography-h2',
                        'type'      => 'typography',
                        'title'     => __('H2 Font', Redux_TEXT_DOMAIN),
                        'subtitle'  => __('Specify the font properties for H2 heading tags.', Redux_TEXT_DOMAIN),
                        'output'    => array('h1','.h1'),
                        'google'    => true,
                        'font-backup'   => true,
                        'text-align'    => false,
                        /*'default'   => array(
                            'color'         => '#dd9933',
                            'font-size'     => '30px',
                            'font-family'   => 'Arial,Helvetica,sans-serif',
                            'font-weight'   => 'Normal',
                        ),*/
                    ),
                    array(
                        'id'        => 'opt-typography-h3',
                        'type'      => 'typography',
                        'title'     => __('H3 Font', Redux_TEXT_DOMAIN),
                        'subtitle'  => __('Specify the font properties for H3 heading tags.', Redux_TEXT_DOMAIN),
                        'output'    => array('h1','.h1'),
                        'google'    => true,
                        'font-backup'   => true,
                        'text-align'    => false,
                        /*'default'   => array(
                            'color'         => '#dd9933',
                            'font-size'     => '30px',
                            'font-family'   => 'Arial,Helvetica,sans-serif',
                            'font-weight'   => 'Normal',
                        ),*/
                    ),
                    array(
                        'id'        => 'opt-typography-h4',
                        'type'      => 'typography',
                        'title'     => __('H4 Font', Redux_TEXT_DOMAIN),
                        'subtitle'  => __('Specify the font properties for H4 heading tags.', Redux_TEXT_DOMAIN),
                        'output'    => array('h1','.h1'),
                        'google'    => true,
                        'font-backup'   => true,
                        'text-align'    => false,
                        /*'default'   => array(
                            'color'         => '#dd9933',
                            'font-size'     => '30px',
                            'font-family'   => 'Arial,Helvetica,sans-serif',
                            'font-weight'   => 'Normal',
                        ),*/
                    ),
                    array(
                        'id'        => 'opt-typography-h5',
                        'type'      => 'typography',
                        'title'     => __('H5 Font', Redux_TEXT_DOMAIN),
                        'subtitle'  => __('Specify the font properties for H5 heading tags.', Redux_TEXT_DOMAIN),
                        'output'    => array('h1','.h1'),
                        'google'    => true,
                        'font-backup'   => true,
                        'text-align'    => false,
                        /*'default'   => array(
                            'color'         => '#dd9933',
                            'font-size'     => '30px',
                            'font-family'   => 'Arial,Helvetica,sans-serif',
                            'font-weight'   => 'Normal',
                        ),*/
                    ),
                    array(
                        'id'        => 'opt-typography-h6',
                        'type'      => 'typography',
                        'title'     => __('H6 Font', Redux_TEXT_DOMAIN),
                        'subtitle'  => __('Specify the font properties for H6 heading tags.', Redux_TEXT_DOMAIN),
                        'output'    => array('h1','.h1'),
                        'google'    => true,
                        'font-backup'   => true,
                        'text-align'    => false,
                        /*'default'   => array(
                            'color'         => '#dd9933',
                            'font-size'     => '30px',
                            'font-family'   => 'Arial,Helvetica,sans-serif',
                            'font-weight'   => 'Normal',
                        ),*/
                    ),
                )
            ) );
Redux::setSection( $opt_name, array(
                'icon'      => 'el-icon-website',
                'title'     => __('Header', Redux_TEXT_DOMAIN),
                'heading'   => __('Options for the page header.', Redux_TEXT_DOMAIN),
                //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', Redux_TEXT_DOMAIN),
                'fields'    => array(
                    array(
                        'id' => 'opt-header-scroll',
                        'type' => 'select',
                        'title' => __('Position', Redux_TEXT_DOMAIN),
                        'desc' => __('Affix the header at the top of the page or scroll with the page?', Redux_TEXT_DOMAIN),
                        'options' => array("scroll" => "Scroll","fixed" => "Fixed"),
                        'default' => 'fixed'
                    ),
                    array(
                        'title' => __('Header Background', Redux_TEXT_DOMAIN),
                        'desc' => __('Set the background for the header', Redux_TEXT_DOMAIN),
                        'id' => 'header_bg',
                        'type' => 'background',
                        'output' => array('#main_header')
                    ),
                    array(
                        'id'        => 'opt-header-border',
                        'type'      => 'border',
                        'title'     => __('Header Border Option', Redux_TEXT_DOMAIN),
                        'subtitle'  => __('Only color validation can be done on this field type', Redux_TEXT_DOMAIN),
                        'output'    => array('#main_header'), // An array of CSS selectors to apply this font style to
                        'desc'      => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                        'all'       => false,
                        'default'   => array(
                            'border-style'  => 'none'
                        )
                    ),
                    array(
                        'title' => __('Header text color', Redux_TEXT_DOMAIN),
                        'desc' => __('Color used on site title', Redux_TEXT_DOMAIN),
                        'id' => 'top_nav_text_color',
                        'type' => 'link_color',
                        'visited' => true,
                        'active' => true,
                        'hover' => true,
                        'output' => array('.navbar-default .navbar-brand'),
                        'validate' => 'color'
                    ),
                    array(
                        'title' => __('Menu font color', Redux_TEXT_DOMAIN),
                        'id' => 'top_nav_link_color',
                        'type' => 'link_color',
                        'visited' => true,
                        'active' => true,
                        'hover' => true,
                        'output' => array('.navbar-default .navbar-nav>li>a'),
                        'validate' => 'color'
                    ),

                    array(
                        'title' => __('Search Box', Redux_TEXT_DOMAIN),
                        'desc' => __('Show search box in the header', Redux_TEXT_DOMAIN),
                        'id' => 'search_bar',
                        'default' => '0',
                        'type' => 'checkbox'
                    ),
                    array(
                        'title' => __('Search Box Primary Color', Redux_TEXT_DOMAIN),
                        'desc' => 'The color of the search icon when the search box is in the default closed state and the main color for the search box when it is opened.',
                        'id' => 'search_box_color_primary',
                        'default' => '#95a5a6',
                        'type' => 'color',
                        'required' => array( 'search_bar', 'equals', '1'),
                        'output' => array(
                            'color' => '#menu_search_btn.search_hidden, #s:focus',
                            'background-color' => '#menu_search_btn',
                            'border-color' => '#menu_search_btn,#s:focus'),
                        'validate' => 'color'
                    ),
                    array(
                        'title' => __('Search Icon Open Color', Redux_TEXT_DOMAIN),
                        'id' => 'search_box_color_open',
                        'desc' => 'The color of the search icon when the search box is opened.',
                        'default' => '#ecf0f1',
                        'type' => 'color',
                        'required' => array( 'search_bar', 'equals', '1'),
                        'output' => array(
                            'color' => '#menu_search_btn'),
                        'validate' => 'color'
                    ),
                    array(
                        'title' => __('Search Icon Hover Color', Redux_TEXT_DOMAIN),
                        'id' => 'search_box_color_hover',
                        'default' => '#9b59b6',
                        'type' => 'color',
                        'required' => array( 'search_bar', 'equals', '1'),
                        'output' => array(
                            'color' => '#menu_search_btn.search_hidden:hover'),
                        'validate' => 'color'
                    ),
                    array(
                        'title' => __('Search Box Background Color', Redux_TEXT_DOMAIN),
                        'id' => 'search_box_bg_color',
                        'desc' => 'The background color for the opened search box.',
                        'default' => array('background-color' => '#ffffff'),
                        'type' => 'background',
                        'background-repeat' => false,
                        'background-attachment' => false,
                        'background-position' => false,
                        'background-image' => false,
                        'background-size' => false,
                        'preview' => false,
                        'required' => array( 'search_bar', 'equals', '1'),
                        'output' => array('background-color' => '#s:focus'),
                        'validate' => 'color'
                    ),
                    array(
                        'title' => __('Site Name', Redux_TEXT_DOMAIN),
                        'desc' => __('Display site name in top nav', Redux_TEXT_DOMAIN),
                        'id' => 'site_name',
                        'default' => '1',
                        'type' => 'checkbox'
                    ),
                    array(
                        'title' => __('Branding Logo', Redux_TEXT_DOMAIN),
                        'desc' => __('Select an image to use for site branding', Redux_TEXT_DOMAIN),
                        'id' => 'branding_logo',
                        'default' => '',
                        'type' => 'media'
                    ),
                )
            ));
Redux::setSection( $opt_name, array(
                'title'     => __('Homepage Settings', Redux_TEXT_DOMAIN),
                'desc'      => __('', Redux_TEXT_DOMAIN),
                'icon'      => 'el-icon-home',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(

                    array(
                        'title' => __('Slider on homepage', Redux_TEXT_DOMAIN),
                        'desc' => __('Display a bootstrap post slider on homepage page template. This uses the WordPress featured images.', Redux_TEXT_DOMAIN),
                        'id' => 'showhidden_slideroptions',
                        'default' => '0',
                        'type' => 'switch',
                        'on' => 'Enabled',
                        'off' => 'Disabled'
                    ),

                    array(
                        'title' => __('Slider options', Redux_TEXT_DOMAIN),
                        'desc'  => __('Number of posts to show.', Redux_TEXT_DOMAIN),
                        'id'    => 'slider_options',
                        'required'  => array('showhidden_slideroptions','equals', true),
                        'type'  => 'slider',
                        'min'   => 1,
                        'max'   => 10,
                        'step'  => 1,
                        'display_text'  => 'label',
                        'default'   => '5',
                    ),

                    array(
                        'title' => __('Homepage jumbotron background color', Redux_TEXT_DOMAIN),
                        'desc' => __('Default used if no color is selected.', Redux_TEXT_DOMAIN),
                        'id' => 'jumbotron_bg_color',
                        'default' => '',
                        'type' => 'color'
                    ),
                ),
            ) );


Redux::setSection( $opt_name, array(
                'icon'      => 'el-icon-pencil-alt',
                'title'     => __('Blog/Archive Page Options', Redux_TEXT_DOMAIN),
                'desc'      => __('Customize the default "blog" page and post archive/category/tag pages.', Redux_TEXT_DOMAIN),
                'fields'    => array(
                    array(
                        'title' => __('Sidebar Visibility', Redux_TEXT_DOMAIN),
                        'desc' => __('Display sidebar widgets on the blog page?', Redux_TEXT_DOMAIN),
                        'id' => 'blog_sidebar',
                        'default' => 1,
                        'type' => 'switch',
                        'on' => 'Enabled',
                        'off' => 'Disabled'
                    ),
                    array(
                        'title' => __('Sidebar Position', Redux_TEXT_DOMAIN),
                        'desc' => __('Where should the sidebar be positioned relative to the list of posts?', Redux_TEXT_DOMAIN),
                        'id' => 'blog_sidebar_position',
                        'required' => array('blog_sidebar','equals', true),
                        'default' => 'left',
                        'type' => 'select',
                        'options' => array('left'=>'Left', 'right'=>'Right')
                    ),
                    // array(
                    //     'title' => __('Sidebar Widget Group', Redux_TEXT_DOMAIN),
                    //     'desc' => __('Select a widget group to display on the archive page sidebar.', Redux_TEXT_DOMAIN),
                    //     'id' => 'blog_sidebar_widgets',
                    //     'required' => array('blog_sidebar','equals', true),
                    //     'default' => 'sidebar1',
                    //     'type' => 'select',
                    //     'options' => $sidebar_list
                    // ),
                    array(
                        'title' => __('Blog page "jumbotron"', Redux_TEXT_DOMAIN),
                        'desc' => __('Display blog page jumbotron', Redux_TEXT_DOMAIN),
                        'id' => 'blog_jumbotron',
                        'default' => '1',
                        'type' => 'checkbox'
                    ),
                    array(
                        'title' => __('Blog page "jumbotron" content', Redux_TEXT_DOMAIN),
                        'desc' => __('Content to display in the blog page jumbotron (HTML OK)', Redux_TEXT_DOMAIN),
                        'id' => 'blog_jumbotron_content',
                        'default' => '',
                        'type' => 'editor'
                    ),
                    array(
                        'title' => __('Use excerpts on blog/archive/search pages', Redux_TEXT_DOMAIN),
                        'desc' => __('Show excerpts on all pages containing multiple posts; full posts only appear on single post pages', Redux_TEXT_DOMAIN),
                        'id' => 'use_excerpts',
                        'default' => '1',
                        'type' => 'checkbox'
                    )
                )
            ) );



Redux::setSection( $opt_name, array(
  'title'      => __( 'Info', 'redux-framework-demo' ),
  'id'         => 'presentation-info',
  'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="//docs.reduxframework.com/core/fields/info/" target="_blank">//docs.reduxframework.com/core/fields/info/</a>',
  'subsection' => true,
  'fields'     => array(
    array(
      'id'   => 'opt-info-field',
      'type' => 'info',
      'desc' => __( 'This is the info field, if you want to break sections up.', 'redux-framework-demo' )
      ),
    array(
      'id'    => 'opt-notice-info1',
      'type'  => 'info',
      'style' => 'info',
      'title' => __( 'This is a title.', 'redux-framework-demo' ),
      'desc'  => __( 'This is an info field with the <strong>info</strong> style applied. By default the <strong>normal</strong> style is applied.', 'redux-framework-demo' )
      ),
    array(
      'id'    => 'opt-info-warning',
      'type'  => 'info',
      'style' => 'warning',
      'title' => __( 'This is a title.', 'redux-framework-demo' ),
      'desc'  => __( 'This is an info field with the <strong>warning</strong> style applied.', 'redux-framework-demo' )
      ),
    array(
      'id'    => 'opt-info-success',
      'type'  => 'info',
      'style' => 'success',
      'icon'  => 'el el-info-circle',
      'title' => __( 'This is a title.', 'redux-framework-demo' ),
      'desc'  => __( 'This is an info field with the <strong>success</strong> style applied and an icon.', 'redux-framework-demo' )
      ),
    array(
      'id'    => 'opt-info-critical',
      'type'  => 'info',
      'style' => 'critical',
      'icon'  => 'el el-info-circle',
      'title' => __( 'This is a title.', 'redux-framework-demo' ),
      'desc'  => __( 'This is an info field with the <strong>critical</strong> style applied and an icon.', 'redux-framework-demo' )
      ),
    array(
      'id'    => 'opt-info-custom',
      'type'  => 'info',
      'style' => 'custom',
      'color' => 'purple',
      'icon'  => 'el el-info-circle',
      'title' => __( 'This is a title.', 'redux-framework-demo' ),
      'desc'  => __( 'This is an info field with the <strong>custom</strong> style applied, color arg passed, and an icon.', 'redux-framework-demo' )
      ),
    array(
      'id'     => 'opt-info-normal',
      'type'   => 'info',
      'notice' => false,
      'title'  => __( 'This is a title.', 'redux-framework-demo' ),
      'desc'   => __( 'This is an info non-notice field with the <strong>normal</strong> style applied.', 'redux-framework-demo' )
      ),
    array(
      'id'     => 'opt-notice-info',
      'type'   => 'info',
      'notice' => false,
      'style'  => 'info',
      'title'  => __( 'This is a title.', 'redux-framework-demo' ),
      'desc'   => __( 'This is an info non-notice field with the <strong>info</strong> style applied.', 'redux-framework-demo' )
      ),
    array(
      'id'     => 'opt-notice-warning',
      'type'   => 'info',
      'notice' => false,
      'style'  => 'warning',
      'icon'   => 'el el-info-circle',
      'title'  => __( 'This is a title.', 'redux-framework-demo' ),
      'desc'   => __( 'This is an info non-notice field with the <strong>warning</strong> style applied and an icon.', 'redux-framework-demo' )
      ),
    array(
      'id'     => 'opt-notice-success',
      'type'   => 'info',
      'notice' => false,
      'style'  => 'success',
      'icon'   => 'el el-info-circle',
      'title'  => __( 'This is a title.', 'redux-framework-demo' ),
      'desc'   => __( 'This is an info non-notice field with the <strong>success</strong> style applied and an icon.', 'redux-framework-demo' )
      ),
    array(
      'id'     => 'opt-notice-critical',
      'type'   => 'info',
      'notice' => false,
      'style'  => 'critical',
      'icon'   => 'el el-info-circle',
      'title'  => __( 'This is a title.', 'redux-framework-demo' ),
      'desc'   => __( 'This is an non-notice field with the <strong>critical</strong> style applied and an icon.', 'redux-framework-demo' )
      ),
    )
) );


if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
  $section = array(
    'icon'   => 'el el-list-alt',
    'title'  => __( 'Documentation', 'redux-framework-demo' ),
    'fields' => array(
      array(
        'id'       => '17',
        'type'     => 'raw',
        'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                    ),
      ),
    );
  Redux::setSection( $opt_name, $section );
}
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
      function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
          }
        }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
      function redux_validate_callback_function( $field, $value, $existing_value ) {
        $error   = false;
        $warning = false;

            //do your validation
        if ( $value == 1 ) {
          $error = true;
          $value = $existing_value;
        } elseif ( $value == 2 ) {
          $warning = true;
          $value   = $existing_value;
        }

        $return['value'] = $value;

        if ( $error == true ) {
          $return['error'] = $field;
          $field['msg']    = 'your custom error message';
        }

        if ( $warning == true ) {
          $return['warning'] = $field;
          $field['msg']      = 'your custom warning message';
        }

        return $return;
      }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
      function redux_my_custom_field( $field, $value ) {
        print_r( $field );
        echo '<br/>';
        print_r( $value );
      }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
      function dynamic_section( $sections ) {
            //$sections = array();
        $sections[] = array(
          'title'  => __( 'Section via hook', 'redux-framework-demo' ),
          'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
          'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
          'fields' => array()
          );

        return $sections;
      }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
      function change_arguments( $args ) {
            //$args['dev_mode'] = true;

        return $args;
      }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
      function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
      }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
      function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
          remove_filter( 'plugin_row_meta', array(
            ReduxFrameworkPlugin::instance(),
            'plugin_metalinks'
            ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
          remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
      }
    }

