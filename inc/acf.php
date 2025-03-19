<?php
/**
 * ACF Fields Registration
 *
 * @package MeonValleyWeb
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
 * Register ACF fields
 */
function mvw_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    
    // Hero Section Fields
    acf_add_local_field_group([
        'key' => 'group_hero',
        'title' => 'Hero Section',
        'fields' => [
            [
                'key' => 'field_enable_hero',
                'label' => 'Enable Hero Section',
                'name' => 'enable_hero',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_hero_style',
                'label' => 'Hero Style',
                'name' => 'hero_style',
                'type' => 'select',
                'choices' => [
                    'standard' => 'Standard',
                    'fullscreen' => 'Fullscreen',
                    'split' => 'Split (Image/Text)',
                ],
                'default_value' => 'standard',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_enable_hero',
                            'operator' => '==',
                            'value' => '1',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_hero_title',
                'label' => 'Title',
                'name' => 'hero_title',
                'type' => 'text',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_enable_hero',
                            'operator' => '==',
                            'value' => '1',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_hero_text',
                'label' => 'Text',
                'name' => 'hero_text',
                'type' => 'textarea',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_enable_hero',
                            'operator' => '==',
                            'value' => '1',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_hero_image',
                'label' => 'Background Image',
                'name' => 'hero_image',
                'type' => 'image',
                'return_format' => 'array',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_enable_hero',
                            'operator' => '==',
                            'value' => '1',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_hero_button',
                'label' => 'Button',
                'name' => 'hero_button',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_hero_button_text',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_hero_button_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'url',
                    ],
                ],
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_enable_hero',
                            'operator' => '==',
                            'value' => '1',
                        ],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'default',
                ],
            ],
            [
                [
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ],
            ],
        ],
    ]);
    
    // Flexible Content Blocks
    acf_add_local_field_group([
        'key' => 'group_content_blocks',
        'title' => 'Content Blocks',
        'fields' => [
            [
                'key' => 'field_content_blocks',
                'label' => 'Content Blocks',
                'name' => 'content_blocks',
                'type' => 'flexible_content',
                'button_label' => 'Add Content Block',
                'layouts' => [
                    // Text Block
                    'text_block' => [
                        'key' => 'layout_text_block',
                        'name' => 'text_block',
                        'label' => 'Text Block',
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => 'field_text_heading',
                                'label' => 'Heading',
                                'name' => 'heading',
                                'type' => 'text',
                            ],
                            [
                                'key' => 'field_text_content',
                                'label' => 'Content',
                                'name' => 'content',
                                'type' => 'wysiwyg',
                            ],
                            [
                                'key' => 'field_text_width',
                                'label' => 'Content Width',
                                'name' => 'width',
                                'type' => 'select',
                                'choices' => [
                                    'narrow' => 'Narrow',
                                    'medium' => 'Medium',
                                    'wide' => 'Wide',
                                    'full' => 'Full Width',
                                ],
                                'default_value' => 'medium',
                            ],
                        ],
                    ],
                    
                    // Feature Grid
                    'feature_grid' => [
                        'key' => 'layout_feature_grid',
                        'name' => 'feature_grid',
                        'label' => 'Feature Grid',
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => 'field_feature_heading',
                                'label' => 'Section Heading',
                                'name' => 'heading',
                                'type' => 'text',
                            ],
                            [
                                'key' => 'field_feature_description',
                                'label' => 'Section Description',
                                'name' => 'description',
                                'type' => 'textarea',
                            ],
                            [
                                'key' => 'field_features',
                                'label' => 'Features',
                                'name' => 'features',
                                'type' => 'repeater',
                                'layout' => 'block',
                                'button_label' => 'Add Feature',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_feature_title',
                                        'label' => 'Title',
                                        'name' => 'title',
                                        'type' => 'text',
                                    ],
                                    [
                                        'key' => 'field_feature_text',
                                        'label' => 'Text',
                                        'name' => 'text',
                                        'type' => 'textarea',
                                    ],
                                    [
                                        'key' => 'field_feature_icon',
                                        'label' => 'Icon',
                                        'name' => 'icon',
                                        'type' => 'image',
                                        'return_format' => 'array',
                                    ],
                                    [
                                        'key' => 'field_feature_link',
                                        'label' => 'Link',
                                        'name' => 'link',
                                        'type' => 'link',
                                    ],
                                ],
                            ],
                            [
                                'key' => 'field_feature_columns',
                                'label' => 'Columns',
                                'name' => 'columns',
                                'type' => 'select',
                                'choices' => [
                                    '2' => '2 Columns',
                                    '3' => '3 Columns',
                                    '4' => '4 Columns',
                                ],
                                'default_value' => '3',
                            ],
                        ],
                    ],
                    
                    // Image and Text
                    'image_text' => [
                        'key' => 'layout_image_text',
                        'name' => 'image_text',
                        'label' => 'Image and Text',
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => 'field_it_image',
                                'label' => 'Image',
                                'name' => 'image',
                                'type' => 'image',
                                'return_format' => 'array',
                            ],
                            [
                                'key' => 'field_it_heading',
                                'label' => 'Heading',
                                'name' => 'heading',
                                'type' => 'text',
                            ],
                            [
                                'key' => 'field_it_content',
                                'label' => 'Content',
                                'name' => 'content',
                                'type' => 'wysiwyg',
                            ],
                            [
                                'key' => 'field_it_layout',
                                'label' => 'Layout',
                                'name' => 'layout',
                                'type' => 'select',
                                'choices' => [
                                    'image_left' => 'Image Left',
                                    'image_right' => 'Image Right',
                                ],
                                'default_value' => 'image_left',
                            ],
                            [
                                'key' => 'field_it_button',
                                'label' => 'Button',
                                'name' => 'button',
                                'type' => 'group',
                                'layout' => 'block',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_it_button_text',
                                        'label' => 'Text',
                                        'name' => 'text',
                                        'type' => 'text',
                                    ],
                                    [
                                        'key' => 'field_it_button_url',
                                        'label' => 'URL',
                                        'name' => 'url',
                                        'type' => 'url',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    
                    // Call to Action
                    'cta' => [
                        'key' => 'layout_cta',
                        'name' => 'cta',
                        'label' => 'Call to Action',
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => 'field_cta_heading',
                                'label' => 'Heading',
                                'name' => 'heading',
                                'type' => 'text',
                            ],
                            [
                                'key' => 'field_cta_text',
                                'label' => 'Text',
                                'name' => 'text',
                                'type' => 'textarea',
                            ],
                            [
                                'key' => 'field_cta_button',
                                'label' => 'Button',
                                'name' => 'button',
                                'type' => 'group',
                                'layout' => 'block',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_cta_button_text',
                                        'label' => 'Text',
                                        'name' => 'text',
                                        'type' => 'text',
                                    ],
                                    [
                                        'key' => 'field_cta_button_url',
                                        'label' => 'URL',
                                        'name' => 'url',
                                        'type' => 'url',
                                    ],
                                ],
                            ],
                            [
                                'key' => 'field_cta_background',
                                'label' => 'Background Image',
                                'name' => 'background',
                                'type' => 'image',
                                'return_format' => 'array',
                            ],
                        ],
                    ],
                    
                    // Gallery
                    'gallery' => [
                        'key' => 'layout_gallery',
                        'name' => 'gallery',
                        'label' => 'Gallery',
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => 'field_gallery_heading',
                                'label' => 'Heading',
                                'name' => 'heading',
                                'type' => 'text',
                            ],
                            [
                                'key' => 'field_gallery_images',
                                'label' => 'Images',
                                'name' => 'images',
                                'type' => 'gallery',
                            ],
                            [
                                'key' => 'field_gallery_columns',
                                'label' => 'Columns',
                                'name' => 'columns',
                                'type' => 'select',
                                'choices' => [
                                    '2' => '2 Columns',
                                    '3' => '3 Columns',
                                    '4' => '4 Columns',
                                ],
                                'default_value' => '3',
                            ],
                        ],
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
    ]);
    
    // Site Options
    acf_add_local_field_group([
        'key' => 'group_site_options',
        'title' => 'Site Options',
        'fields' => [
            [
                'key' => 'field_company_info',
                'label' => 'Company Information',
                'name' => 'company_info',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_company_name',
                        'label' => 'Company Name',
                        'name' => 'name',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_company_address',
                        'label' => 'Address',
                        'name' => 'address',
                        'type' => 'textarea',
                    ],
                    [
                        'key' => 'field_company_phone',
                        'label' => 'Phone',
                        'name' => 'phone',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_company_email',
                        'label' => 'Email',
                        'name' => 'email',
                        'type' => 'email',
                    ],
                ],
            ],
            [
                'key' => 'field_social_links',
                'label' => 'Social Media',
                'name' => 'social_links',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_facebook',
                        'label' => 'Facebook',
                        'name' => 'facebook',
                        'type' => 'url',
                    ],
                    [
                        'key' => 'field_twitter',
                        'label' => 'Twitter',
                        'name' => 'twitter',
                        'type' => 'url',
                    ],
                    [
                        'key' => 'field_instagram',
                        'label' => 'Instagram',
                        'name' => 'instagram',
                        'type' => 'url',
                    ],
                    [
                        'key' => 'field_linkedin',
                        'label' => 'LinkedIn',
                        'name' => 'linkedin',
                        'type' => 'url',
                    ],
                ],
            ],
            [
                'key' => 'field_footer_text',
                'label' => 'Footer Text',
                'name' => 'footer_text',
                'type' => 'wysiwyg',
            ],
            [
                'key' => 'field_show_top_bar',
                'label' => 'Show Top Contact Bar',
                'name' => 'show_top_bar',
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 1,
            ],
            [
                'key' => 'field_footer_style',
                'label' => 'Footer Style',
                'name' => 'footer_style',
                'type' => 'select',
                'choices' => [
                    'standard' => 'Standard (Full)',
                    'minimal' => 'Minimal (Copyright Only)',
                ],
                'default_value' => 'standard',
            ],
            [
                'key' => 'field_theme_colors',
                'label' => 'Theme Colors',
                'name' => 'theme_colors',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_primary_color',
                        'label' => 'Primary Color',
                        'name' => 'primary_color',
                        'type' => 'color_picker',
                        'default_value' => '#0ea5e9',
                    ],
                    [
                        'key' => 'field_secondary_color',
                        'label' => 'Secondary Color',
                        'name' => 'secondary_color',
                        'type' => 'color_picker',
                        'default_value' => '#64748b',
                    ],
                ],
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
    ]);
}
add_action('acf/init', 'mvw_register_acf_fields');