<?php
get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-8">
    <div class="grid md:grid-cols-3 gap-8">
        <div class="md:col-span-2">
            <?php
            while (have_posts()) :
                the_post();
                
                get_template_part('template-parts/content', 'single');

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

                // Post navigation
                the_post_navigation([
                    'prev_text' => '<div class="meta-nav text-sm text-gray-500">' . esc_html__('Previous', 'mvw') . '</div><div class="post-title font-medium">%title</div>',
                    'next_text' => '<div class="meta-nav text-sm text-gray-500">' . esc_html__('Next', 'mvw') . '</div><div class="post-title font-medium">%title</div>',
                    'class' => 'border-t border-b border-gray-200 py-4 my-8 grid md:grid-cols-2 gap-4',
                ]);
            endwhile; // End of the loop.
            ?>
        </div>

        <div class="md:col-span-1">
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php
get_footer();