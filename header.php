<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php wp_title( '' ); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=1.0, width=320px" />
    <!-- cursive -->
    <link href='http://fonts.googleapis.com/css?family=Yellowtail' rel='stylesheet' type='text/css'>
    <link href="<?php bloginfo('stylesheet_directory'); ?>/stylesheets/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />
    <link href="<?php bloginfo('stylesheet_directory'); ?>/stylesheets/print.css" media="print" rel="stylesheet" type="text/css" />
    <!--[if IE]>
        <link href="<?php bloginfo('stylesheet_directory'); ?>/stylesheets/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
    <![endif]-->
    <link href="<?php bloginfo('stylesheet_directory'); ?>/stylesheets/main.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.js"></script>
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
    <div id="header">
      <a id="logo" href="<?php echo home_url(); ?>">Rocky Road Blog</a>
    </div>
    <div id='wrapper'>
      <div id='content-wrapper'>
        <div id="main">
