<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style()
{
    wp_dequeue_style('storefront-style');
    wp_dequeue_style('storefront-woocommerce-style');
}

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

function textilescm()
{
    $parent_style = 'storefront-style';

    wp_enqueue_style('googleFonts', 'https://fonts.googleapis.com/css?family=Josefin+Sans|Open+Sans:300,400,700&display=swap');

    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/assets/css/main.css', array($parent_style), '1.0.1', false);

    wp_enqueue_script('theme-scripts-bootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '0.1', true);

    wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyApqoIBG8ip_FTD1a7KDZdWHfxGMSxZHRU', array('jquery'), null, true);

    wp_enqueue_script('theme-scripts', get_stylesheet_directory_uri() . '/assets/js/textiles.js', array('jquery'), '0.1', true);
}
add_action('wp_enqueue_scripts', 'textilescm');


//add acf options page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}

function my_acf_google_map_api($api)
{

    $api['key'] = 'AIzaSyDUYFlVKNSIMOL-MVMriLKy20OwZ2SREdQ';

    return $api;
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
