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

            Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam suscipit tempore, mollitia voluptatum facere eveniet laborum. Distinctio nihil, officiis, minus provident sunt fuga tenetur, placeat maxime perferendis beatae voluptatem ratione.
        </div>
    </div>
</div>


<?php
get_footer();
