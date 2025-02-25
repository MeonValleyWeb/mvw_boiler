<?php
/**
 * ACF integration
 */

/**
 * Register ACF options page
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-settings',
        'capability' => 'edit_posts',
        'redirect' => false,
    ]);
}

/**
 * Register ACF blocks
 */
function tailwindwp_register_acf_blocks() {
    if (function_exists('acf_register_block_type')) {
        // Example block - uncomment and customize as needed
        /*
        acf_register_block_type([
            'name' => 'testimonial',
            'title' => __('Testimonial', 'tailwindwp'),
            'description' => __('A custom testimonial block.', 'tailwindwp'),
            'render_template' => 'template-parts/blocks/testimonial.php',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => ['testimonial', 'quote'],
        ]);
        */
    }
}
// add_action('acf/init', 'tailwindwp_register_acf_blocks');