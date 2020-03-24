<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-9">
                <?php $GETlogo = get_field('logo', 'option'); ?>
                <a href="<?php echo esc_url(get_bloginfo('url')); ?>"><img src="<?php echo $GETlogo['url']; ?>" height="<?php echo $GETlogo['height'] / 2; ?>" width="<?php echo $GETlogo['width'] / 2; ?>" /></a>
            </div>
            <div class="col-lg-9 top-bar__menu d-none d-lg-flex">
                <div class="main-nav">
                    <?php
                    wp_nav_menu();
                    ?>
                </div>
            </div>
            <!-- Button trigger modal -->
            <div class="mobile-nav d-lg-none">
                <button type="button" id="openMenu">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/menu.png" alt="menu">
                </button>
            </div>
            <!-- Button trigger modal -->
        </div>
    </div>
</div>