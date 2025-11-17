<?php
/**
 * Main template file: index.php
 */

get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-8">
    <div class="grid md:grid-cols-3 gap-8">
        <div class="md:col-span-2">
            <?php
            if (have_posts()) :
                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', get_post_type());
                endwhile;

                the_posts_pagination([
                    'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4-25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" /></svg>' . esc_html__('Previous', 'mvw'),
                    'next_text' => esc_html__('Next', 'mvw') . '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" /></svg>',
                    'class' => 'flex justify-center space-x-2 my-8',
                ]);
            else :
                get_template_part('template-parts/content', 'none');
            endif;
            ?>
        </div>

        <div class="md:col-span-1">
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php
get_footer();