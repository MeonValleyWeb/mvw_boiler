<?php
/**
 * Template part for displaying call to action section
 *
 * @package MeonValleyWeb
 */

// Get fields
$heading = get_sub_field('heading');
$text = get_sub_field('text');
$button = get_sub_field('button');
$background = get_sub_field('background');
$style = get_sub_field('style') ?: 'standard';

// Set classes based on style
$section_classes = 'cta-section py-12';
$container_classes = 'container mx-auto px-4';
$content_classes = 'text-center';

if ($style === 'full_width') {
    $section_classes .= ' px-0';
    $container_classes .= ' max-w-full';
} elseif ($style === 'boxed') {
    $section_classes .= ' bg-white';
    $container_classes .= ' max-w-4xl bg-gradient-to-r from-primary-600 to-primary-800 rounded-lg shadow-xl py-8 px-8';
    $content_classes .= ' text-white';
} else {
    // Standard style
    $section_classes .= ' bg-primary-600 text-white';
}

// Background image setup
$bg_style = '';
if ($background && !empty($background['url'])) {
    $bg_style = 'background-image: url(' . esc_url($background['url']) . ');';
    $section_classes .= ' bg-cover bg-center relative';
    
    // Add overlay for better text readability unless using boxed style
    if ($style !== 'boxed') {
        $overlay = '<div class="absolute inset-0 bg-primary-900 bg-opacity-75"></div>';
    }
}
?>

<section class="<?php echo esc_attr($section_classes); ?>" <?php if ($bg_style) echo 'style="' . esc_attr($bg_style) . '"'; ?>>
    <?php if (isset($overlay)) echo $overlay; ?>
    
    <div class="<?php echo esc_attr($container_classes); ?> relative z-10">
        <div class="<?php echo esc_attr($content_classes); ?>">
            <?php if ($heading) : ?>
                <h2 class="text-2xl md:text-3xl font-bold mb-4"><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>
            
            <?php if ($text) : ?>
                <div class="mb-6 text-lg max-w-2xl mx-auto">
                    <?php echo wp_kses_post($text); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($button && !empty($button['text']) && !empty($button['url'])) : ?>
                <a href="<?php echo esc_url($button['url']); ?>" 
                   class="inline-block px-6 py-3 bg-white text-primary-700 font-bold rounded-md shadow-lg hover:bg-gray-100 transition-colors">
                    <?php echo esc_html($button['text']); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>