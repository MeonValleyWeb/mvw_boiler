<?php
/**
 * MeonValleyWeb Theme functions and definitions
 *
 * @package MeonValleyWeb
 */

// Theme version
define('MVW_VERSION', '1.0.0');

// Theme directory path/URI
define('MVW_DIR', get_template_directory());
define('MVW_URI', get_template_directory_uri());

/**
 * Theme setup
 */
function mvw_setup() {
    // Make theme available for translation
    load_theme_textdomain('mvw', MVW_DIR . '/languages');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus([
        'primary' => esc_html__('Primary Menu', 'mvw'),
        'footer' => esc_html__('Footer Menu', 'mvw'),
    ]);

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for full and wide align images
    add_theme_support('align-wide');

    // Add support for custom logo
    add_theme_support('custom-logo', [
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ]);

    // Set content width
    $GLOBALS['content_width'] = apply_filters('mvw_content_width', 1280);
}
add_action('after_setup_theme', 'mvw_setup');

/**
 * Enqueue scripts and styles
 */
function mvw_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style(
        'mvw-styles', 
        MVW_URI . '/dist/css/main.css', 
        [], 
        MVW_VERSION
    );
    
    // Enqueue main JavaScript
    wp_enqueue_script(
        'mvw-scripts', 
        MVW_URI . '/dist/js/main.js', 
        [], 
        MVW_VERSION, 
        true
    );
    
    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'mvw_scripts');

/**
 * Register ACF options page
 */
function mvw_acf_options_page() {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Theme Options',
            'menu_title' => 'Theme Options',
            'menu_slug' => 'theme-options',
            'capability' => 'edit_theme_options',
            'redirect' => false,
            'icon_url' => 'dashicons-admin-customizer',
            'position' => 59,
        ]);
    }
}
add_action('acf/init', 'mvw_acf_options_page');

/**
 * Generate inline CSS from theme settings
 */
function mvw_custom_colors() {
    if (!function_exists('get_field')) {
        return;
    }
    
    // Get color settings
    $primary_color = get_field('theme_colors_primary_color', 'option') ?: '#0ea5e9';
    $secondary_color = get_field('theme_colors_secondary_color', 'option') ?: '#64748b';
    
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
add_action('wp_enqueue_scripts', 'mvw_custom_colors', 20);

/**
 * Helper function to convert HEX to RGB
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
 * Get theme option helper function
 */
function mvw_get_option($option_name, $default = '') {
    if (!function_exists('get_field')) {
        return $default;
    }
    
    $value = get_field($option_name, 'option');
    return $value !== null && $value !== '' ? $value : $default;
}

/**
 * Email Delivery Configuration
 * 
 * Note: Email delivery is handled via a dedicated plugin (WP Mail SMTP or similar)
 * Configure the plugin to use Amazon SES credentials stored in environment variables
 * 
 * For Bedrock:
 * 1. Add SES credentials to .env file
 * 2. Add configuration to config/application.php
 * 3. Install and configure WP Mail SMTP plugin
 */

/**
 * Load theme files and components
 */
$includes = [
    'inc/acf-fields.php',              // ACF fields registration
    'inc/blocks.php',                  // Block templates
    'inc/template-functions.php',      // Custom template functions
    'inc/template-tags.php',           // Template tags
    'inc/widgets.php',                 // Widget areas
    'inc/customizer.php',              // Theme customizer
];

foreach ($includes as $file) {
    if (file_exists(MVW_DIR . '/' . $file)) {
        require_once MVW_DIR . '/' . $file;
    }
}