=== RSS shortcode w/template ===
Contributors: shprung
Donate link: http://shprung.com/paypal_donate.php
Tags: rss,feed
Requires at least: 3.0.1
Tested up to: 4.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

lets you embed rss feed in any WordPress content (e.g., pages, posts, custom
post types) using Shortcode.

== Description ==

Less than 40 lines of php code so it will not slow your site and if all you
need is to add an rss feed, give it a try.

_You can even setup the output template - something many other plugin don't
offer_.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/` directory, or install
the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress

== A brief Markdown Example ==

`short code examples:

[rss url="http://www.usacycling.org/rss/headlines.rss"]


[rss url="http://www.usacycling.org/rss/headlines.rss" no="20" target="_self"]

You can change the template used via wp-admin/options.php , look for
'rss_shortcode_template'
Template fields documentation:
    _TITLE_  : the rss feed title line
    _LINK_   : the link to the complete store, aka permalink
    _MSG_    : the short message/description; the first few 
               lines of the post/story
    _DATE_   : post date & time
    _TARGET_ : the link target
`
