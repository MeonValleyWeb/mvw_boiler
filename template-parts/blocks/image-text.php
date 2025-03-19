<?php
/**
 * Template part for displaying image and text section
 *
 * @package MeonValleyWeb
 */

// Get fields
$heading = get_sub_field('heading');
$content = get_sub_field('content');
$image = get_sub_field('image');
$layout = get_sub_field('layout') ?: 'image_left';
$button = get_sub_field('button');

// Set order class based on layout selection
$image_order_class = ($layout === 'image_left') ? 'order-1' : 'order-1 md:order-2';
$content_order_class = ($layout === 'image_left') ? 'order-2' : 'order-2 md:order-1';
?>

<section class="image-text-section py-16">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-8 items-center">
            <?php if ($image && !empty($image['url'])) : ?>
                <div class="image-wrapper <?php echo esc_attr($image_order_class); ?>">
                    <img src="<?php echo esc_url($image['url']); ?>" 
                         alt="<?php echo esc_attr($image['alt'] ?: $heading); ?>" 
                         class="rounded-lg shadow-md w-full h-auto">
                </div>
            <?php endif; ?>
            
            <div class="content-wrapper <?php echo esc_attr($content_order_class); ?>">
                <?php if ($heading) : ?>
                    <h2 class="text-2xl md:text-3xl font-bold mb-4"><?php echo esc_html($heading); ?></h2>
                <?php endif; ?>
                
                <?php if ($content) : ?>
                    <div class="prose prose-lg max-w-none mb-6">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($button && !empty($button['text']) && !empty($button['url'])) : ?>
                    <a href="<?php echo esc_url($button['url']); ?>" 
                       class="inline-block px-6 py-3 bg-primary-600 text-white rounded-md font-medium hover:bg-primary-700 transition duration-300">
                        <?php echo esc_html($button['text']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>