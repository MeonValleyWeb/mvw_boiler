<?php
/**
 * Custom shortcodes
 */

/**
 * Creates a styled contact form shortcode
 * Usage: [mvw_contact_form form_id="123" title="Contact Us"]
 */
function mvw_contact_form_shortcode($atts) {
    $atts = shortcode_atts([
        'form_id' => '',
        'title' => esc_html__('Contact Us', 'mvw'),
        'description' => esc_html__('Fill out the form below and we\'ll get back to you as soon as possible.', 'mvw'),
    ], $atts);

    ob_start();
    ?>
    <div class="contact-form-wrapper my-8 p-6 bg-gray-50 rounded-lg max-w-2xl mx-auto">
        <?php if ($atts['title']) : ?>
            <h2 class="text-2xl font-bold mb-2"><?php echo esc_html($atts['title']); ?></h2>
        <?php endif; ?>
        
        <?php if ($atts['description']) : ?>
            <p class="text-gray-600 mb-6"><?php echo esc_html($atts['description']); ?></p>
        <?php endif; ?>
        
        <?php 
        if (!empty($atts['form_id']) && function_exists('wpcf7_contact_form')) {
            // Allow passing the CF7 form ID via the shortcode attribute
            echo do_shortcode('[contact-form-7 id="' . esc_attr($atts['form_id']) . '" title="Contact Form"]');
        } elseif (function_exists('wpcf7_contact_form')) {
            // CF7 is present but no form_id provided
            echo '<p class="text-yellow-600">' . esc_html__('Please provide a Contact Form 7 form ID to this shortcode.', 'mvw') . '</p>';
        } else {
            echo '<p class="text-red-600">' . esc_html__('Please install and activate Contact Form 7 plugin.', 'mvw') . '</p>';
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('mvw_contact_form', 'mvw_contact_form_shortcode');

/**
 * Amazon SES Integration
 */
function mvw_ses_smtp($phpmailer) {
    // Only configure if constants are defined (typically in wp-config.php)
    if (defined('SES_SMTP_HOST') && defined('SES_SMTP_USERNAME') && defined('SES_SMTP_PASSWORD')) {
        $phpmailer->isSMTP();
        $phpmailer->Host = SES_SMTP_HOST;
        $phpmailer->SMTPAuth = true;
        $phpmailer->Username = SES_SMTP_USERNAME;
        $phpmailer->Password = SES_SMTP_PASSWORD;
        $phpmailer->SMTPSecure = 'tls';
        $phpmailer->Port = 587;
        
        // Optional: Set the from email if defined
        if (defined('SES_FROM_EMAIL') && defined('SES_FROM_NAME')) {
            $phpmailer->setFrom(SES_FROM_EMAIL, SES_FROM_NAME);
        }
    }
}
add_action('phpmailer_init', 'mvw_ses_smtp');