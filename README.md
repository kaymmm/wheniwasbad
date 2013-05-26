WhenIWasBad: Wordpress Bootstrap X Flatstrap
============================================
Twitter's Bootstrap in Wordpress theme form, forked from 320press wp-bootstrap and re-skinned using littlesparkvt's flatstrap. It is built around Eddie Machado's Bones template. 

It's named after a lyric from Ghostface's _Whip You With A Strap_ ("...take me across her lap, she used to whip me with a strap when I was bad") since I hate the concept of bootstrapping and needed to create distance from the horrible name Twitter gave their framework.

Credits
=======
* Twitter Bootstrap 2.3.1 (http://twitter.github.com/bootstrap)
* 320press wp-bootstrap v1.2 (http://320press.com/wpbs)
* Eddie Machado Bones v1.09, plus a handful of cherry picks up to 1.4 (that hopefully don't break things) (https://github.com/eddiemachado/bones)
* littlesparkvt Flatstrap (10 May 2013) (https://github.com/littlesparkvt/flatstrap)
* Font Awesome 3.1.1 (https://github.com/FortAwesome/Font-Awesome/)

---

FEATURES
========

We’ve built the WordPress Bootstrap theme so that it could be used as-is or as a starting point for theme developers. It’s built on top of the brilliant Bones theme framework by Eddie Machado and based on v2.3.1 of Twitter’s Bootstrap.

Here’s what we’ve got so far. Star this project on Github to keep up with its progress.

Responsive
__________

We stick as closely as possible to bootstrap so this thing is natually responsive. 

Page Templates
______________

We’ve packaged four different page templates into this theme.

    * Homepage template (seen on the homepage of this site)
    * Standard page with left sidebar (this page)
    * Page with right sidebar
    * Full width page

Theme Options Panel
___________________

Want to change some colors? Want the top nav to scroll with the content? Hide the search box in the top nav? Do it in the options panel.

Shortcodes
__________

We’ve built in some shortcodes so you can easily add UI elements found in Twitter Bootstrap.

Sidebars
________

We’ve built in two different sidebars. One for the homepage and one for the other pages. Add widgets to them.

---

Changelog
=========
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
* Lots of bugfixes for Wordpress unit tests
* Overhauled gallery shortcodes so they actually work as expected
* Reformatted sticky posts to differentiate them from non-stickies
* Added author to post metadata areas
* Added wp_link_pages at the bottom of all of the pages to work with <--nextpage--> shortcodes
* Cleaned up some of the code and organized the included libraries (esp. Bootstrap) to make for smoother updates
v1.0
* initial release
