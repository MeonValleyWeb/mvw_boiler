<?php
/**
 * Template part for displaying text block
 *
 * @package MeonValleyWeb
 */

// Get fields
$heading = get_sub_field('heading');
$content = get_sub_field('content');
$width = get_sub_field('width') ?: 'medium';

// Determine width class based on selection
$width_class = 'max-w-3xl'; // Default medium
if ($width === 'narrow') {
    $width_class = 'max-w-xl';
} elseif ($width === 'wide') {
    $width_class = 'max-w-5xl';
} elseif ($width === 'full') {
    $width_class = 'max-w-none';
}
?>

<section class="text-block py-16">
    <div class="container mx-auto px-4">
        <div class="<?php echo esc_attr($width_class); ?> mx-auto">
            <?php if ($heading) : ?>
                <h2 class="text-3xl font-bold mb-6"><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>
            
            <?php if ($content) : ?>
                <div class="prose prose-lg max-w-none">
                    <?php echo $content; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>