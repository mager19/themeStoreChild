<?php

/**
 * The header for our theme
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package gilmore
 */
?>
<!doctype html>

<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <!--Favicon-->
    <link rel="icon" href="<?php the_field('favicon', 'option'); ?>">
    <!--/Favicon-->

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div id="page" class="site">

        <?php $image = get_field("background_header_shop", "option");  ?>
        <header id="masthead" class="py-5 header__pages" role="banner" style="background-image:url(<?php echo $image; ?>);">
            <!-- Topbar -->
            <?php get_template_part('inc/top', 'bar'); ?>
            <!-- End Topbar -->
        </header><!-- #masthead -->

        <div id="content" class="site-content">