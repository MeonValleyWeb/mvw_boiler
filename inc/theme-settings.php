<?php
/**
 * Theme Settings Page
 *
 * @package MeonValleyWeb
 */

/**
 * Register ACF options page
 */
function mvw_register_options_page() {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Theme Settings',
            'menu_title' => 'Theme Settings',
            'menu_slug' => 'theme-settings',
            'capability' => 'edit_theme_options',
            'redirect' => false,
            'icon_url' => 'dashicons-admin-customizer',
            'position' => 59,
        ]);
    }
}
add_action('acf/init', 'mvw_register_options_page');
/*
 * Helpers (e.g. `mvw_get_option`, `mvw_hex_to_rgb`) and the custom CSS
 * generator are centralised in `inc/helpers.php` and `functions.php`.
 * This file only registers the ACF options page to avoid duplicate
 * function declarations and keep responsibilities separated.
 */