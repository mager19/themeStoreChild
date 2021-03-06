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

get_header('home'); ?>

<!-- Section Textiles -->
<div class="container padding-content textiles-area" id="quienes__somos">
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

<!-- tiposdetela -->
<section class="tipodetela">
    <div class="container">
        <div class="row">
            <div class="tipodetela__title">
                <?php the_field('tipos_de_tela_content'); ?>
            </div>
        </div>

        <div class="row container__items__tela">
            <?php if (have_rows('tipos_de_tela')) : ?>

                <?php while (have_rows('tipos_de_tela')) : the_row(); ?>
                    <div class="item__tipodetela">
                        <div class="content">
                            <?php $image = get_sub_field('patron');
                            echo wp_get_attachment_image($image['id']);
                            ?>
                            <h3><?php the_sub_field('patron_title'); ?></h3>
                            <?php the_sub_field('descripcion'); ?>
                        </div>
                    </div>
                <?php endwhile; ?>

            <?php endif; ?>

        </div>
    </div>
</section>

<!-- Nuestros Productos -->
<?php /*
<section class="nuestros__productos my-lg-5 title__nuestros__productos" id="nuestros__productos">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h3 class="title--3">
                    NUESTROS <span>PRODUCTOS</span>
                </h3>

                <div class="button-group filters-button-group d-lg-block d-none">
                    <ul>
                        <li class="filtro__item is-checked" data-filter="*">
                            <div class="content">
                                Mostrar Todos
                            </div>
                        </li>
                        <?php

                        $categories = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);

                        foreach ($categories as $category) {
                            if ($category->count > 0) { ?>
                                <li class="filtro__item" data-filter=".<?php echo $category->slug; ?>">
                                    <div class="content">
                                        <?php echo $category->name; ?>
                                    </div>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>

                <div id="filters-mobile" class="d-block d-lg-none">
                    <select class="filters-select">
                        <option value="*">Mostrar Todos</option>

                        <?php
                        $categories = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);
                        echo '<pre>' . var_export($categories, true) . '</pre>';

                        foreach ($categories as $category) {
                            if ($category->count > 0) {
                                echo '<option value=".' . $category->slug . '">' . $category->name . '</option> ';
                            }
                        }

                        ?>
                    </select>
                </div>

            </div>

            <div class="col-lg-9 container__products">
                <?php

                // $args = array('post_type' => 'product', 'posts_per_page' => -1);
                $args = array('post_type' => 'product', 'posts_per_page' => 12, 'tax_query' => array(array('taxonomy' => 'product_visibility', 'field' => 'name', 'terms' => 'featured',),),);
                $loop = new WP_Query($args);
                if ($loop->have_posts()) : ?>
                    <div class="row grid">
                        <?php
                        while ($loop->have_posts()) : $loop->the_post();
                            $terms = get_the_terms($post->ID, 'product_cat'); ?>

                            <div class="col-lg-4 col-md-6 col-12 mb-5 element-item <?php echo $terms[0]->slug; ?>">

                                <?php the_post_thumbnail(); ?>
                                <div class="attributes">
                                    <h3><strong><?php the_title(); ?></strong></h3>
                                </div>
                                <?php
                                global $product;
                                global $post;

                                $attributes = $product->get_attributes();

                                foreach ($attributes as $attribute) {

                                    // Get the taxonomy.
                                    $terms = wp_get_post_terms($product->id, $attribute['name'], 'all');
                                    $taxonomy = $terms[0]->taxonomy;

                                    // Get the taxonomy object.
                                    $taxonomy_object = get_taxonomy($taxonomy);

                                    // Get the attribute label.
                                    $attribute_label = $taxonomy_object->labels->name_admin_bar;

                                    // Display the label followed by a clickable list of terms.
                                    echo get_the_term_list($post->ID, $attribute['name'], '<div class="attributes"><strong>' . $attribute_label . '</strong>: ', ', ', '</div>');
                                }

                                ?>
                            </div>
                        <?php endwhile; ?>
                        <!-- post navigation -->
                    <?php else : ?>
                        <!-- no posts found -->
                    </div>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </div>
        </div>
    </div>
</section>
 
*/ ?>

<!-- Contacto -->
<section class="contacto" id="contacto">
    <div class="container-fluid container__especial">
        <div class="row no-gutters">
            <div class="col-lg-6">
                <div class="map-top map__container">
                    <?php
                    $location = get_field('mapa');

                    if (!empty($location)) : ?>
                        <div class="content">
                            <div class="acf-map">
                                <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 contacto__right">
                <h3 class="title--3"><?php the_field('ubicacion_title'); ?> </h3>

                <div class="row direccion no-gutters">
                    <div class="col-lg-6 col-md-6 col-12 direccion__left">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-3 col-3">
                                <img class="icon__contacto" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/location.png" alt="">
                            </div>
                            <div class="col-xl-10 col-lg-9 col-md-9 col-9">
                                <?php the_field('direccion', 'option'); ?>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6 col-md-6 col-12 direccion__right">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-3 col-3">
                                <img class="icon__telefono" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/telefono.png" alt="">
                            </div>
                            <div class="col-xl-10 col-lg-9 col-md-9 col-9">
                                <?php $telefono = get_field('telefono', 'option'); ?>
                                <a href="tel:<?php echo $telefono; ?>"><?php echo $telefono; ?></a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class=" row form">
                    <div class="col-lg-12">
                        <h3 class="title--3">Contacto</h3>
                    </div>

                    <div class="col-lg-12">
                        <?php the_field('formulario_de_contacto'); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php
get_footer();
