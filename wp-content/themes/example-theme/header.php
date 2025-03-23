<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example WordPress Theme</title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri() ?>">
    <?php wp_head(); ?>
</head>

<body>
<div class="container">
    <header class="page-header">
        <div class="header-top-left">
            <?php the_custom_logo(); ?>
        </div>
        <div class="header-top-right">
         <?php wp_nav_menu(); ?>
        </div>

    </header>