<?php get_header(); ?>

<div class="error-404-container" role="main">
    <h1>404</h1>
    <h2>Oups&nbsp;! Page introuvable</h2>
    <p>
        Désolé, la page que vous recherchez n'existe pas ou a été déplacée.
    </p>

    <!-- Bouton pour retourner à l'accueil -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="home-button" aria-label="Retour à la page d’accueil">
        Retour à l'accueil
    </a>
</div>

<?php get_footer(); ?>
