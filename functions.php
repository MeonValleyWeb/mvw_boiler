<?php
/**
 * TailwindWP functions and definitions
 */

// Theme version
define('TAILWINDWP_VERSION', '1.0.0');

// Theme directory path/URI
define('TAILWINDWP_DIR', get_template_directory());
define('TAILWINDWP_URI', get_template_directory_uri());

/**
 * Theme setup
 */
require_once TAILWINDWP_DIR . '/inc/setup.php';

/**
 * Enqueue scripts and styles
 */
function tailwindwp_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style(
        'tailwindwp-styles', 
        TAILWINDWP_URI . '/dist/css/main.css', 
        [], 
        TAILWINDWP_VERSION
    );
    
    // Enqueue main JavaScript
    wp_enqueue_script(
        'tailwindwp-scripts', 
        TAILWINDWP_URI . '/dist/js/main.js', 
        [], 
        TAILWINDWP_VERSION, 
        true
    );
    
    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'tailwindwp_scripts');

/**
 * ACF integration
 */
require_once TAILWINDWP_DIR . '/inc/acf.php';

/**
 * Custom shortcodes
 */
require_once TAILWINDWP_DIR . '/inc/shortcodes.php';

/**
 * Widget areas
 */
require_once TAILWINDWP_DIR . '/inc/widgets.php';

/**
 * Theme customizer options
 */
require_once TAILWINDWP_DIR . '/inc/customizer.php';