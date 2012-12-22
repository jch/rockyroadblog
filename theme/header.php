<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php the_title_attribute(); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=1.0, width=320px" />
    <link href="<?php bloginfo('stylesheet_directory'); ?>/stylesheets/main.css" media="screen" rel="stylesheet" type="text/css" />
        <!-- cursive -->
    <link href='http://fonts.googleapis.com/css?family=Yellowtail' rel='stylesheet' type='text/css'>
    <!--[if IE]>
        <link href="<?php bloginfo('stylesheet_directory'); ?>/stylesheets/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
    <![endif]-->

    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://feeds.feedburner.com/rockyroadblog" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="http://feeds.feedburner.com/rockyroadblog" />
    <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="http://feeds.feedburner.com/rockyroadblog" />
    <?php
      /* Always have wp_head() just before the closing </head>
       * tag of your theme, or you will break many plugins, which
       * generally use this hook to add elements to <head> such
       * as styles, scripts, and meta tags.
       */
       wp_head();
    ?>
  </head>
  <body>
    <div id="fb-root"></div>
    <!-- BEGIN FACEBOOK -->
    <script>
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=498228400204546";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- END FACEBOOK -->

    <!-- BEGIN TWITTER -->
    <script>
      !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
    </script>
    <!-- END TWITTER -->

    <div id="header">
      <a id="logo" href="<?php echo home_url(); ?>">Rocky Road Blog</a>
    </div>
    <div id='wrapper'>
      <div id='content-wrapper'>
        <div id="main">
