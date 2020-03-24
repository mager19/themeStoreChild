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


<div class="container padding-content textiles-area">
    <div class="row">
        <div class="col-lg-4">
            <?php $image = get_field('textiles_cm_image');
            echo wp_get_attachment_image($image['id'], $size = 'full');
            ?>
        </div>
        <div class="col-lg-8 d-flex align-items-center">
            <div class="content">
                <?php the_field('textiles_cm_content') ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
