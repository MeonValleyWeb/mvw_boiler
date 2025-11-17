<?php
/**
 * Shared helper functions for the MVW theme.
 * Centralises helpers to avoid duplicate function declarations.
 *
 * @package MeonValleyWeb
 */

if (!function_exists('mvw_hex_to_rgb')) {
    /**
     * Convert HEX color to "R, G, B" string.
     * Returns an empty string for invalid input.
     *
     * @param string $hex Hex color code
     * @return string
     */
    function mvw_hex_to_rgb($hex) {
        $hex = str_replace('#', '', (string) $hex);

        if ($hex === '') {
            return '';
        }

        if (strlen($hex) === 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } elseif (strlen($hex) === 6) {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        } else {
            return '';
        }

        return "{$r}, {$g}, {$b}";
    }
}

if (!function_exists('mvw_get_option')) {
    /**
     * Get an ACF option value with a default. Handles grouped fields.
     *
     * Usage:
     * - For grouped fields (e.g. 'theme_colors' with 'primary_color'):
     *     mvw_get_option('theme_colors', 'primary_color', '#0ea5e9')
     * - For flat fields:
     *     mvw_get_option('footer_text', null, '')
     *
     * @param string $field_or_group The field name or group name
     * @param string|null $sub_key Optional sub-key when reading grouped fields
     * @param mixed $default Default value
     * @return mixed
     */
    function mvw_get_option($field_or_group, $sub_key = null, $default = '') {
        if (!function_exists('get_field')) {
            return $default;
        }

        // If sub_key provided, treat first arg as group
        if ($sub_key !== null) {
            $group = get_field($field_or_group, 'option');
            if (is_array($group) && isset($group[$sub_key]) && $group[$sub_key] !== null && $group[$sub_key] !== '') {
                return $group[$sub_key];
            }
            return $default;
        }

        $value = get_field($field_or_group, 'option');
        return $value !== null && $value !== '' ? $value : $default;
    }
}
