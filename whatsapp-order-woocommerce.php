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


add_action('admin_init', 'wow_register_settings');

function wow_register_settings() {
    register_setting('wow_settings_group', 'wow_whatsapp_number');
}


function wow_settings_page() {

    $number = get_option('wow_whatsapp_number');

    ?>
    <div class="wrap">
        <h1>WhatsApp Order Settings</h1>

        <form method="post" action="options.php">
            <?php
                settings_fields('wow_settings_group');
                do_settings_sections('wow_settings_group');
            ?>

            <table class="form-table">
                <tr>
                    <th>WhatsApp Number</th>
                    <td>
                        <input type="text" name="wow_whatsapp_number" value="<?php echo esc_attr($number); ?>" placeholder="9999999999" />
                        <p class="description">Enter number with country code</p>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
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

    $phone = 91 . get_option('wow_whatsapp_number');
    echo '<button class="whatsapp-order-btn" data-phone="' . $phone . '">
    Order on WhatsApp
    </button>';
}

add_action('woocommerce_single_product_summary', 'wow_add_whatsapp_button', 35);


add_action('admin_menu', 'wow_add_admin_menu');

function wow_add_admin_menu() {
    add_menu_page(
        'WhatsApp Orders',   // Page title
        'WhatsApp Orders',   // Menu title
        'manage_options',    // Capability
        'wow-settings',      // Slug
        'wow_settings_page', // Callback
        'dashicons-whatsapp',// Icon
        25
    );
}