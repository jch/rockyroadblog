<?php
if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails', array( 'post' ) );
}

/**
 * http://justintadlock.com/archives/2009/11/16/everything-you-need-to-know-about-wordpress-2-9s-post-image-feature
 * Replace hardcoded width and heights for fluid layouts. Explicitly define
 * width to 100% for feed readers
 */
add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );
function my_post_image_html( $html, $post_id, $post_image_id ) {
  return preg_replace('/width=".*?" height=".*?"/', 'width="100%"', $html);
}

/**
 * http://wordpress.org/support/topic/thumbnailsfeatured-images-in-rss-feed-in-30
 * Include featured image in RSS
 */
function insertThumbnailRSS($content) {
  global $post;
  if ( has_post_thumbnail( $post->ID ) ){
    $content = '' . get_the_post_thumbnail( $post->ID, 'medium' ) . '' . $content;
  }
  return $content;
}

add_filter('the_excerpt_rss', 'insertThumbnailRSS');
add_filter('the_content_feed', 'insertThumbnailRSS');
?>