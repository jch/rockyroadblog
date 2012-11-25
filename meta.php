<div class='meta'>
  <div class='meta-section author'>
    <p class='byline'>Posted by <?php the_author(); ?> on <?php the_date() ?></p>
  </div>
  <div class="meta-section sharing-strip">
    <!-- <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
    <div class="fb-like" data-href="http://foo.com/#foosdf3d" data-send="false" data-width="450" data-show-faces="false" data-layout="button_count"></div> -->
    
    <span class="share-btn facebook">
      <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>&t=<?php the_title() ?>" target="_blank">
        <span class="icon"><img src="/wp-content/themes/rockyroad/images/sharing/sharing-strip-facebook.png" alt=""></span>
        <span class="label">Share</span>
      </a>
    </span>

    <span class="share-btn twitter">
      <a href="https://twitter.com/share?via=rockyroadblog&text=<?php the_title() ?>&url=<?php the_permalink() ?>" target="_blank">
        <span class="icon"><img src="/wp-content/themes/rockyroad/images/sharing/sharing-strip-twitter.png" alt=""></span>
        <span class="label">Tweet</span>
      </a>
    </span>
  </div>
</div>