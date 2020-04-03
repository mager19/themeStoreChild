<?php

/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package batanaWeb
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function batanaweb_woocommerce_setup()
{
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'batanaweb_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function batanaweb_woocommerce_scripts()
{
    wp_enqueue_style('batanaweb-woocommerce-style', get_template_directory_uri() . '/woocommerce.css');

    $font_path   = WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

    wp_add_inline_style('batanaweb-woocommerce-style', $inline_font);
}
add_action('wp_enqueue_scripts', 'batanaweb_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function batanaweb_woocommerce_active_body_class($classes)
{
    $classes[] = 'woocommerce-active';

    return $classes;
}
add_filter('body_class', 'batanaweb_woocommerce_active_body_class');

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function batanaweb_woocommerce_products_per_page()
{
    return 12;
}
add_filter('loop_shop_per_page', 'batanaweb_woocommerce_products_per_page');

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function batanaweb_woocommerce_thumbnail_columns()
{
    return 4;
}
add_filter('woocommerce_product_thumbnails_columns', 'batanaweb_woocommerce_thumbnail_columns');

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function batanaweb_woocommerce_loop_columns()
{
    return 3;
}
add_filter('loop_shop_columns', 'batanaweb_woocommerce_loop_columns');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function batanaweb_woocommerce_related_products_args($args)
{
    $defaults = array(
        'posts_per_page' => 3,
        'columns'        => 3,
    );

    $args = wp_parse_args($defaults, $args);

    return $args;
}
add_filter('woocommerce_output_related_products_args', 'batanaweb_woocommerce_related_products_args');

if (!function_exists('batanaweb_woocommerce_product_columns_wrapper')) {
    /**
     * Product columns wrapper.
     *
     * @return  void
     */
    function batanaweb_woocommerce_product_columns_wrapper()
    {
        $columns = batanaweb_woocommerce_loop_columns();
        echo '<div class="columns-' . absint($columns) . '">';
    }
}
add_action('woocommerce_before_shop_loop', 'batanaweb_woocommerce_product_columns_wrapper', 40);

if (!function_exists('batanaweb_woocommerce_product_columns_wrapper_close')) {
    /**
     * Product columns wrapper close.
     *
     * @return  void
     */
    function batanaweb_woocommerce_product_columns_wrapper_close()
    {
        echo '</div>';
    }
}
add_action('woocommerce_after_shop_loop', 'batanaweb_woocommerce_product_columns_wrapper_close', 40);

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('batanaweb_woocommerce_wrapper_before')) {
    /**
     * Before Content.
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function batanaweb_woocommerce_wrapper_before()
    {
?>

        <div id="primary " class="content-area">
            <main id="main" class="site-main" role="main">
            <?php
        }
    }
    add_action('woocommerce_before_main_content', 'batanaweb_woocommerce_wrapper_before');

    if (!function_exists('batanaweb_woocommerce_wrapper_after')) {
        /**
         * After Content.
         *
         * Closes the wrapping divs.
         *
         * @return void
         */
        function batanaweb_woocommerce_wrapper_after()
        {
            ?>
            </main><!-- #main -->
        </div><!-- #primary -->
    <?php
        }
    }
    add_action('woocommerce_after_main_content', 'batanaweb_woocommerce_wrapper_after');

    /**
     * Sample implementation of the WooCommerce Mini Cart.
     *
     * You can add the WooCommerce Mini Cart to header.php like so ...
     *
	<?php
		if ( function_exists( 'batanaweb_woocommerce_header_cart' ) ) {
			batanaweb_woocommerce_header_cart();
		}
	?>
     */

    if (!function_exists('batanaweb_woocommerce_cart_link_fragment')) {
        /**
         * Cart Fragments.
         *
         * Ensure cart contents update when products are added to the cart via AJAX.
         *
         * @param array $fragments Fragments to refresh via AJAX.
         * @return array Fragments to refresh via AJAX.
         */
        function batanaweb_woocommerce_cart_link_fragment($fragments)
        {
            ob_start();
            batanaweb_woocommerce_cart_link();
            $fragments['a.cart-contents'] = ob_get_clean();

            return $fragments;
        }
    }
    add_filter('woocommerce_add_to_cart_fragments', 'batanaweb_woocommerce_cart_link_fragment');

    if (!function_exists('batanaweb_woocommerce_cart_link')) {
        /**
         * Cart Link.
         *
         * Displayed a link to the cart including the number of items present and the cart total.
         *
         * @return void
         */
        function batanaweb_woocommerce_cart_link()
        {
    ?>
        <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'batanaweb'); ?>">
            <?php
            $item_count_text = sprintf(
                /* translators: number of items in the mini cart. */
                _n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'batanaweb'),
                WC()->cart->get_cart_contents_count()
            );
            ?>
            <span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span> <span class="count"><?php echo esc_html($item_count_text); ?></span>
        </a>
    <?php
        }
    }

    if (!function_exists('batanaweb_woocommerce_header_cart')) {
        /**
         * Display Header Cart.
         *
         * @return void
         */
        function batanaweb_woocommerce_header_cart()
        {
            if (is_cart()) {
                $class = 'current-menu-item';
            } else {
                $class = '';
            }
    ?>
        <ul id="site-header-cart" class="site-header-cart">
            <li class="<?php echo esc_attr($class); ?>">
                <?php batanaweb_woocommerce_cart_link(); ?>
            </li>
            <li>
                <?php
                $instance = array(
                    'title' => '',
                );

                the_widget('WC_Widget_Cart', $instance);
                ?>
            </li>
        </ul>
<?php
        }
    }



    /*********************/

    //adding new tab//
    add_filter('woocommerce_product_tabs', 'woo_new_product_tab');
    function woo_new_product_tab($tabs)
    {

        // Adds the new tab

        $tabs['detalles'] = array(
            'title'     => __('Detalles', 'woocommerce'),
            'priority'     => 50,
            'callback'     => 'woo_new_product_tab_content'
        );

        return $tabs;
    }
    function woo_new_product_tab_content()
    {
        // The new tab content
        echo '<h2>' . __('Detalles', 'woocommerce') . '</h2>';
        echo get_field('detalles', $post_id);
    }

    add_filter('woocommerce_product_tabs', 'woo_new_product_tab2');
    function woo_new_product_tab2($tabs)
    {

        // Adds the new tab

        $tabs['cuidados'] = array(
            'title'     => __('Cuidados', 'woocommerce'),
            'priority'     => 50,
            'callback'     => 'woo_new_product_tab_content2'
        );

        return $tabs;
    }
    function woo_new_product_tab_content2()
    {
        // The new tab content
        echo '<h2>' . __('Cuidados', 'woocommerce') . '</h2>';
        echo get_field('cuidados', $post_id);
    }

    add_action('woocommerce_product_meta_end', 'product_last_information');

    function product_last_information()
    {
        //echo '<h2>'.__( 'Tallas', 'woocommerce' ).'</h2>';
        echo '<div class="mt-3 info">';

        if (get_field('disponible', $post_id)) {
            echo '
<div class="available">
<h5>
  <a href="#" class="color-white" data-toggle="modal" data-target="#largeModal">' . __('SOLICITA AVISO DE DISPONIBILIDAD', 'woocommerce') . '</a> </h5>
<div style="display: none;" class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">'
                . do_shortcode(get_field('disponible', $post_id)) .
                '</div>
      
    </div>
  </div>
</div>
</div>
';
        }
        if (get_field('guia_de_tallas', $post_id)) {
            echo '
<h5>
  <a href="#" class="color-white" data-toggle="modal" data-target="#tallasModal">' . __('Guia de tallas', 'woocommerce') . '</a> </h5>
<div style="display: none;" class="modal fade" id="tallasModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"><center><h3>Guia de tallas</h3></center>'
                . do_shortcode(get_field('guia_de_tallas', $post_id)) .
                '</div>
      
    </div>
  </div>
</div>
';
        }
        if (get_field('envios', $post_id)) {
            echo '<h5>
  <a href="' . get_field('envios', $post_id) . '" class="color-white" data-toggle="modal" data-target="#enviosModal" >' . __('Envios', 'woocommerce') . '</a> </h5>';
        }
        if (get_field('cambios_y_devoluciones', $post_id)) {
            echo '<h5>
  <a href="' . get_field('cambios_y_devoluciones', $post_id) . '" class="color-white" data-toggle="modal" data-target="#devolucionesModal">' . __('Cambios y devoluciones', 'woocommerce') . '</a> </h5>';
        }
        if (get_theme_mod('textoPagoPlazos')) {
            echo '<h5>
  <a href="' . get_theme_mod('textoPagoPlazos') . '" class="color-white" data-toggle="modal" data-target="#plazosModal">' . __('Pago a plazos', 'woocommerce') . '</a> </h5>';
        }
        if (get_field('descripcion_y_cuidados', $post_id)) {
            echo '<h5>
  <a href="' . get_field('descripcion_y_cuidados', $post_id) . '" class="color-white" target="_blank">' . __('Descripción y cuidados', 'woocommerce') . '</a> </h5>';
        }
        echo '</div>';
        //echo get_field('guia_de_tallas', $post_id);
    }



    remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');


    /*disponibilidad*/
    /*add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2); 
function wcs_custom_get_availability( $availability, $_product ) {  
	   
    if ( ! $_product->is_in_stock() ) {         
    	$availability['availability'] = __('Agotado', 'woocommerce').',<span> Solicita aviso de disponibilidad.</span>';
    	
    //.'<br><a href="#" class="color-white agotado"  data-toggle="modal" data-target="#largeModal">'.__( 'Avisar cuando vuelva a estar disponible', 'woocommerce' ).'</a>')
         }  
     
	return $availability; }*/
    /*add_action('woocommerce_product_meta_end', 'add_contact_form', 10);
function add_contact_form() {
    global $product;
    if(!$product->is_in_stock( )) {
       echo '<a href="#" class="color-white agotado"  data-toggle="modal" data-target="#largeModal">'.__( 'Avisar cuando vuelva a estar disponible2', 'woocommerce' ).'</a>';
    }
}*/



    /* ELIMINACION DE CAMPOS DEL CHECKOUT WOOCOMMERCE */

    add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

    function custom_override_checkout_fields($fields)
    {

        unset($fields['billing']['billing_company']);
        /*unset($fields['billing']['billing_address_1']);
 unset($fields['billing']['billing_address_2']);
 unset($fields['billing']['billing_city']);
 unset($fields['billing']['billing_postcode']);
 unset($fields['billing']['billing_state']);
 unset($fields['order']['order_comments']);*/

        return $fields;
    }

/*
function mi_funcion () {
  // ell código que queramos
	//remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
	//add_action( 'woocommerce_after_checkout_billing_form', 'woocommerce_checkout_login_form' );
	echo "hola";
}
add_action( 'woocommerce_login_checkout', 'mi_funcion');
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
add_action( 'woocommerce_login_checkout', 'woocommerce_checkout_login_form' );
*/
