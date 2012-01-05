<?php
/**
 * Excerpt on index pages, read more will be ignored in single.php
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <h1 class='title heading'>
    <a href='<?php the_permalink(); ?>'><?php the_title(); ?></a>
  </h1>
  <div class='lead'>
    <?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
  </div>
  <?php if(!is_page()) : ?>
    <?php get_template_part('meta'); ?>
  <?php endif; ?>

  <div class="content">
    <?php the_content('Continue reading <span class="meta-nav">&rarr;</span>'); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
  </div>
</article>

<?php if(is_single()) : ?>
  <?/* This should just work, but it isn't */?>
  <?php get_template_part('comments'); ?>
<?php endif; ?>