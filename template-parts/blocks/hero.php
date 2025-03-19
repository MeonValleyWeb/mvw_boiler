<?php
/**
 * Template part for displaying hero section
 *
 * @package MeonValleyWeb
 */

// Get hero data
$title = get_field('hero_title');
$text = get_field('hero_text');
$style = get_field('hero_style') ?: 'standard';
$image = get_field('hero_image');
$button = get_field('hero_button');

// Set default classes based on style
$section_classes = 'hero-section relative';
$content_classes = 'container mx-auto px-4 relative z-10';

// Style-specific settings
if ($style === 'fullscreen') {
    $section_classes .= ' min-h-screen flex items-center';
} elseif ($style === 'split') {
    $section_classes .= ' py-16 md:py-20';
    $content_classes .= ' grid md:grid-cols-2 gap-8 items-center';
} else { // standard
    $section_classes .= ' py-20 md:py-32';
    $content_classes .= ' text-center max-w-4xl mx-auto';
}

// Background settings
$bg_style = '';
if ($image && !empty($image['url'])) {
    $bg_style = 'background-image: url(' . esc_url($image['url']) . ');';
    $section_classes .= ' bg-cover bg-center';
    
    // Add overlay for better text readability
    $overlay = '<div class="absolute inset-0 bg-black bg-opacity-50"></div>';
} else {
    $section_classes .= ' bg-gradient-to-r from-primary-700 to-primary-900';
    $overlay = '';
}
?>

<section class="<?php echo esc_attr($section_classes); ?>" <?php if ($bg_style) echo 'style="' . esc_attr($bg_style) . '"'; ?>>
    <?php if (isset($overlay)) echo $overlay; ?>
    
    <div class="<?php echo esc_attr($content_classes); ?>">
        <?php if ($style === 'split' && $image) : ?>
            <div class="hero-image">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: $title); ?>" class="rounded-lg shadow-xl">
            </div>
            <div class="hero-content">
                <?php if ($title) : ?>
                    <h1 class="text-3xl md:text-5xl font-bold text-white mb-4"><?php echo esc_html($title); ?></h1>
                <?php endif; ?>
                
                <?php if ($text) : ?>
                    <div class="text-white text-lg mb-6"><?php echo wp_kses_post($text); ?></div>
                <?php endif; ?>
                
                <?php if ($button && !empty($button['text']) && !empty($button['url'])) : ?>
                    <a href="<?php echo esc_url($button['url']); ?>" class="inline-block px-6 py-3 bg-white text-primary-600 rounded-md font-medium hover:bg-gray-100 transition duration-300">
                        <?php echo esc_html($button['text']); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <?php if ($title) : ?>
                <h1 class="text-3xl md:text-5xl font-bold text-white mb-4"><?php echo esc_html($title); ?></h1>
            <?php endif; ?>
            
            <?php if ($text) : ?>
                <div class="text-white text-lg mb-6"><?php echo wp_kses_post($text); ?></div>
            <?php endif; ?>
            
            <?php if ($button && !empty($button['text']) && !empty($button['url'])) : ?>
                <a href="<?php echo esc_url($button['url']); ?>" class="inline-block px-6 py-3 bg-white text-primary-600 rounded-md font-medium hover:bg-gray-100 transition duration-300">
                    <?php echo esc_html($button['text']); ?>
                </a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>