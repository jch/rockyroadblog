<?php
if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails', array( 'post' ) );
}
if ( function_exists('register_sidebar') ) { register_sidebar(); }

/**
 * http://justintadlock.com/archives/2009/11/16/everything-you-need-to-know-about-wordpress-2-9s-post-image-feature
 * http://wordpress.stackexchange.com/questions/5568/filter-to-remove-image-dimension-attributes
 * Replace hardcoded width and heights for fluid layouts. Explicitly define
 * width to 100% for feed readers
 */
function remove_image_dimensions( $html ) {
  $html = preg_replace('/(<img.*?)width=".*?" height=".*?"/', '$1width="100%"', $html);
  $html = preg_replace('/(<img.*?)style="width:.*?=".*?" height=".*?"/', '$1width="100%"', $html);
  return $html;
}
add_filter( 'post_thumbnail_html', 'remove_image_dimensions', 10 );
// add_filter( 'image_send_to_editor', 'remove_image_dimensions', 10 );
// add_filter( 'get_image_tag', 'remove_image_dimensions', 10 );
// Lower priority, or else shortcodes will have information stripped from them
add_filter('the_content', 'remove_image_dimensions', 99);
add_filter('the_content_feed', 'remove_image_dimensions', 99);
add_filter('the_excerpt', 'remove_image_dimensions', 99);
add_filter('the_excerpt_rss', 'remove_image_dimensions', 99);


/**
 * http://wordpress.org/support/topic/thumbnailsfeatured-images-in-rss-feed-in-30
 * Include featured image in RSS
 */
function rocky_road_insert_thumbnail_rss($content) {
  global $post;
  if ( has_post_thumbnail( $post->ID ) ){
    $content = '' . get_the_post_thumbnail( $post->ID, 'large' ) . '' . $content;
  }
  return $content;
}
add_filter('the_excerpt_rss', 'rocky_road_insert_thumbnail_rss');
add_filter('the_content_feed', 'rocky_road_insert_thumbnail_rss');


//http://wordpress.org/support/topic/control-of-image-caption-width
/**
 * @package FixImageMargins
 * @author Justin Adie
 * @version 0.1.0
 */
/*
Plugin Name: FixImageMargins
Plugin URI: #
Description: removes the silly 10px margin from the new caption based images
Author: Justin Adie
Version: 0.1.0
Author URI: http://rathercurious.net
*/
class fixImageMargins{
    public $xs = 0; //change this to change the amount of extra spacing

    public function __construct(){
        add_filter('img_caption_shortcode', array(&$this, 'fixme'), 10, 3);
    }
    public function fixme($x=null, $attr, $content){

        extract(shortcode_atts(array(
                'id'    => '',
                'align'    => 'alignnone',
                'width'    => '',
                'caption' => ''
            ), $attr));

        if ( 1 > (int) $width || empty($caption) ) {
            return $content;
        }

        if ( $id ) $id = 'id="' . $id . '" ';

    return '<div ' . $id . 'class="wp-caption">'
    . $content . '<p class="wp-caption-text">' . $caption . '</p></div>';
    }
}
$fixImageMargins = new fixImageMargins();
?>