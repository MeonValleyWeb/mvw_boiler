<?php
/**
 * The template for displaying the front page
 *
 * @package TailwindWP
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <?php
    // Display hero section
    if (function_exists('get_field') && get_field('enable_hero')) :
        // Get the hero section data
        $hero_args = [
            'pre_title' => get_field('hero_pre_title'),
            'title' => get_field('hero_title'),
            'description' => get_field('hero_description'),
            'background_image' => get_field('hero_background'),
            'primary_button' => [
                'text' => get_field('hero_primary_button')['text'],
                'url' => get_field('hero_primary_button')['url'],
            ],
        ];
        
        // Add secondary button if it exists
        if (!empty(get_field('hero_secondary_button')['text']) && !empty(get_field('hero_secondary_button')['url'])) {
            $hero_args['secondary_button'] = [
                'text' => get_field('hero_secondary_button')['text'],
                'url' => get_field('hero_secondary_button')['url'],
            ];
        }
        
        // Include the hero template
        get_template_part('template-parts/components/hero', null, $hero_args);
    endif;
    ?>
    
    <?php
    // Display featured boxes if enabled
    if (function_exists('get_field') && get_field('enable_feature_boxes')) :
    ?>
        <section class="feature-boxes py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <?php if (get_field('feature_section_title')) : ?>
                    <h2 class="text-3xl font-bold text-center mb-12"><?php echo esc_html(get_field('feature_section_title')); ?></h2>
                <?php endif; ?>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    if (have_rows('feature_boxes')) :
                        while (have_rows('feature_boxes')) : the_row();
                            $icon = get_sub_field('icon');
                            $title = get_sub_field('title');
                            $text = get_sub_field('text');
                            $link = get_sub_field('link');
                    ?>
                        <div class="feature-box bg-white rounded-lg shadow-md p-6 transition-all hover:shadow-lg">
                            <?php if ($icon) : ?>
                                <div class="icon-wrapper mb-4 flex justify-center">
                                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="w-16 h-16 object-contain">
                                </div>
                            <?php endif; ?>
                            
                            <h3 class="text-xl font-bold mb-3 text-center"><?php echo esc_html($title); ?></h3>
                            
                            <?php if ($text) : ?>
                                <div class="text-gray-600 mb-4 text-center"><?php echo wp_kses_post($text); ?></div>
                            <?php endif; ?>
                            
                            <?php if ($link) : ?>
                                <div class="text-center">
                                    <a href="<?php echo esc_url($link['url']); ?>" class="inline-block text-primary-600 hover:text-primary-700 font-medium">
                                        <?php echo esc_html($link['title']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    
    <?php
    // Main content
    while (have_posts()) :
        the_post();
        
        if (get_the_content()) :
    ?>
        <section class="content-section py-16">
            <div class="container mx-auto px-4">
                <div class="prose prose-lg max-w-4xl mx-auto">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>
    <?php
        endif;
    endwhile;
    ?>
    
    <?php
    // Display testimonials if enabled
    if (function_exists('get_field') && get_field('enable_testimonials', 'option')) :
    ?>
        <section class="testimonials-section py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12"><?php echo esc_html(get_field('testimonials_title', 'option')); ?></h2>
                
                <div class="testimonials-slider max-w-4xl mx-auto">
                    <?php
                    if (have_rows('testimonials', 'option')) :
                        while (have_rows('testimonials', 'option')) : the_row();
                            $quote = get_sub_field('quote');
                            $author = get_sub_field('author');
                            $position = get_sub_field('position');
                            $image = get_sub_field('image');
                    ?>
                        <div class="testimonial-item bg-white rounded-lg shadow-md p-8 mb-8">
                            <div class="flex flex-col md:flex-row items-center">
                                <?php if ($image) : ?>
                                    <div class="testimonial-image mb-4 md:mb-0 md:mr-6">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($author); ?>" class="w-20 h-20 rounded-full object-cover">
                                    </div>
                                <?php endif; ?>
                                
                                <div class="testimonial-content">
                                    <div class="quote text-gray-600 italic mb-4"><?php echo wp_kses_post($quote); ?></div>
                                    
                                    <div class="author-info">
                                        <div class="author-name font-bold"><?php echo esc_html($author); ?></div>
                                        <?php if ($position) : ?>
                                            <div class="author-position text-sm text-gray-500"><?php echo esc_html($position); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    
    <?php
    // Display recent posts if enabled
    if (function_exists('get_field') && get_field('enable_recent_posts', 'option')) :
        $posts_count = get_field('recent_posts_count', 'option') ?: 3;
        $recent_posts = get_posts([
            'posts_per_page' => $posts_count,
            'post_status' => 'publish',
        ]);
        
        if ($recent_posts) :
    ?>
        <section class="recent-posts-section py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12"><?php echo esc_html(get_field('recent_posts_title', 'option')); ?></h2>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($recent_posts as $post) : setup_postdata($post); ?>
                        <article class="post-item bg-white rounded-lg shadow-md overflow-hidden transition-all hover:shadow-lg">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content p-6">
                                <h3 class="text-xl font-bold mb-2">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-primary-600"><?php the_title(); ?></a>
                                </h3>
                                
                                <div class="post-meta text-sm text-gray-500 mb-3">
                                    <?php echo get_the_date(); ?>
                                </div>
                                
                                <div class="post-excerpt text-gray-600 mb-4">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="inline-block text-primary-600 hover:text-primary-700 font-medium">
                                    <?php esc_html_e('Read More', 'tailwindwp'); ?>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
                
                <?php if (get_field('recent_posts_button', 'option')) : ?>
                    <div class="text-center mt-10">
                        <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="inline-block py-3 px-6 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors">
                            <?php echo esc_html(get_field('recent_posts_button', 'option')); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php
        endif;
    endif;
    ?>
    
    <?php
    // Display CTA if enabled
    if (function_exists('get_field') && get_field('enable_cta', 'option')) :
        $cta_heading = get_field('cta_heading', 'option');
        $cta_text = get_field('cta_text', 'option');
        $cta_button_text = get_field('cta_button_text', 'option');
        $cta_button_url = get_field('cta_button_url', 'option');
        $cta_background = get_field('cta_background', 'option');
    ?>
        <section class="cta-section py-16 <?php echo $cta_background ? 'bg-cover bg-center relative' : 'bg-primary-700 text-white'; ?>"
                <?php if ($cta_background) : ?>
                    style="background-image: url('<?php echo esc_url($cta_background); ?>');"
                <?php endif; ?>>
            
            <?php if ($cta_background) : ?>
                <div class="absolute inset-0 bg-primary-900 bg-opacity-75"></div>
            <?php endif; ?>
            
            <div class="container mx-auto px-4 relative <?php echo $cta_background ? 'text-white' : ''; ?>">
                <div class="max-w-3xl mx-auto text-center">
                    <?php if ($cta_heading) : ?>
                        <h2 class="text-3xl font-bold mb-4"><?php echo esc_html($cta_heading); ?></h2>
                    <?php endif; ?>
                    
                    <?php if ($cta_text) : ?>
                        <div class="mb-8 text-lg"><?php echo wp_kses_post($cta_text); ?></div>
                    <?php endif; ?>
                    
                    <?php if ($cta_button_text && $cta_button_url) : ?>
                        <a href="<?php echo esc_url($cta_button_url); ?>" class="inline-block py-3 px-8 bg-white text-primary-700 font-bold rounded-md shadow-lg hover:bg-gray-100 transition-colors">
                            <?php echo esc_html($cta_button_text); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    
</main>

<?php
get_footer();