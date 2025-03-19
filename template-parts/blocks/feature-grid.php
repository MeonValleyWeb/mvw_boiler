<?php
/**
 * Template part for displaying feature grid
 *
 * @package MeonValleyWeb
 */

// Get fields
$heading = get_sub_field('heading');
$description = get_sub_field('description');
$features = get_sub_field('features');
$columns = get_sub_field('columns') ?: '3';

// Determine column classes based on selection
$column_class = 'md:grid-cols-3'; // Default
if ($columns === '2') {
    $column_class = 'md:grid-cols-2';
} elseif ($columns === '4') {
    $column_class = 'md:grid-cols-2 lg:grid-cols-4';
}
?>

<section class="feature-grid py-16">
    <div class="container mx-auto px-4">
        <?php if ($heading) : ?>
            <h2 class="text-3xl font-bold text-center mb-4"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        
        <?php if ($description) : ?>
            <div class="max-w-3xl mx-auto text-center text-gray-600 mb-12">
                <?php echo wp_kses_post($description); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($features) : ?>
            <div class="grid <?php echo esc_attr($column_class); ?> gap-8">
                <?php foreach ($features as $feature) : ?>
                    <div class="feature-item bg-white p-6 rounded-lg shadow-md transition-shadow hover:shadow-lg">
                        <?php if (!empty($feature['icon'])) : ?>
                            <div class="icon-wrapper mb-4 flex justify-center">
                                <img src="<?php echo esc_url($feature['icon']['url']); ?>" 
                                     alt="<?php echo esc_attr($feature['title']); ?>" 
                                     class="w-16 h-16 object-contain">
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($feature['title'])) : ?>
                            <h3 class="text-xl font-bold mb-2 text-center"><?php echo esc_html($feature['title']); ?></h3>
                        <?php endif; ?>
                        
                        <?php if (!empty($feature['text'])) : ?>
                            <div class="text-gray-600 mb-4">
                                <?php echo wp_kses_post($feature['text']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($feature['link'])) : ?>
                            <div class="text-center mt-auto">
                                <a href="<?php echo esc_url($feature['link']['url']); ?>" 
                                   class="inline-block text-primary-600 hover:text-primary-700 font-medium"
                                   <?php echo !empty($feature['link']['target']) ? 'target="' . esc_attr($feature['link']['target']) . '"' : ''; ?>>
                                    <?php echo esc_html($feature['link']['title']); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>