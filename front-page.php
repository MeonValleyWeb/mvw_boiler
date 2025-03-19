<?php
/**
 * The modular front page template
 *
 * @package MeonValleyWeb
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <?php
    /**
     * Hero Section
     * Flexible hero that can be configured for any business type
     */
    if (function_exists('get_field') && get_field('enable_hero')) {
        get_template_part('template-parts/blocks/hero');
    }
    
    /**
     * Flexible Content Blocks
     * This allows you to build pages with modular blocks in any order
     */
    if (function_exists('have_rows') && have_rows('content_blocks')) {
        while (have_rows('content_blocks')) { 
            the_row();
            
            // Text Block
            if (get_row_layout() == 'text_block') {
                get_template_part('template-parts/blocks/text-block');
            }
            
            // Feature Grid
            elseif (get_row_layout() == 'feature_grid') {
                get_template_part('template-parts/blocks/feature-grid');
            }
            
            // Image and Text
            elseif (get_row_layout() == 'image_text') {
                get_template_part('template-parts/blocks/image-text');
            }
            
            // Testimonials
            elseif (get_row_layout() == 'testimonials') {
                get_template_part('template-parts/blocks/testimonials');
            }
            
            // Call to Action
            elseif (get_row_layout() == 'cta') {
                get_template_part('template-parts/blocks/cta');
            }
            
            // Gallery
            elseif (get_row_layout() == 'gallery') {
                get_template_part('template-parts/blocks/gallery');
            }
        }
    }
    
    // If there's standard page content, display it
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            
            // Only display content if it's not empty
            if (trim(get_the_content())) {
                ?>
                <section class="content-section py-16">
                    <div class="container mx-auto px-4">
                        <div class="prose prose-lg max-w-4xl mx-auto">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </section>
                <?php
            }
        }
    }
    
    /**
     * Recent Posts Section
     * Optional recent posts section that can be toggled on/off
     */
    if (function_exists('get_field') && get_field('show_recent_posts')) {
        get_template_part('template-parts/blocks/recent-posts');
    }
    ?>
    
</main>

<?php
get_footer();