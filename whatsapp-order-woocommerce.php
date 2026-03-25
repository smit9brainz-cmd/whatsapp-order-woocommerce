<?php

/**
 * Plugin Name: WooCommerce WhatsApp Order Button
 * Description: Adds a WhatsApp order button on WooCommerce single product page with variation support.
 * Version: 1.0
 * Author: Smit Jadav
 */

if (!defined('ABSPATH')) {
    exit;
}

/* Enqueue JS */
function wow_enqueue_scripts()
{

    if (is_product()) {

        wp_enqueue_script(
            'wow-whatsapp-js',
            plugin_dir_url(__FILE__) . 'js/whatsapp-order.js',
            array('jquery'),
            '1.0',
            true
        );
    }

    wp_enqueue_style(
        'wow-style',
        plugin_dir_url(__FILE__) . 'css/style.css'
    );
}

add_action('wp_enqueue_scripts', 'wow_enqueue_scripts');


/* Add Button to Product Page */
function wow_add_whatsapp_button()
{

    // $phone = "917984312113";
    $phone = "919898770388";

    echo '<button class="whatsapp-order-btn" data-phone="' . $phone . '">
    Order on WhatsApp
    </button>';
}

add_action('woocommerce_single_product_summary', 'wow_add_whatsapp_button', 35);
