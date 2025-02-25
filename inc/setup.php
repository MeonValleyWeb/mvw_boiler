<?php
/**
 * Theme setup functions
 */

if (!function_exists('tailwindwp_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features
     */
    function tailwindwp_setup() {
        // Make theme available for translation
        load_theme_textdomain('tailwindwp', TAILWINDWP_DIR . '/languages');

        // Add default posts and comments RSS feed links to head
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails
        add_theme_support('post-thumbnails');

        // Register navigation menus
        register_nav_menus([
            'primary' => esc_html__('Primary Menu', 'tailwindwp'),
            'footer' => esc_html__('Footer Menu', 'tailwindwp'),
        ]);

        // Switch default core markup to output valid HTML5
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
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
    }
}
add_action('after_setup_theme', 'tailwindwp_setup');

/**
 * Set the content width in pixels
 */
function tailwindwp_content_width() {
    $GLOBALS['content_width'] = apply_filters('tailwindwp_content_width', 1280);
}
add_action('after_setup_theme', 'tailwindwp_content_width', 0);