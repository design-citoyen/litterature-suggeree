<?php
// Woocommerce 3.0 Gallery Fix

add_action( 'after_setup_theme', 'yourtheme_setup' );

function yourtheme_setup() {
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

// Breadcrumbs

function the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo get_option('home');
		echo '">';
		bloginfo('name');
		echo "</a>  ";
		if (is_category() || is_single()) {
			the_category('title_li=');
			if (is_single()) {
				echo "  ";
				the_title();
			}
		} elseif (is_page()) {
			echo the_title();
		}
	}
}

// remove Order Notes from checkout field in Woocommerce
add_filter( 'woocommerce_checkout_fields' , 'alter_woocommerce_checkout_fields' );
function alter_woocommerce_checkout_fields( $fields ) {
     unset($fields['billing']['billing_company']); // remove the option to enter in a company
     unset($fields['billing']['billing_address_1']); // remove the first line of the address
     unset($fields['billing']['billing_address_2']); // remove the second line of the address
     unset($fields['billing']['billing_postcode']); // remove the ZIP / postal code field
     unset($fields['billing']['billing_phone']); // remove the option to enter in a billing phone number
     unset($fields['order']['order_comments']); // removes the order comments / notes field
     return $fields;
}

/**
 * Auto Complete all WooCommerce orders.
 */
add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) {
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    $order->update_status( 'completed' );
}


/**
 * Register Block
 */
function register_acf_block_types() {

  // register refferal links
  acf_register_block_type(array(
    'name' => 'refferal',
    'title' => _('Refferal'),
    'description' => _('Add refferal links for bookstores'),
    'render_template' => 'template-parts/blocks/refferal/refferal.php',
    'category' => 'formatting',
    'icon' => 'admin-comments',
    'keywords' => 'array('refferal','list')'
  ));

}

// Check if function exist and hook into setup.

if( function_exist('acf_register_block_type')){
  add_action('acf/init', 'register_acf_block_types')
}
