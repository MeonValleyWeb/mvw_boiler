<?php
/**
 * Template part for displaying testimonials
 *
 * @package MeonValleyWeb
 */

// Get fields
$heading = get_sub_field('heading');
$testimonials = get_sub_field('items');
$style = get_sub_field('style') ?: 'grid';

// Only continue if we have testimonials
if (!$testimonials) {
    return;
}
?>

<section class="testimonials-section py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <?php if ($heading) : ?>
            <h2 class="text-3xl font-bold text-center mb-12"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        
        <?php if ($style === 'slider') : ?>
            <div class="testimonial-slider max-w-4xl mx-auto">
                <?php foreach ($testimonials as $testimonial) : ?>
                    <div class="testimonial-item bg-white rounded-lg shadow-md p-8 mb-8">
                        <div class="flex flex-col md:flex-row items-center">
                            <?php if (!empty($testimonial['image'])) : ?>
                                <div class="testimonial-image mb-4 md:mb-0 md:mr-6">
                                    <img src="<?php echo esc_url($testimonial['image']['url']); ?>" 
                                         alt="<?php echo esc_attr($testimonial['author']); ?>" 
                                         class="w-20 h-20 rounded-full object-cover">
                                </div>
                            <?php endif; ?>
                            
                            <div class="testimonial-content">
                                <?php if (!empty($testimonial['quote'])) : ?>
                                    <div class="quote text-gray-600 italic mb-4">
                                        "<?php echo esc_html($testimonial['quote']); ?>"
                                    </div>
                                <?php endif; ?>
                                
                                <div class="author-info">
                                    <?php if (!empty($testimonial['author'])) : ?>
                                        <div class="author-name font-bold">
                                            <?php echo esc_html($testimonial['author']); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($testimonial['position'])) : ?>
                                        <div class="author-position text-sm text-gray-500">
                                            <?php echo esc_html($testimonial['position']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <script>
                // Initialize testimonial slider when the DOM is ready
                document.addEventListener('DOMContentLoaded', function() {
                    if (typeof jQuery !== 'undefined' && jQuery.fn.slick) {
                        jQuery('.testimonial-slider').slick({
                            dots: true,
                            arrows: false,
                            autoplay: true,
                            autoplaySpeed: 5000,
                            fade: true,
                            speed: 500
                        });
                    }
                });
            </script>
            
        <?php elseif ($style === 'single') : ?>
            <?php
            // Just display the first testimonial
            $testimonial = $testimonials[0];
            ?>
            <div class="max-w-3xl mx-auto">
                <div class="testimonial-item bg-white rounded-lg shadow-md p-8 text-center">
                    <?php if (!empty($testimonial['quote'])) : ?>
                        <div class="quote text-gray-600 italic text-xl mb-6">
                            "<?php echo esc_html($testimonial['quote']); ?>"
                        </div>
                    <?php endif; ?>
                    
                    <div class="author-info flex flex-col items-center">
                        <?php if (!empty($testimonial['image'])) : ?>
                            <div class="testimonial-image mb-4">
                                <img src="<?php echo esc_url($testimonial['image']['url']); ?>" 
                                     alt="<?php echo esc_attr($testimonial['author']); ?>" 
                                     class="w-20 h-20 rounded-full object-cover">
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($testimonial['author'])) : ?>
                            <div class="author-name font-bold text-lg">
                                <?php echo esc_html($testimonial['author']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($testimonial['position'])) : ?>
                            <div class="author-position text-gray-500">
                                <?php echo esc_html($testimonial['position']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
        <?php else : // Grid layout (default) ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($testimonials as $testimonial) : ?>
                    <div class="testimonial-item bg-white rounded-lg shadow-md p-6">
                        <?php if (!empty($testimonial['quote'])) : ?>
                            <div class="quote text-gray-600 italic mb-4">
                                "<?php echo esc_html($testimonial['quote']); ?>"
                            </div>
                        <?php endif; ?>
                        
                        <div class="author-info flex items-center mt-4">
                            <?php if (!empty($testimonial['image'])) : ?>
                                <div class="testimonial-image mr-4">
                                    <img src="<?php echo esc_url($testimonial['image']['url']); ?>" 
                                         alt="<?php echo esc_attr($testimonial['author']); ?>" 
                                         class="w-12 h-12 rounded-full object-cover">
                                </div>
                            <?php endif; ?>
                            
                            <div>
                                <?php if (!empty($testimonial['author'])) : ?>
                                    <div class="author-name font-bold">
                                        <?php echo esc_html($testimonial['author']); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($testimonial['position'])) : ?>
                                    <div class="author-position text-sm text-gray-500">
                                        <?php echo esc_html($testimonial['position']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>