<?php
/**
 * Option 1: Standard Header with Logo and Navigation
 * 
 * Replace the header.php content with this
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-gray-50 text-gray-900 antialiased'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="min-h-screen flex flex-col">
    <header id="masthead" class="site-header bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) :
                        the_custom_logo();
                    else :
                    ?>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="text-xl font-bold no-underline">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                    <?php endif; ?>
                </div>

                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle md:hidden" aria-controls="primary-menu" aria-expanded="false">
                        <span class="sr-only"><?php esc_html_e('Menu', 'tailwindwp'); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="hidden md:block">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'primary',
                            'menu_id' => 'primary-menu',
                            'container' => false,
                            'menu_class' => 'flex space-x-6',
                            'fallback_cb' => false,
                        ]);
                        ?>
                    </div>
                </nav>
            </div>
            
            <div class="mobile-menu hidden mt-4 md:hidden">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_id' => 'mobile-menu',
                    'container' => false,
                    'menu_class' => 'flex flex-col space-y-2',
                    'fallback_cb' => false,
                ]);
                ?>
            </div>
        </div>
    </header>

    <div id="content" class="site-content flex-grow">