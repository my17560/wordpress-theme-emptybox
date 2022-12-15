<!doctype html>
<html <?php language_attributes(); ?>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
	<?php get_template_part('template-widgets/head-utils'); ?>
</head>
<body <?php body_class(); ?>>
<div id="site" class="site">
	<?php get_template_part('template-widgets/site-header'); ?>
