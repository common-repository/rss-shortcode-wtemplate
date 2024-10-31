<?php
/*
Plugin Name: RSS shortcode w/template
Description: lets you embed rss feed in any WordPress content (e.g., pages, posts, custom post types) using Shortcode.
Author: Shai Shprung
Version: 0.1
Author URI: https://www.facebook.com/shprung
License: GPL2

You can change the template used via wp-admin/options.php , look for 'rss_shortcode_template'
Template fields documentation:
        _TITLE_  : the rss feed title line
        _LINK_   : the link to the complete store, aka permalink
        _MSG_    : the short message/description; the first few lines of the post/story
        _DATE_   : post date & time
        _TARGET_ : the link target

Copyright 2016 Shai Shprung (email: shprung@gmail.com) - my first plugin -

        This program is free software; you can redistribute it and/or modify
        it under the terms of the GNU General Public License, version 2, as
        published by the Free Software Foundation.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License
        along with this program; if not, write to the Free Software
        Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function rss_work( $atts ) {
  include_once( ABSPATH . WPINC . '/feed.php' );
  $ret='';
  $r = shortcode_atts( array( 'url' => '', 'no' => 10, 'target'=>'_blank'), $atts, 'rss' );
  $rss = fetch_feed( $r['url'] );	
  if ( !is_wp_error( $rss ) ) {
    $items = $rss->get_item_quantity( $r['no'] ); 
    if($items){
      $template  = get_option( 'rss_shortcode_template', "<li><a href='_LINK_'>_TITLE_</a></li>" );
      $rss_items = $rss->get_items( 0, $items );
      foreach ( $rss_items as $item ) {
        $o=trim(str_replace('_TITLE_',esc_html( $item->get_title()),$template));
        $o=str_replace('_MSG_',esc_html($item->get_description()),$o);
        $o=str_replace('_DATE_',$item->get_date('j F Y | g:i a'),$o);
        $o=str_replace('_TARGET_',$r['target'],$o);
        $ret.=str_replace('_LINK_',esc_url( $item->get_permalink()),$o);
      }
    } else $ret.="<span class='no_items'>No items at {$r['url']}</span>";
  }
  return $ret;
}

function rss_init(){ // store default template in the 'options-db'
  $a="<li><b>_TITLE_</b><p><small>_MSG_</small><a title='_DATE_' class='genericon genericon-feed' target='_TARGET_' href='_LINK_'>&nbsp;</a></p></li>";
  update_option( 'rss_shortcode_template', $a );
}
function rss_kill(){ // clenup the option-db from the items we added 
  delete_option( 'rss_shortcode_template' );
}

add_shortcode( 'rss', 'rss_work' );
register_activation_hook( __FILE__, 'rss_init' );
register_deactivation_hook( __FILE__, 'rss_kill' );
