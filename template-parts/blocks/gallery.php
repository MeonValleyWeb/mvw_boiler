<?php
/**
 * Template part for displaying gallery section
 *
 * @package MeonValleyWeb
 */

// Get fields
$heading = get_sub_field('heading');
$images = get_sub_field('images');
$columns = get_sub_field('columns') ?: '3';

// If no images, exit
if (empty($images)) {
    return;
}

// Determine column classes based on selection
$column_class = 'md:grid-cols-3'; // Default
if ($columns === '2') {
    $column_class = 'md:grid-cols-2';
} elseif ($columns === '4') {
    $column_class = 'md:grid-cols-2 lg:grid-cols-4';
}
?>

<section class="gallery-section py-16">
    <div class="container mx-auto px-4">
        <?php if ($heading) : ?>
            <h2 class="text-3xl font-bold text-center mb-12"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        
        <div class="grid <?php echo esc_attr($column_class); ?> gap-4">
            <?php foreach ($images as $image) : ?>
                <div class="gallery-item overflow-hidden rounded-lg shadow-md transition-all hover:shadow-lg">
                    <a href="<?php echo esc_url($image['url']); ?>" class="block" data-lightbox="gallery">
                        <img src="<?php echo esc_url($image['sizes']['medium_large']); ?>" 
                             alt="<?php echo esc_attr($image['alt']); ?>" 
                             class="w-full h-64 object-cover transition-transform duration-500 hover:scale-105">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>