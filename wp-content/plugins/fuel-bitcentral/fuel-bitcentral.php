<?php

/*
  Plugin Name: FUEL - Bitcentral
  Plugin URI: https://streamingfuel.com/
  Description: Display FUEL Videos
  Author: Bitcentral
  Author URI: https://bitcentral.com
  Version: 1.2
  Requires PHP: 5.6.20
  Text Domain: fuel-bitcentral
  License: GPL v2 or later
 */

if (!function_exists('is_plugin_active')) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}
$fuel_bitcentral_plugin_version = '1.2';
define('FUEL_BITCENTRAL_PLUGIN_ROOT_DIR', plugin_dir_path(__FILE__));
define('FUEL_BITCENTRAL_PLUGIN_ROOT_URL', plugin_dir_url(__FILE__));
define('FUEL_BITCENTRAL_CURRENT_VERSION', $fuel_bitcentral_plugin_version);
define('FUEL_BITCENTRAL_SCRIPT_URL', 'https://fuel-streaming-prod01.fuelmedia.io/player/1.0/player.min.js');

register_activation_hook(__FILE__, 'fuel_bitcentral_initials');

function fuel_bitcentral_initials() {
    if (file_exists(plugin_dir_path(__DIR__) . 'advanced-custom-fields-pro/acf.php')) {
        if (!is_plugin_active('advanced-custom-fields-pro/acf.php')) {
            $message = __('Please install <b>Advanced Custom Fields</b> plugin first to use <b>Fuel - Bitcentral</b> plugin.', 'error-fatal-bitcentral');
            die($message);
        }
    } else {
        if (!is_plugin_active('advanced-custom-fields/acf.php')) {
            $message = __('Please install <b>Advanced Custom Fields</b> plugin first to use <b>Fuel - Bitcentral</b> plugin.', 'error-fatal-bitcentral');
            die($message);
        }
    }
    if (!is_plugin_active('wp-all-import-pro/wp-all-import-pro.php')) {
        $message = __('Please install <b>WP All Import Pro</b> plugin first to use <b>Fuel - Bitcentral</b> plugin.', 'error-fatal-fuel-bitcentral');
        die($message);
    }
    if (!is_plugin_active('advanced-custom-fields/acf.php')) {
        $message = __('Please install <b>Advanced Custom Fields</b> plugin first to use <b>Fuel - Bitcentral</b> plugin.', 'error-fatal-bitcentral');
        die($message);
    }
    if (!is_plugin_active('wpai-acf-add-on/wpai-acf-add-on.php')) {
        $message = __('Please install <b>WP All Import - ACF Add-On</b> plugin first to use <b>Fuel - Bitcentral</b> plugin.', 'error-fatal-bitcentral');
        die($message);
    }
    fuel_bitcentral_create_script_table();
}

require_once(FUEL_BITCENTRAL_PLUGIN_ROOT_DIR . 'define.php');

add_action('admin_menu', 'fuel_bitcentral_register_options_page');

function fuel_bitcentral_register_options_page() {
    add_options_page('Fuel Settings', 'Fuel Settings', 'manage_options', 'fuel', 'fuel_bitcentral_settings_page');
    add_submenu_page('edit.php?post_type=fuel', 'Fuel Script', 'Fuel Script', 'manage_options', 'fuel_script', 'fuel_bitcentral_script_listing');
}

function fuel_bitcentral_create_script_table() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $fuel_script_table_name = $wpdb->prefix . 'fuel_script';
    $fuel_script_query = "CREATE TABLE IF NOT EXISTS $fuel_script_table_name (
        id INT(11) NOT NULL AUTO_INCREMENT, 
    	title varchar(255) NOT NULL, 
    	code varchar(255) NOT NULL, 
        count INT(11) NULL,
    	categories varchar(255) NOT NULL, 
        PRIMARY KEY (id)
      ) $charset_collate;";
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($fuel_script_query);
}
