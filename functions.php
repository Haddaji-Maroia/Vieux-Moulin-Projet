<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Disable Gutenberg on the back end.
add_filter('use_block_editor_for_post', '__return_false');
// Disable Gutenberg for widgets.
add_filter('use_widgets_block_editor', '__return_false');



function portfolio_enqueue_assets() {
    $manifest = json_decode(file_get_contents(get_template_directory() . '/public/.vite/manifest.json'), true);

    // CSS
    if (isset($manifest['resources/css/styles.scss']['file'])) {
        wp_enqueue_style(
            'portfolio-style',
            get_template_directory_uri() . '/public/' . $manifest['resources/css/styles.scss']['file']
        );
    }


    // JS
    if (isset($manifest['resources/js/main.js']['file'])) {
        wp_enqueue_script(
            'portfolio-script',
            get_template_directory_uri() . '/public/' . $manifest['resources/js/main.js']['file'],
            [],
            null,
            true
        );

    }
}
add_action('wp_enqueue_scripts', 'portfolio_enqueue_assets');


function portfoliomaroia_theme_support(){
    //Add Dynamic title tag support
    add_theme_support( 'title-tag' );
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}

add_action( 'after_setup_theme', 'portfoliomaroia_theme_support' );



// MENUS

function theme_register_menus() {
    register_nav_menus([
        'primary' => 'Menu principal',
        'footer'  => 'Menu footer',
    ]);
}
add_action('init', 'theme_register_menus');


function portfolio_maroia_register_styles() {
    wp_enqueue_style(
        'portfolio-maroia-style',
        get_template_directory_uri() . '/style.css',
        array(),
        filemtime(get_template_directory() . '/style.css'),
        'all'
    );
}

add_action('wp_enqueue_scripts', 'portfolio_maroia_register_styles');


add_filter('show_admin_bar', '__return_false');

function my_own_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}

add_filter('upload_mimes', 'my_own_mime_types');


// Enregistrer contenu projets

function register_custom_post_type_projets() {
    register_post_type('projets', [
        'label' => 'Projets',
        'description' => 'Mes projets',
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-portfolio',
        'menu_position' => 5,
        'rewrite' => ['slug' => 'projets'],
        'supports' => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'register_custom_post_type_projets');


//taxonomie pour type de projet

function register_project_taxonomy() {
    register_taxonomy(
        'type_projet', // slug della tassonomia
        'projets',     // post type a cui è associata
        [
            'label' => 'Type de projet',
            'public' => true,
            'hierarchical' => false, // tipo tag (true se vuoi tipo categorie)
            'show_in_rest' => true,
            'rewrite' => ['slug' => 'type'],
        ]
    );
}
add_action('init', 'register_project_taxonomy');


// CONTACT FORM

function dw_register_contact_message_post_type() {
    register_post_type('contact_message', [
        'label' => 'Messages de contact',
        'public' => false,
        'show_ui' => true,
        'supports' => ['title', 'editor'],
        'menu_icon' => 'dashicons-email',
    ]);
}
add_action('init', 'dw_register_contact_message_post_type');


add_action('admin_post_nopriv_handle_contact_form', 'handle_contact_form');
add_action('admin_post_handle_contact_form', 'handle_contact_form');

function handle_contact_form() {
    session_start();

    $errors = [];

    // Validazione base
    if (empty($_POST['familyname'])) $errors['familyname'] = 'Le nom est requis.';
    if (empty($_POST['name'])) $errors['name'] = 'Le prénom est requis.';
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Adresse email invalide.';
    if (empty($_POST['message'])) $errors['message'] = 'Le message est requis.';

    if (!empty($errors)) {
        $_SESSION['contact_form_errors'] = $errors;
        wp_safe_redirect(wp_get_referer());
        exit;
    }

    // Invia email
    $message = sanitize_textarea_field($_POST['message']);
    $subject = sanitize_text_field($_POST['object']);
    $from = sanitize_email($_POST['email']);
    $name = sanitize_text_field($_POST['name'] . ' ' . $_POST['familyname']);

    wp_mail(
        'tuo@email.com',
        "Contact: $subject",
        "Message de $name\n\n$message\n\nEmail: $from",
        ['Reply-To: '.$from]
    );

    $_SESSION['contact_form_success'] = 'Merci! Votre message a été envoyé.';
    wp_safe_redirect(wp_get_referer());
    exit;
}

add_action('init', function () {
    add_rewrite_rule('^form-handler/?$', 'index.php?form_handler=1', 'top');
    add_rewrite_tag('%form_handler%', '1');
});

add_action('template_redirect', function () {
    if (get_query_var('form_handler') == 1) {
        include get_template_directory() . '/form/form-handler.php';
        exit;
    }
});

// ADD CLASS NAV_LINK FOR HOVER
function add_nav_link_class($classes, $item, $args) {
    if ($args->theme_location === 'primary') {
        $classes[] = 'nav-link';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_nav_link_class', 10, 3);









