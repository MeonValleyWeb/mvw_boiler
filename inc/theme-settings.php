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

/**
 * Get theme option helper function
 * 
 * @param string $option_name The field name to retrieve
 * @param mixed $default The default value if option is not found
 * @return mixed The field value or default
 */
function mvw_get_option($option_name, $default = '') {
    if (!function_exists('get_field')) {
        return $default;
    }
    
    $value = get_field($option_name, 'option');
    return $value !== null && $value !== '' ? $value : $default;
}

/**
 * Helper function to convert HEX to RGB
 * 
 * @param string $hex Hex color code
 * @return string RGB values as string (format: "R, G, B")
 */
function mvw_hex_to_rgb($hex) {
    $hex = str_replace('#', '', $hex);
    
    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    
    return "{$r}, {$g}, {$b}";
}

/**
 * Generate custom CSS from theme settings
 */
function mvw_generate_custom_css() {
    // Get color settings
    $primary_color = mvw_get_option('theme_colors_primary_color', '#0ea5e9');
    $secondary_color = mvw_get_option('theme_colors_secondary_color', '#64748b');
    
    // Convert hex to RGB for alpha colors
    $primary_rgb = mvw_hex_to_rgb($primary_color);
    $secondary_rgb = mvw_hex_to_rgb($secondary_color);
    
    // Create CSS variables
    $css = "
    :root {
        --color-primary: {$primary_color};
        --color-primary-rgb: {$primary_rgb};
        --color-secondary: {$secondary_color};
        --color-secondary-rgb: {$secondary_rgb};
    }
    
    /* Override Tailwind CSS classes */
    .bg-primary-600 {
        background-color: var(--color-primary) !important;
    }
    .text-primary-600 {
        color: var(--color-primary) !important;
    }
    .hover\\:bg-primary-700:hover {
        background-color: var(--color-primary) !important;
        filter: brightness(0.9) !important;
    }
    .bg-secondary-600 {
        background-color: var(--color-secondary) !important;
    }
    .text-secondary-600 {
        color: var(--color-secondary) !important;
    }
    ";
    
    // Output the CSS
    wp_add_inline_style('mvw-styles', $css);
}
add_action('wp_enqueue_scripts', 'mvw_generate_custom_css', 20);