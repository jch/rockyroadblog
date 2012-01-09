<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
  <?php get_template_part('content', get_post_format()); ?>
<?php endwhile; ?>
<div id="pagination">
  <?php previous_posts_link(); ?>
  <?php next_posts_link(); ?>
</div>

<?php get_footer(); ?>