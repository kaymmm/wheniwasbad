WhenIWasBad v3.1
==================
WordPress Bootstrap Theme
-------------------------------
Twitter's Bootstrap in WordPress theme form, originally forked from 320press wp-bootstrap, but long since evolved into an entirely different theme package. 

It's named after a lyric from Ghostface's _Whip You With A Strap_ ("...[mom used to] take me across her lap, she used to whip me with a strap when I was bad") since I hate the concept of pulling oneself up by the bootstraps and needed to create distance from the horrible name Twitter gave their framework.

Credits
=======

* Bootstrap (https://github.com/twbs/bootstrap)
* 320press wp-bootstrap (http://320press.com/wpbs)
* Font Awesome (https://github.com/FortAwesome/Font-Awesome/)
* wp-bootstrap-navwalker (https://github.com/twittem/wp-bootstrap-navwalker) 
* Redux Framework (https://github.com/reduxframework/reduxframework)
* Custom Metaboxes and Fields for Wordpress (https://github.com/humanmade/Custom-Meta-Boxes)
* jQuery tocify (http://gregfranko.com/jquery.tocify.js/)
* Blueimp Gallery (http://blueimp.github.io/Gallery/)

---

FEATURES
========

This WordPress Bootstrap theme is designed to stand alone or to be used as a base for child theming. It is designed to implement the core functionality of Bootstrap 3.0. It has customizable options via the Redux Framework.

Here are some of the things that are working so far:

Responsive
__________

By relying on the Bootstrap 3.0 framework, this theme should be fully responsive. It is built around a mobile-first logic with breakpoints that can be changed via LESS.

Page Templates
______________

There are 3 built-in templates, but this belies the flexibility of sidebars that can be assigned on a per-page basis.

* Homepage template, with optional jumbotron area, carousel slider, and widget sidebar
* Standard page, with one optional sidebar on the left or right
* Jumbotron page, with a full-width jumbotron area in place of the page title and optional sidebars

Theme Options
___________________

Lots of options for changing colors, typography, and page elements

Shortcodes
__________

A number of shortcodes are included so you can easily add UI elements found in Twitter Bootstrap.

* Galleries: replace the default gallery shortcode with a lightbox-enabled, popover equipped, Bootstrap-esque gallery

Sidebars
________

There are three included widget areas that can be assigned to individual pages or archive/blog pages.

---

Changelog
=========

v3.1.0
* Lots of changes under the hood
* Added some shortcodes to easily add Bootstrap content
* Updated options. You will need to reset your options!
* Cleaned up lots of code
* Lots of bug fixes for inconsistent appearance things

v3.0.2

* Modify homepage template to allow including other pages within the homepage (to keep content modular and pages easy to maintain)
* Update Custom-Meta-Boxes to include ordering of repeatable fields

v3.0.1

* Removed FontAwesome for now...
* Fixed a bunch of small bugs

v3.0.0

* Bumped version number to 3 to indicate consistency with Bootstrap version numbering
* Upgraded to Bootstrap 3.0. If you have existing content that relies on the Bootstrap 2.3 scaffolding, please check the Bootstrap documentation for information about migrating. THINGS WILL BREAK
* Upgraded to the new Redux Framework 3.0. Options page might still be buggy as a result.
* Overhauled the page template system to allow flexible sidebars on any page
* Added custom metabox API to make it easier to add new page metaboxes in the future
* Added new navwalker class for Bootstrap 3.0 menus. New system (and BS3.0) only supports a single child level even though this isn't technically WP compliant.
* Added blueimp Gallery module for gallery shortcodes
* Switched from font-awesome to the native Boostrap Glyphicons
* Added a blank page template that has no containers (for totally customized Bootstrap page layouts)
* Added jumbotron customizability at the page level using metabox options
* Added a Table of Contents page type that uses the tocify jQuery script to generate a table of contents from headers within a page
* Updated a bunch of styles for Bootstrap 3
* Added an optional debug mode within the theme's backend that use the WP-Less plugin to generate css at runtime (requires the plugin to be activated for it to work)
* Started adding and updating the Options panel to include new options and improve functionality of existing options. Not all options are functional yet...

v1.3.3

* Feature: added custom author profile page to display both posts and comments using tabs
* Feature: (only framework, not yet implemented) Author profile page displays their profile information and contact information in tabs
* Fix: datetime tag in postmeta boxes uses correct W3C datetime format
* Fix: clean up page headers

v1.3.2

* Fix: revert static css file creation because it wasn't working well on multisite since it generates a new css file for every blog in the main theme folder. no good.
* Added icons for audio and video post formats
* Added page metadata to full-width page template


v1.3.1

* Fixed static css so that it works on multisite installations
* BUG: creates a new static css file for each multisite blog in the primary theme directory

v1.3

* Switched options to redux-framework so that options can be imported/exported
* Removed support for Bootswatch themes for now
* Modified redux-framework to write style options to a static css file so that it can be enqueued by WordPress
* Minor fixes to satisfy WordPress theme requirements/guidelines
* Moved IE hack scripts to functions.php to use wp_enqueue_ functions instead of hardcoding them in header/footer pages
* Use wp_enqueue_style for login.css


v1.2.1

* Bugfixes galore! Working toward WordPress theme requirements


v1.2

* Added support for Jetpack's infinite scroll
* Added support for Theme Updater plugin (https://github.com/UCF/Theme-Updater) for github-based theme updates
* Fixed button styling
* Restyled default post-meta icons
* Restyled hero units to be full-width
* Added hero unit page template (full-width + hero unit)
* Added separate blog-page options
* Fixed broken &rquao on "read more" buttons and replace arrows with font-awesome arrow icons


v1.1

* Lots of bugfixes for WordPress unit tests
* Overhauled gallery shortcodes so they actually work as expected
* Reformatted sticky posts to differentiate them from non-stickies
* Added author to post metadata areas
* Added wp_link_pages at the bottom of all of the pages to work with <--nextpage--> shortcodes
* Cleaned up some of the code and organized the included libraries (esp. Bootstrap) to make for smoother updates


v1.0

* initial release

