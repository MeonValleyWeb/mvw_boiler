<?php
/**
 * Custom Theme Settings Page for ACF Free
 * 
 * Add this to your functions.php or include from a separate file
 */

// Create a custom admin page for theme settings
function tailwindwp_add_theme_settings_page() {
    add_theme_page(
        'Theme Settings',       // Page title
        'Theme Settings',       // Menu title
        'edit_theme_options',   // Capability required
        'tailwindwp-settings',  // Menu slug
        'tailwindwp_settings_page_html' // Callback function
    );
}
add_action('admin_menu', 'tailwindwp_add_theme_settings_page');

// Callback function to render the settings page
function tailwindwp_settings_page_html() {
    // Check user capabilities
    if (!current_user_can('edit_theme_options')) {
        return;
    }
    
    // Create a post/page to attach our fields to
    $settings_page_id = get_option('tailwindwp_settings_page_id');
    if (!$settings_page_id) {
        // Create a fake post to hold our options
        $settings_post = array(
            'post_title'    => 'Theme Settings',
            'post_status'   => 'publish',
            'post_type'     => 'acf-theme-settings',
        );
        
        // Insert the post into the database
        $settings_page_id = wp_insert_post($settings_post);
        update_option('tailwindwp_settings_page_id', $settings_page_id);
    }
    
    // Process form submission
    if (isset($_POST['acf']) && wp_verify_nonce($_POST['_wpnonce'], 'acf_nonce')) {
        foreach ($_POST['acf'] as $key => $value) {
            update_field($key, $value, $settings_page_id);
        }
        
        echo '<div class="notice notice-success is-dismissible"><p>Settings saved successfully!</p></div>';
    }
    
    // Get the field ID from options
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        
        <form method="post">
            <?php 
            // Security field
            wp_nonce_field('acf_nonce');
            
            // Get fields from ACF
            $field_groups = acf_get_field_groups(array(
                'acf-theme-settings' => true
            ));
            
            if (!empty($field_groups)) {
                // Display each field group
                foreach ($field_groups as $field_group) {
                    $fields = acf_get_fields($field_group);
                    
                    echo '<div class="acf-field-group">';
                    echo '<h2>' . $field_group['title'] . '</h2>';
                    echo '<table class="form-table" role="presentation">';
                    
                    foreach ($fields as $field) {
                        // Prepare field for rendering
                        $field['value'] = get_field($field['name'], $settings_page_id);
                        $field['prefix'] = 'acf';
                        
                        echo '<tr>';
                        echo '<th scope="row">' . $field['label'] . '</th>';
                        echo '<td>';
                        // Render the field
                        acf_render_field_wrap($field);
                        echo '</td>';
                        echo '</tr>';
                    }
                    
                    echo '</table>';
                    echo '</div>';
                }
                
                submit_button('Save Settings');
            } else {
                echo '<div class="notice notice-warning"><p>No field groups found for the Theme Settings page. Please register fields using the code below:</p></div>';
                
                echo '<pre style="background:#f8f9fa;padding:15px;border:1px solid #ddd;overflow:auto;">
// Register ACF fields for theme settings
function register_theme_settings_fields() {
    if (!function_exists(\'acf_add_local_field_group\'))
        return;
        
    acf_add_local_field_group([
        \'key\' => \'group_theme_settings\',
        \'title\' => \'Theme Colors\',
        \'fields\' => [
            [
                \'key\' => \'field_primary_color\',
                \'label\' => \'Primary Color\',
                \'name\' => \'primary_color\',
                \'type\' => \'color_picker\',
                \'instructions\' => \'Choose the main color for buttons, links, and accents\',
                \'required\' => 0,
                \'default_value\' => \'#0ea5e9\',
            ],
            [
                \'key\' => \'field_secondary_color\',
                \'label\' => \'Secondary Color\',
                \'name\' => \'secondary_color\',
                \'type\' => \'color_picker\',
                \'instructions\' => \'Choose the secondary color for the theme\',
                \'required\' => 0,
                \'default_value\' => \'#64748b\',
            ],
        ],
        \'location\' => [
            [
                [
                    \'param\' => \'post_type\',
                    \'operator\' => \'==\',
                    \'value\' => \'acf-theme-settings\',
                ],
            ],
        ],
    ]);
}
add_action(\'acf/init\', \'register_theme_settings_fields\');
</pre>';
            }
            ?>
        </form>
    </div>
    <?php
}

// Register our custom post type to store settings
function tailwindwp_register_settings_post_type() {
    register_post_type('acf-theme-settings', array(
        'labels' => array(
            'name' => 'Theme Settings',
        ),
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => false,
        'exclude_from_search' => true,
        'show_in_nav_menus' => false,
        'has_archive' => false,
        'hierarchical' => false,
        'supports' => array('title', 'custom-fields'),
    ));
}
add_action('init', 'tailwindwp_register_settings_post_type', 0);

// Register theme settings fields for ACF free
function register_theme_settings_fields() {
    if (!function_exists('acf_add_local_field_group'))
        return;
        
    acf_add_local_field_group([
        'key' => 'group_theme_settings',
        'title' => 'Theme Colors',
        'fields' => [
            [
                'key' => 'field_primary_color',
                'label' => 'Primary Color',
                'name' => 'primary_color',
                'type' => 'color_picker',
                'instructions' => 'Choose the main color for buttons, links, and accents',
                'required' => 0,
                'default_value' => '#0ea5e9',
            ],
            [
                'key' => 'field_secondary_color',
                'label' => 'Secondary Color',
                'name' => 'secondary_color',
                'type' => 'color_picker',
                'instructions' => 'Choose the secondary color for the theme',
                'required' => 0,
                'default_value' => '#64748b',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'acf-theme-settings',
                ],
            ],
        ],
    ]);
}
add_action('acf/init', 'register_theme_settings_fields');

// Function to get a theme setting (acts as a replacement for get_field('field_name', 'option'))
function tailwindwp_get_theme_setting($field_name, $default = '') {
    $settings_page_id = get_option('tailwindwp_settings_page_id');
    if (!$settings_page_id) {
        return $default;
    }
    
    $value = get_field($field_name, $settings_page_id);
    return $value ? $value : $default;
}

// Helper function to convert HEX to RGB
if (!function_exists('tailwindwp_hex_to_rgb')) {
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
}