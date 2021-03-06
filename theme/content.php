<?php
/**
 * Excerpt on index pages, read more will be ignored in single.php
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <h1 class='title'>
    <a href='<?php the_permalink(); ?>'><?php the_title(); ?></a>
  </h1>
  <div class='lead'>
    <?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
  </div>
  <?php if(!is_page()) : ?>
    <?php get_template_part('meta'); ?>
  <?php endif; ?>

  <div class="content">
    <?php the_content('<p>Continue reading <span class="meta-nav">&rarr;</span></p>'); ?>
  </div>
</article>