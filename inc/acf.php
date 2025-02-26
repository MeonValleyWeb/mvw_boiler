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

/**
 * ACF fields for the hero section
 * 
 * Add this to your acf.php file or import it
 */

 if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_hero_section',
        'title' => 'Hero Section',
        'fields' => [
            [
                'key' => 'field_enable_hero',
                'label' => 'Enable Hero Section',
                'name' => 'enable_hero',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'message' => '',
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ],
            [
                'key' => 'field_hero_pre_title',
                'label' => 'Pre-title',
                'name' => 'hero_pre_title',
                'type' => 'text',
                'instructions' => 'Small text that appears above the main title',
                'required' => 0,
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_enable_hero',
                            'operator' => '==',
                            'value' => '1',
                        ],
                    ],
                ],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_hero_title',
                'label' => 'Title',
                'name' => 'hero_title',
                'type' => 'text',
                'instructions' => 'Main hero title',
                'required' => 0,
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_enable_hero',
                            'operator' => '==',
                            'value' => '1',
                        ],
                    ],
                ],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_hero_description',
                'label' => 'Description',
                'name' => 'hero_description',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_enable_hero',
                            'operator' => '==',
                            'value' => '1',
                        ],
                    ],
                ],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => 4,
                'new_lines' => 'br',
            ],
            [
                'key' => 'field_hero_background',
                'label' => 'Background Image',
                'name' => 'hero_background',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_enable_hero',
                            'operator' => '==',
                            'value' => '1',
                        ],
                    ],
                ],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ],
            [
                'key' => 'field_hero_primary_button',
                'label' => 'Primary Button',
                'name' => 'hero_primary_button',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_enable_hero',
                            'operator' => '==',
                            'value' => '1',
                        ],
                    ],
                ],
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_hero_primary_button_text',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => 'Get Started',
                        'placeholder' => '',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_hero_primary_button_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                    ],
                ],
            ],
            [
                'key' => 'field_hero_secondary_button',
                'label' => 'Secondary Button',
                'name' => 'hero_secondary_button',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_enable_hero',
                            'operator' => '==',
                            'value' => '1',
                        ],
                    ],
                ],
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_hero_secondary_button_text',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => 'Learn More',
                        'placeholder' => '',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_hero_secondary_button_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'acf_after_title',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ]);
}