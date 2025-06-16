<footer role="contentinfo">
    <nav class="footer-nav" aria-label="Pied de page">
        <div class="footer-column">
            <h3 id="coordonnees-title">Coordonnées</h3>
            <ul aria-labelledby="coordonnees-title">
                <li><a href="tel:+32465309771" aria-label="Téléphoner à Maroia Haddaji">+32 (0)465 30 97 71</a></li>
                <li><a href="mailto:maroia.haddaji@student.hepl.be" aria-label="Envoyer un e-mail à Maroia Haddaji">maroia.haddaji@student.hepl.be</a></li>
                <li aria-label="Adresse">Beyne-Heusay, Province de Liège, Belgique</li>
            </ul>
        </div>

        <div class="footer-column">
            <h3 id="navigation-footer-title">Navigation</h3>
            <nav aria-labelledby="navigation-footer-title" role="navigation">
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer',
                    'menu_class'     => 'footer-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                ]);
                ?>
            </nav>
        </div>

        <div class="footer-column">
            <h3 id="social-title">Social</h3>
            <ul aria-labelledby="social-title">
                <li>
                    <a href="https://github.com/Haddaji-Maroia" target="_blank" rel="noopener"
                       aria-label="Voir le profil GitHub de Maroia Haddaji">
                        Github
                    </a>
                </li>
                <li>
                    <a href="https://linkedin.com/" target="_blank" rel="noopener"
                       aria-label="Voir le profil LinkedIn de Maroia Haddaji">
                        LinkedIn
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Maroia Haddaji. Tous droits réservés.</p>
    </div>

    <?php wp_footer(); ?>
</footer>
</body>
</html>
