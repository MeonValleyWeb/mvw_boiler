<?php
/**
 * The footer for our theme
 */
?>
    </div><!-- #content -->

    <footer id="colophon" class="site-footer bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="footer-info">
                    <h3 class="text-lg font-bold mb-4"><?php bloginfo('name'); ?></h3>
                    <?php if (function_exists('get_field') && get_field('footer_text', 'option')) : ?>
                        <div class="footer-text">
                            <?php echo get_field('footer_text', 'option'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="footer-menu">
                    <h3 class="text-lg font-bold mb-4"><?php esc_html_e('Quick Links', 'tailwindwp'); ?></h3>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer',
                        'menu_id' => 'footer-menu',
                        'container' => false,
                        'menu_class' => 'footer-links',
                        'fallback_cb' => false,
                    ]);
                    ?>
                </div>

                <div class="footer-contact">
                    <h3 class="text-lg font-bold mb-4"><?php esc_html_e('Contact Us', 'tailwindwp'); ?></h3>
                    <?php if (function_exists('get_field')) : ?>
                        <?php if (get_field('phone', 'option')) : ?>
                            <p class="mb-2">
                                <strong><?php esc_html_e('Phone:', 'tailwindwp'); ?></strong> 
                                <?php echo get_field('phone', 'option'); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if (get_field('email', 'option')) : ?>
                            <p class="mb-2">
                                <strong><?php esc_html_e('Email:', 'tailwindwp'); ?></strong> 
                                <a href="mailto:<?php echo get_field('email', 'option'); ?>" class="text-white underline">
                                    <?php echo get_field('email', 'option'); ?>
                                </a>
                            </p>
                        <?php endif; ?>
                        
                        <?php if (get_field('address', 'option')) : ?>
                            <p class="mb-2">
                                <strong><?php esc_html_e('Address:', 'tailwindwp'); ?></strong><br>
                                <?php echo get_field('address', 'option'); ?>
                            </p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-6 pt-6 text-center">
                <p>
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 
                    <?php esc_html_e('All rights reserved.', 'tailwindwp'); ?>
                </p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>