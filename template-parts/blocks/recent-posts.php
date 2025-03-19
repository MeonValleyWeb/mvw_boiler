<?php
/**
 * Template part for displaying recent posts
 *
 * @package MeonValleyWeb
 */

// Get field data
$heading = get_field('recent_posts_heading') ?: 'Latest News';
$post_count = get_field('recent_posts_count') ?: 3;
$show_button = get_field('recent_posts_show_button');
$button_text = get_field('recent_posts_button_text') ?: 'View All Posts';
$display_style = get_field('recent_posts_style') ?: 'grid';

// Get posts
$args = [
    'post_type' => 'post',
    'posts_per_page' => $post_count,
    'post_status' => 'publish',
    'ignore_sticky_posts' => 1,
];

$recent_posts = new WP_Query($args);

// Only display section if we have posts
if (!$recent_posts->have_posts()) {
    return;
}
?>

<section class="recent-posts-section py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12"><?php echo esc_html($heading); ?></h2>
        
        <?php if ($display_style === 'list') : ?>
            <div class="max-w-3xl mx-auto">
                <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                    <article class="post-item mb-8 bg-white rounded-lg shadow-md overflow-hidden transition-all hover:shadow-lg">
                        <a href="<?php the_permalink(); ?>" class="flex flex-col md:flex-row">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail md:w-1/3">
                                    <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover']); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content p-6 md:w-2/3">
                                <h3 class="text-xl font-bold mb-2 hover:text-primary-600"><?php the_title(); ?></h3>
                                
                                <div class="post-meta text-sm text-gray-500 mb-3">
                                    <?php echo get_the_date(); ?>
                                </div>
                                
                                <div class="post-excerpt text-gray-600">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            
        <?php else : // Grid layout (default) ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                    <article class="post-item bg-white rounded-lg shadow-md overflow-hidden transition-all hover:shadow-lg">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="block">
                                <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-48 object-cover']); ?>
                            </a>
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
                                <?php esc_html_e('Read More', 'mvw'); ?>
                            </a>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($show_button) : ?>
            <div class="text-center mt-10">
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="inline-block py-3 px-6 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors">
                    <?php echo esc_html($button_text); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>