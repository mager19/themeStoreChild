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

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php the_content(); ?>

            <ul class="products">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 12
                );
                $loop = new WP_Query($args);
                if ($loop->have_posts()) {
                    while ($loop->have_posts()) : $loop->the_post();
                        wc_get_template_part('content', 'product');
                    endwhile;
                } else {
                    echo __('No products found');
                }
                wp_reset_postdata();
                ?>
            </ul>
            <!--/.products-->
        </div>
    </div>
</div>


<?php
get_footer();
