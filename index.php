<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
  <?php get_template_part('content', get_post_format()); ?>
<?php endwhile; ?>
<?php get_footer(); ?>