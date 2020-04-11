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

    $apikey = get_field("google_maps_api_key", 'option');

    wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=' . $apikey, array('jquery'), null, true);

    wp_enqueue_script('isotope', get_stylesheet_directory_uri() . '/assets/js/isotope.min.js', array('jquery'), '0.1', true);

    if (is_front_page()) {
        wp_enqueue_script('theme-scripts', get_stylesheet_directory_uri() . '/assets/js/textiles.js', array('jquery'), '0.1', true);
    }
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


//Actual Year
function textiles_displaydate()
{
    return date('Y');
}
add_shortcode('date', 'textiles_displaydate');


function fix_my_login_logo()
{ ?>
    <style type="text/css">
        #login h1 a {
            margin-bottom: 30px;
            height: 120px !important;
        }

        .login form input[type=checkbox] {
            margin: 0 10px 0 0;
        }

        .login p.forgetmenot {
            display: flex;
            align-items: center;
        }

        .login.login label[for="rememberme"] {
            padding-top: 0;
            margin-bottom: 0;
            margin-top: 0;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'fix_my_login_logo');

add_action('init', 'remover_cosas');
function remover_cosas()
{
    remove_action('storefront_header', 'storefront_skip_links', 5);
    add_action('storefront_header', 'storefront_header_cart', 35);
    remove_action('storefront_header', 'storefront_product_search', 40);
    remove_action('storefront_header', 'storefront_header_cart', 60);
    remove_action('storefront_header', 'storefront_primary_navigation', 50);

    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_before_shop_loop', 'storefront_woocommerce_pagination', 30);

    remove_action('woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10);

    add_action("woocommerce_after_shop_loop_item_title", "add_attributes_products", 2);
}

// remove sidebar for woocommerce pages 
//add_action('get_header', 'remove_storefront_sidebar');
function remove_storefront_sidebar()
{
    if (!is_shop()) {
        remove_action('storefront_sidebar', 'storefront_get_sidebar', 10);
    }
}

//add attributes producto shop page
//add_action('init', 'add_attributes_products');
function add_attributes_products()
{

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
        echo get_the_term_list($post->ID, $attribute['name'], '<div class="attributes">' . $attribute_label . ' :  ', ', ', '</div>');
    }
}

// Ocultar aviso de cupones en carrito y finalizar compra
function ocultar_aviso_cupon($enabled)
{
    if (is_cart() || is_checkout()) {
        $enabled = false;
    }
    return $enabled;
}
add_filter('woocommerce_coupons_enabled', 'ocultar_aviso_cupon');




add_action('wpmem_register_redirect', 'the_reg_redirect');
function the_reg_redirect()
{
    // NOTE: this is an action hook that uses wp_redirect
    // wp_redirect must end with exit();

    $url = get_bloginfo('url');

    wp_redirect($url . '/shop');

    exit();
}


add_filter('wpmem_login_redirect', 'my_first_login_redirect', 10, 2);
function my_first_login_redirect($redirect_to, $user_id)
{

    // Set page to redirect the user to.
    // @uses https://codex.wordpress.org/Function_Reference/home_url
    $redirect_url = home_url('my-account');

    // See if the user has already logged in before
    // @uses https://codex.wordpress.org/Function_Reference/get_user_meta
    $first_login = get_user_meta($user_id, 'first_login', true);
    if (!$first_login) {
        // Sets that the user has done their first login
        // @uses https://codex.wordpress.org/Function_Reference/update_user_meta
        update_user_meta($user_id, 'first_login', 'true');

        // Set redirect based on user's first login
        $redirect_to = $redirect_url;
    }

    return $redirect_to;
}


add_filter('wpmem_login_redirect', 'my_login_redirect', 10, 2);
function my_login_redirect($redirect_to, $user_id)
{

    // This will redirect to https://yourdomain.com/your-page/
    return home_url('/my-account/');
}


add_filter('woocommerce_account_menu_items', 'misha_remove_my_account_links');
function misha_remove_my_account_links($menu_links)
{

    unset($menu_links['downloads']);
    unset($menu_links['memberships']);


    //unset( $menu_links['dashboard'] ); // Remove Dashboard
    //unset( $menu_links['payment-methods'] ); // Remove Payment Methods
    //unset( $menu_links['orders'] ); // Remove Orders
    //unset( $menu_links['downloads'] ); // Disable Downloads
    //unset( $menu_links['edit-account'] ); // Remove Account details tab
    //unset( $menu_links['customer-logout'] ); // Remove Logout link

    return $menu_links;
}
