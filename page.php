<?php

/**
 * The template for displaying for new pages
 *
 * Template Name: page
 *
 * @package storefront
 */

get_header(); ?>

<!-- Section Textiles -->
<div class="container padding-content">
    <div class="row">
        <div class="col-12">
            <?php

            while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>

        </div>
    </div>
</div>


<?php
get_footer();
