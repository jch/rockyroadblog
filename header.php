<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Rocky Road Blog</title>
    <!-- cursive -->
    <link href='http://fonts.googleapis.com/css?family=Yellowtail' rel='stylesheet' type='text/css'>
    <!-- all caps blocky -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'> -->

    <link href="<?php bloginfo('stylesheet_directory'); ?>/stylesheets/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />
    <link href="<?php bloginfo('stylesheet_directory'); ?>/stylesheets/print.css" media="print" rel="stylesheet" type="text/css" />
    <!--[if IE]>
        <link href="<?php bloginfo('stylesheet_directory'); ?>/stylesheets/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
    <![endif]-->
    <link href="<?php bloginfo('stylesheet_directory'); ?>/stylesheets/main.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.js"></script>
  </head>
  <body>
    <script type='text/javascript'>
    $(function() {
      if(window.location.hash == '#debug') {
        $("<link>").attr('media', 'screen').attr('rel', 'stylesheet').attr('href', 'stylesheets/debug.css').appendTo('head');
      }
    })
    </script>
    <!-- for styling only -->
    <div id="header-wrapper"></div>
    <div id='wrapper'>
      <div id="header">
        <a id="logo" href="<?php echo home_url(); ?>">Rocky Road Blog</a>
        <ul id="nav">
          <?php wp_list_pages('title_li='); ?>
        </ul>
      </div>
      <div id='content-wrapper'>
        <div id="main">
