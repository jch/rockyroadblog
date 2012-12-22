<div id="sidebar">
  <div class='section text pages'>
    <h2 class='heading'>Pages</h2>
    <ul id="pages">
      <?php wp_list_pages('title_li='); ?>
    </ul>
  </div>
  <div class='section text follow'>
    <h2 class='heading'>Follow us</h2>
    <ul>
      <li><a class='facebook' target='_blank' href='http://www.facebook.com/pages/Rocky-Road-Blog/137981422954604'>Facebook</a></li>
      <li><a class='twitter' target='_blank' href='http://twitter.com/rockyroadblog'>Twitter</a></li>
      <li><a class='rss' target='_blank' href='http://rockyroadblog.com/feed/'>RSS</a></li>
      <li><a class='email' target='_blank' href='http://eepurl.com/fa_9Q'>Newsletter</a></li>
    </ul>
  </div>
  <div class='section other'>
    <h2 class='heading'>Recent Stories</h2>
    <ul>
      <?php foreach(get_posts(array('numberposts' => 15)) as $post): ?>
      <li>
        <a href='<?php echo get_permalink($post->ID); ?>'>
          <span><?php echo $post->post_title; ?></span>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
