<?php
/**
 * Template part for displaying hero sections
 *
 * Create a new file at template-parts/components/hero.php and add this code
 */
?>

<section class="hero-section relative <?php echo isset($args['class']) ? esc_attr($args['class']) : ''; ?>">
    <?php if (isset($args['background_image']) && !empty($args['background_image'])) : ?>
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url($args['background_image']); ?>');">
            <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>
        </div>
    <?php else : ?>
        <div class="absolute inset-0 bg-gradient-to-r from-primary-700 to-primary-900"></div>
    <?php endif; ?>
    
    <div class="container mx-auto px-4 py-20 md:py-32 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <?php if (isset($args['pre_title']) && !empty($args['pre_title'])) : ?>
                <div class="pre-title text-white text-lg mb-2"><?php echo esc_html($args['pre_title']); ?></div>
            <?php endif; ?>
            
            <?php if (isset($args['title']) && !empty($args['title'])) : ?>
                <h1 class="text-3xl md:text-5xl font-bold text-white mb-6"><?php echo wp_kses_post($args['title']); ?></h1>
            <?php endif; ?>
            
            <?php if (isset($args['description']) && !empty($args['description'])) : ?>
                <div class="description text-white text-lg mb-8"><?php echo wp_kses_post($args['description']); ?></div>
            <?php endif; ?>
            
            <?php if (isset($args['primary_button']) && !empty($args['primary_button'])) : ?>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="<?php echo esc_url($args['primary_button']['url']); ?>" class="py-3 px-6 bg-white text-primary-700 font-medium rounded-md shadow-lg hover:bg-gray-100 transition-colors">
                        <?php echo esc_html($args['primary_button']['text']); ?>
                    </a>
                    
                    <?php if (isset($args['secondary_button']) && !empty($args['secondary_button'])) : ?>
                        <a href="<?php echo esc_url($args['secondary_button']['url']); ?>" class="py-3 px-6 bg-transparent text-white border-2 border-white font-medium rounded-md hover:bg-white hover:bg-opacity-10 transition-colors">
                            <?php echo esc_html($args['secondary_button']['text']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>