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
       <?php foreach (c2c_get_recent_posts(5, "") as $post):  ?>
         <li>
          <a class='heading' href='<?php echo get_permalink($post->ID); ?>'>
            <?php echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?>
            <span><?php echo $post->post_title; ?></span>
           </a>
       <?php endforeach; ?>
    </ul>
  </div>
</div>
