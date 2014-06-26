      </div> <!-- main -->
      <?php get_sidebar(); ?>
    </div> <!-- content-wrapper -->
    <div id="footer">
      <p>Copyright 2011 - 2012 RockyRoadBlog. All rights reserved.</p>
    </div>
  </div><!-- wrapper -->

  <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->
  <script type="text/javascript">
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-25073623-1', 'auto');
    ga('require', 'displayfeatures');
    ga('send', 'pageview');
  </script>
  <script src="https://raw.github.com/scottjehl/Respond/master/respond.min.js" type='text/javascript'></script>
  <?php
    /* Always have wp_footer() just before the closing </body>
    * tag of your theme, or you will break many plugins, which
    * generally use this hook to reference JavaScript files.
    */
    wp_footer();
  ?>
  </body>
</html>
