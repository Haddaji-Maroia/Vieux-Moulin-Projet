<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="Maroia Haddaji" />
    <meta name="keywords" content="portfolio, Maroia Haddaji, créative, développeuse" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <nav class="main-navigation" role="navigation" aria-label="Navigation principale">

        <?php
        if (function_exists('the_custom_logo')) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            if ($logo) {
                echo '<img class="logo" src="' . esc_url($logo[0]) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
            } else {
                echo '<h1 class="site-title">' . esc_html(get_bloginfo('name')) . '</h1>';
            }
        }
        ?>

        <!-- Checkbox toggle -->
        <input type="checkbox" id="menu-toggle" class="menu-toggle" aria-hidden="true" />

        <!-- Burger menu -->
        <label for="menu-toggle" class="navbar__toggle" aria-label="Ouvrir ou fermer le menu principal">
            <span class="bar bar1"></span>
            <span class="bar bar2"></span>
            <span class="bar bar3"></span>
        </label>

        <!-- Contenuto visibile della pagina -->
        <div class="page-content">
            <div class="container" role="menubar">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class' => 'menu',
                    'container' => false,
                    'fallback_cb' => false,
                ]);
                ?>

                <?php if (function_exists('pll_the_languages')) : ?>
                    <?php
                    $languages = pll_the_languages([
                        'raw' => 1,
                        'hide_if_empty' => 0,
                        'show_flags' => 0,
                        'show_names' => 1
                    ]);
                    ?>
                    <?php if (!empty($languages)) : ?>
                        <div class="language-switcher" role="navigation" aria-label="Sélecteur de langue">
                            <button class="current-lang-btn" aria-haspopup="true" aria-expanded="false" aria-label="Langue actuelle">
                                <?php
                                foreach ($languages as $lang) {
                                    if ($lang['current_lang']) {
                                        echo esc_html($lang['name']);
                                        break;
                                    }
                                }
                                ?>
                                ⌄
                            </button>
                            <ul class="lang-dropdown" role="menu">
                                <?php foreach ($languages as $lang) : ?>
                                    <?php if (!$lang['current_lang']) : ?>
                                        <li role="none">
                                            <a role="menuitem" href="<?= esc_url($lang['url']); ?>">
                                                <?= esc_html($lang['name']); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Off-canvas menu (mobile menu) -->
        <div class="offcanvas-menu" aria-label="Menu mobile">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_class' => 'offcanvas-menu-list',
                'container' => false,
                'fallback_cb' => false,
            ]);
            ?>

            <?php if (function_exists('pll_the_languages')) : ?>
                <?php if (!empty($languages)) : ?>
                    <div class="offcanvas-language-switcher" role="navigation" aria-label="Sélecteur de langue mobile">
                        <ul>
                            <?php foreach ($languages as $lang) : ?>
                                <li>
                                    <a href="<?= esc_url($lang['url']); ?>">
                                        <?= esc_html($lang['name']); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

    </nav>
</header>

<?php wp_footer(); ?>
</body>
</html>
