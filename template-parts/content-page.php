<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-sm overflow-hidden'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('full', ['class' => 'w-full h-auto']); ?>
        </div>
    <?php endif; ?>

    <div class="entry-content p-6">
        <?php
        the_content();

        wp_link_pages([
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'tailwindwp'),
            'after'  => '</div>',
        ]);
        ?>

        <?php
        // Example ACF fields for a basic page
        if (function_exists('get_field')) :
            // Featured section
            if (get_field('enable_featured_section')) :
                $featured_heading = get_field('featured_heading');
                $featured_text = get_field('featured_text');
                $featured_image = get_field('featured_image');
                $featured_button_text = get_field('featured_button_text');
                $featured_button_url = get_field('featured_button_url');
        ?>
                <div class="featured-section my-8 p-6 bg-gray-100 rounded-lg">
                    <div class="grid md:grid-cols-2 gap-6 items-center">
                        <?php if ($featured_image) : ?>
                            <div class="featured-image">
                                <img src="<?php echo esc_url($featured_image['url']); ?>" alt="<?php echo esc_attr($featured_image['alt']); ?>" class="rounded-lg">
                            </div>
                        <?php endif; ?>

                        <div class="featured-content">
                            <?php if ($featured_heading) : ?>
                                <h2 class="text-2xl font-bold mb-4"><?php echo esc_html($featured_heading); ?></h2>
                            <?php endif; ?>

                            <?php if ($featured_text) : ?>
                                <div class="mb-4"><?php echo wp_kses_post($featured_text); ?></div>
                            <?php endif; ?>

                            <?php if ($featured_button_text && $featured_button_url) : ?>
                                <a href="<?php echo esc_url($featured_button_url); ?>" class="inline-block px-6 py-3 bg-primary-600 text-white font-medium rounded-md shadow-sm hover:bg-primary-700 transition-colors">
                                    <?php echo esc_html($featured_button_text); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            // Service boxes
            if (get_field('enable_service_boxes') && have_rows('service_boxes')) :
            ?>
                <div class="service-boxes my-8">
                    <h2 class="text-2xl font-bold mb-6 text-center"><?php echo esc_html(get_field('service_section_title')); ?></h2>
                    
                    <div class="grid md:grid-cols-3 gap-6">
                        <?php
                        while (have_rows('service_boxes')) : the_row();
                            $icon = get_sub_field('icon');
                            $title = get_sub_field('title');
                            $description = get_sub_field('description');
                            $link = get_sub_field('link');
                        ?>
                            <div class="service-box p-6 bg-white border border-gray-200 rounded-lg shadow-sm text-center">
                                <?php if ($icon) : ?>
                                    <div class="icon-wrapper flex justify-center mb-4">
                                        <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" class="w-16 h-16">
                                    </div>
                                <?php endif; ?>

                                <?php if ($title) : ?>
                                    <h3 class="text-xl font-semibold mb-2"><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>

                                <?php if ($description) : ?>
                                    <p class="text-gray-600 mb-4"><?php echo wp_kses_post($description); ?></p>
                                <?php endif; ?>

                                <?php if ($link) : ?>
                                    <a href="<?php echo esc_url($link['url']); ?>" class="inline-block text-primary-600 hover:text-primary-800 font-medium">
                                        <?php echo esc_html($link['title']); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</article>