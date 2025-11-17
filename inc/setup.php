<?php
/**
 * Theme setup functions
 */

if (!function_exists('mvw_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features
     */
    function mvw_setup() {
        // Make theme available for translation
        load_theme_textdomain('mvw', defined('MVW_DIR') ? MVW_DIR . '/languages' : get_template_directory() . '/languages');

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
add_action('after_setup_theme', 'mvw_setup');

/**
 * Set the content width in pixels
 */
if (!function_exists('mvw_content_width')) {
    function mvw_content_width() {
        $GLOBALS['content_width'] = apply_filters('mvw_content_width', 1280);
    }
    add_action('after_setup_theme', 'mvw_content_width', 0);
}