<?php

/**
 * The template for displaying all pages
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package gilmore
 */

get_header(); ?>

<!-- Section Textiles -->
<div class="container padding-content textiles-area">
    <div class="row">
        <div class="col-lg-4 col-md-5 d-none d-md-block">
            <?php $image = get_field('textiles_cm_image');
            echo wp_get_attachment_image($image['id'], $size = 'full');
            ?>
        </div>
        <div class="col-lg-8 col-md-7 textiles-area__right d-flex align-items-center">
            <div class="content">
                <?php the_field('textiles_cm_content') ?>
            </div>
        </div>
    </div>
</div>

<!-- Mision -->
<section class="mision">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mision__left">
                <div class="content">
                    <?php the_field('mision_content'); ?>
                </div>
            </div>

            <div class="col-lg-7 mision__right">
                <?php $image = get_field('mision_imagen');  ?>
                <div class="content" style="background-image:url(<?php echo $image['url']; ?>);"></div>
            </div>
        </div>
    </div>
</section>

<!-- Vision -->
<section class="vision">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 vision__left order-lg-0 order-1">
                <?php $image = get_field('vision_imagen'); ?>
                <div class="content" style="background-image:url(<?php echo $image['url']; ?>);"></div>
            </div>

            <div class="col-lg-6 vision__right order-lg-1 order-0">
                <div class="content">
                    <?php the_field('vision_content'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
