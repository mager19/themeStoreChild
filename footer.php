<?php

/**
 * The template for displaying the footer
 * Contains the closing of the #content div and all content after.
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package gilmore
 */
?>

</div><!-- #content -->

<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima mollitia asperiores non repellendus rerum dolores libero illo sapiente laudantium ab, temporibus ullam excepturi ad hic corporis culpa. Odio, hic distinctio.
            </div>
        </div>
        <section>
            <div class="footer">
                <div class="sitelogo">
                    <?php $GETlogo = get_field('logo_site', 'option'); ?>
                    <a href="<?php echo esc_url(get_bloginfo('url')); ?>"><img src="<?php echo $GETlogo['url']; ?>" height="<?php echo $GETlogo['height'] / 2; ?>" width="<?php echo $GETlogo['width'] / 2; ?>" /></a>
                </div>

                <!--Social Icons-->
                <div class="social-icons">
                    <?php
                    if (have_rows('social_icons', 'option')) :
                        while (have_rows('social_icons', 'option')) : the_row();
                            $social = get_sub_field('social_icon');
                    ?>
                            <a href="<?php the_sub_field('social_profile'); ?>" target="_blank" data-linktype="social" data-socialnetwork="<?php echo $social['value']; ?>">
                                <i class="icon-<?php echo $social['value']; ?>"></i>
                            </a>
                    <?php endwhile;
                    endif;
                    ?>
                </div>
                <!--/Social Icons-->

                <div class="footer__information">
                    <h4>Phone <span><a href="tel:<?php the_field('phone', 'option'); ?>"><?php the_field('phone', 'option'); ?></a> </span>Box Office: <span><a href="tel:<?php the_field('box_office', 'option'); ?>"><?php the_field('box_office', 'option'); ?></a></span></h4>
                    <h4><?php the_field('footer_info', 'option'); ?></h4>
                </div>
            </div>
        </section>
    </div>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>