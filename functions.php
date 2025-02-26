<?php
/**
 * TailwindWP functions and definitions
 */
require_once get_template_directory() . '/dummy-content.php';
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

/**
 * Generate inline CSS from theme settings
 */
function tailwindwp_custom_colors() {
    if (!function_exists('get_field')) {
        return;
    }
    
    // Get color settings from ACF options page
    $primary_color = get_field('primary_color', 'option') ?: '#0ea5e9'; // Default blue
    $secondary_color = get_field('secondary_color', 'option') ?: '#64748b'; // Default slate
    
    // Convert hex to RGB for alpha colors
    $primary_rgb = tailwindwp_hex_to_rgb($primary_color);
    $secondary_rgb = tailwindwp_hex_to_rgb($secondary_color);
    
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
    /* Add more overrides as needed */
    ";
    
    // Output the CSS
    wp_add_inline_style('tailwindwp-styles', $css);
}
add_action('wp_enqueue_scripts', 'tailwindwp_custom_colors', 20);

/**
 * Helper function to convert HEX to RGB
 */
function tailwindwp_hex_to_rgb($hex) {
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
 * Add color picker fields to Theme Settings
 */
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_theme_colors',
        'title' => 'Theme Colors',
        'fields' => [
            [
                'key' => 'field_primary_color',
                'label' => 'Primary Color',
                'name' => 'primary_color',
                'type' => 'color_picker',
                'instructions' => 'Choose the main color for buttons, links, and accents',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '#0ea5e9',
            ],
            [
                'key' => 'field_secondary_color',
                'label' => 'Secondary Color',
                'name' => 'secondary_color',
                'type' => 'color_picker',
                'instructions' => 'Choose the secondary color for the theme',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '#64748b',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'theme-settings',
                ],
            ],
        ],
        'menu_order' => 10,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ]);
}