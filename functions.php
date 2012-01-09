<?php
if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails', array( 'post' ) );
}

/**
 * http://justintadlock.com/archives/2009/11/16/everything-you-need-to-know-about-wordpress-2-9s-post-image-feature
 * http://wordpress.stackexchange.com/questions/5568/filter-to-remove-image-dimension-attributes
 * Replace hardcoded width and heights for fluid layouts. Explicitly define
 * width to 100% for feed readers
 */
function remove_image_dimensions( $html ) {
  return preg_replace('/width=".*?" height=".*?"/', 'width="100%"', $html);
}
add_filter( 'post_thumbnail_html', 'remove_image_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_image_dimensions', 10 );
add_filter( 'get_image_tag', 'remove_image_dimensions', 10 );

/**
 * http://wordpress.org/support/topic/thumbnailsfeatured-images-in-rss-feed-in-30
 * Include featured image in RSS
 */
function rocky_road_insert_thumbnail_rss($content) {
  global $post;
  if ( has_post_thumbnail( $post->ID ) ){
    $content = '' . get_the_post_thumbnail( $post->ID, 'medium' ) . '' . $content;
  }
  return $content;
}
add_filter('the_excerpt_rss', 'rocky_road_insert_thumbnail_rss');
add_filter('the_content_feed', 'rocky_road_insert_thumbnail_rss');
?>