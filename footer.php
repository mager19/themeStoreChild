<?php

/**
 * The template for displaying the footer
 * Contains the closing of the #content div and all content after.
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package gilmore
 */
?>

</div><!-- #content -->

<footer class="site-footer footer__child">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-auto col-md-3 footer__child__left d-flex justify-content-center">
                <div class="sitelogo">
                    <?php $GETlogo = get_field('logo_footer', 'option'); ?>
                    <a href="<?php echo esc_url(get_bloginfo('url')); ?>"><img src="<?php echo $GETlogo['url']; ?>" height="<?php echo $GETlogo['height'] / 2; ?>" width="<?php echo $GETlogo['width'] / 2; ?>" /></a>
                </div>
            </div>

            <div class="col-lg-9 col-xl-10 col-md-9 footer__child__right d-flex justify-content-between ">

                <div class="footer__child__right__item">
                    <?php the_field('copyright', 'option'); ?>
                </div>

                <div class="footer__child__right__item">
                    <?php the_field('footer_info', 'option'); ?>
                </div>

            </div>
        </div>

    </div>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>