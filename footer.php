<?php
/**
 * The footer template
 *
 * @package MeonValleyWeb
 */

// Get theme options
$footer_text = mvw_get_option('footer_text');
$company_name = mvw_get_option('company_info_name', get_bloginfo('name'));
$address = mvw_get_option('company_info_address');
$phone = mvw_get_option('company_info_phone');
$email = mvw_get_option('company_info_email');
$footer_style = mvw_get_option('footer_style', 'standard');
?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer bg-gray-800 text-white <?php echo $footer_style === 'minimal' ? 'py-4' : 'py-12'; ?>">
        <div class="container mx-auto px-4">
            <?php if ($footer_style !== 'minimal') : ?>
                <div class="grid md:grid-cols-3 gap-8 mb-8">
                    <div class="footer-info">
                        <?php if (has_custom_logo()) : ?>
                            <div class="footer-logo mb-4">
                                <?php 
                                $custom_logo_id = get_theme_mod('custom_logo');
                                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                                if ($logo) :
                                ?>
                                    <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr($company_name); ?>" class="max-h-16 w-auto">
                                <?php endif; ?>
                            </div>
                        <?php else : ?>
                            <h3 class="text-lg font-bold mb-4"><?php echo esc_html($company_name); ?></h3>
                        <?php endif; ?>
                        
                        <?php if ($footer_text) : ?>
                            <div class="footer-text mb-4">
                                <?php echo wp_kses_post($footer_text); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="footer-menu">
                        <h3 class="text-lg font-bold mb-4"><?php esc_html_e('Quick Links', 'mvw'); ?></h3>
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'footer',
                            'menu_id' => 'footer-menu',
                            'container' => false,
                            'menu_class' => 'footer-links space-y-2',
                            'fallback_cb' => false,
                        ]);
                        ?>
                    </div>

                    <div class="footer-contact">
                        <h3 class="text-lg font-bold mb-4"><?php esc_html_e('Contact Us', 'mvw'); ?></h3>
                        <?php if ($address) : ?>
                            <p class="mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 inline-block mr-2 align-text-bottom">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                                <?php echo nl2br(esc_html($address)); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if ($phone) : ?>
                            <p class="mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 inline-block mr-2 align-text-bottom">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="hover:text-gray-300">
                                    <?php echo esc_html($phone); ?>
                                </a>
                            </p>
                        <?php endif; ?>
                        
                        <?php if ($email) : ?>
                            <p class="mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 inline-block mr-2 align-text-bottom">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                <a href="mailto:<?php echo esc_attr($email); ?>" class="hover:text-gray-300">
                                    <?php echo esc_html($email); ?>
                                </a>
                            </p>
                        <?php endif; ?>
                        
                        <?php
                        // Social Media
                        $facebook = mvw_get_option('social_links_facebook');
                        $twitter = mvw_get_option('social_links_twitter');
                        $instagram = mvw_get_option('social_links_instagram');
                        $linkedin = mvw_get_option('social_links_linkedin');
                        
                        if ($facebook || $twitter || $instagram || $linkedin) : 
                        ?>
                            <div class="social-links flex space-x-3 mt-4">
                                <?php if ($facebook) : ?>
                                    <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener noreferrer" class="text-white hover:text-gray-300" aria-label="Facebook">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-5 h-5" fill="currentColor">
                                            <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ($twitter) : ?>
                                    <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" class="text-white hover:text-gray-300" aria-label="Twitter">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5" fill="currentColor">
                                            <path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ($instagram) : ?>
                                    <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" class="text-white hover:text-gray-300" aria-label="Instagram">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-5 h-5" fill="currentColor">
                                            <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ($linkedin) : ?>
                                    <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" class="text-white hover:text-gray-300" aria-label="LinkedIn">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-5 h-5" fill="currentColor">
                                            <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="<?php echo $footer_style !== 'minimal' ? 'border-t border-gray-700 pt-6' : ''; ?> text-center">
                <p>
                    &copy; <?php echo date('Y'); ?> <?php echo esc_html($company_name); ?>. 
                    <?php esc_html_e('All rights reserved.', 'mvw'); ?>
                    <?php 
                    // Display "Designed by" text if enabled
                    if (mvw_get_option('show_credit', true)) : 
                    ?>
                        <span class="designer-credit">
                            <?php esc_html_e('Website by', 'mvw'); ?> 
                            <a href="https://meonvalleyweb.com" class="text-white hover:text-gray-300" target="_blank" rel="noopener">
                                MeonValleyWeb
                            </a>
                        </span>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>