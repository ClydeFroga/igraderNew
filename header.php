<!DOCTYPE html>
<html lang="<?php bloginfo('language');?>">

<head>
    <meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="<?php bloginfo('template_url')?>/style.css?version=1.14">
	<link rel="stylesheet" href="<?php bloginfo('template_url')?>/styles/swiper.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url')?>/styles/fonts.css?version=2">
	<?php if(is_singular() && has_category(1480)) echo "<meta name='robots' content='noindex,nofollow'>";?>
    <script src="https://yastatic.net/pcode/adfox/loader.js" crossorigin="anonymous"></script>
	<?php get_template_part('includes/counters');?>
	<?php wp_head();?>
</head>

<body>

<?php

if(has_category(1480)) {
	dynamic_sidebar('protobaner');
} else {
	dynamic_sidebar('topbanner');
} ?>

