<?php /* Template Name: Home page */ ?>
<?php
get_header();
?>

<main>
    <section id="landing" class="landing" role="region" aria-label="Section d’accueil" itemscope itemtype="https://schema.org/Person">
        <div class="content">
            <h1 class="title" itemprop="name">
                <?php $title = get_field('title') ?>
                <?= $title !== '' ? $title : '' ?><br>
                <span class="subtitle" itemprop="jobTitle">Web developer & designer</span>
            </h1>
            <div class="clouds">
                <img class="cloud cloud-left oscillate"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/clouds-left.svg"
                     alt="Grosse nuage style chinois">
                <img class="cloud cloud-right oscillate"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/clouds-right.svg"
                     alt="Petit nuage style chinois">
            </div>
        </div>
    </section>

    <section id="aboutMe" class="about-me" role="region" aria-labelledby="about-title" itemprop="description">
        <div class="presentation">
            <div class="text-about">
                <?php $about_title = get_field('about_title') ?>
                <h2 id="about-title" itemprop="description"><?= $about_title !== '' ? $about_title : '' ?></h2>
                <?php $about_text = get_field('about_text') ?>
                <?= $about_text !== '' ? $about_text : '' ?>
            </div>
            <div class="illustration">
                <div class="circle-container">
                    <img class="circle" src="<?php echo get_template_directory_uri(); ?>/assets/images/circle.svg"
                         alt="Cercle bleu décoratif" role="presentation">
                    <img class="avatar" src="<?php echo get_template_directory_uri(); ?>/assets/images/dragon-avatar.png"
                         alt="Avatar illustré de dragon">
                </div>
            </div>
            <img class="lantern__chinese" src="<?php echo get_template_directory_uri(); ?>/assets/images/lantern.svg"
                 alt="Lanterne chinoise décorative">
            <img class="corner-about corner-top-left-about"
                 src="<?php echo get_template_directory_uri(); ?>/assets/images/frame-decoration.svg"
                 alt="Décoration de coin style chinois">
            <img class="corner-about corner-bottom-right-about"
                 src="<?php echo get_template_directory_uri(); ?>/assets/images/frame-decoration.svg"
                 alt="Décoration de coin style chinois">
        </div>
    </section>

    <section id="projects" class="projects-section" role="region" aria-labelledby="projects-title" itemscope itemtype="https://schema.org/CreativeWork">
        <div class="projects">
            <?php $project_title = get_field('project_title') ?>
            <h2 id="projects-title"><?= $project_title !== '' ? $project_title : '' ?></h2>

            <div class="project-container">
                <?php
                $args = [
                    'post_type' => 'projets',
                    'posts_per_page' => 3,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ];

                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        $project_link = get_permalink();
                        ?>
                        <article class="project">
                            <div class="floating">
                                <a class="project-card" href="<?= esc_url($project_link); ?>" aria-label="Voir le projet : <?= esc_attr(get_the_title()); ?>" itemprop="url">
                                    <div class="project-cover">
                                        <figure>
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('medium', ['alt' => get_the_title()]); ?>
                                            <?php endif; ?>
                                            <span itemprop="name"><?= esc_html(get_the_title()); ?></span>
                                        </figure>
                                    </div>
                                </a>
                            </div>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>Aucun projet trouvé.</p>';
                endif;
                ?>
            </div>

            <div class="button-wrapper">
                <a class="btn-projects" href="<?php echo get_permalink(get_page_by_path('mes-projets')); ?>" aria-label="Explorer tous les projets">
                    <?php _e('Explorer →', 'textdomain'); ?>
                </a>
            </div>
        </div>
    </section>

    <section id="history" class="history-section" role="region" aria-labelledby="history-title">
        <div class="history">
            <img class="furin furin-top" src="<?php echo get_template_directory_uri(); ?>/assets/images/furin-top.svg"
                 alt="Carillon japonais supérieur">
            <img class="furin furin-bottom"
                 src="<?php echo get_template_directory_uri(); ?>/assets/images/furin-bottom.svg"
                 alt="Carillon japonais inférieur">
            <?php $history_title = get_field('history_title') ?>
            <h2 id="history-title"><?= $history_title !== '' ? $history_title : '' ?></h2>

            <?php if (have_rows('experiences')) : ?>
                <div class="timeline">
                    <?php while (have_rows('experiences')) : the_row();
                        $date = get_sub_field('date');
                        $description = get_sub_field('description');
                        ?>
                        <div class="experience" itemscope itemtype="https://schema.org/Organization">
                            <p class="year">
                                <?php if (!empty($date)) : ?>
                                    <span class="date" itemprop="foundingDate"><?= esc_html($date); ?></span><br>
                                <?php endif; ?>
                                <?php if (!empty($description)) : ?>
                                    <span itemprop="description"><?= esc_html($description); ?></span>
                                <?php endif; ?>
                            </p>
                            <img src="<?= get_template_directory_uri(); ?>/assets/images/lantern-blue.svg" alt="Lanterne bleue illustrée">
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <p>Aucune expérience trouvée.</p>
            <?php endif; ?>
        </div>
    </section>

    <section id="technologies" class="technologies-section" role="region" aria-labelledby="skills-title">
        <div class="technogies">
            <?php $skill_title = get_field('skill_title') ?>
            <h2 id="skills-title"><?= $skill_title !== '' ? $skill_title : '' ?></h2>
            <img class="clouds2 clouds2-right"
                 src="<?php echo get_template_directory_uri(); ?>/assets/images/cloud-2.svg" alt="Nuage flottant ">
            <img class="clouds2 clouds2-left"
                 src="<?php echo get_template_directory_uri(); ?>/assets/images/cloud-2.svg" alt="Nuage flottant ">
            <div class="box-tech">
                <?php if (have_rows('technologies')): ?>
                    <?php while (have_rows('technologies')): the_row();
                        $icon = get_sub_field('icon');
                        $title = get_sub_field('title');
                        $subtitle = get_sub_field('subtitle');
                        ?>
                        <div class="tech" itemscope itemtype="https://schema.org/DefinedTerm">
                            <div class="icon">
                                <?php if ($icon): ?>
                                    <img src="<?= esc_url($icon['url']); ?>" alt="<?= esc_attr($icon['alt']); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="text wrapper">
                                <p class="tech__title" itemprop="name"><?= esc_html($title); ?></p>
                                <p itemprop="description"><?= esc_html($subtitle); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section id="contactMe" class="contactMe-section" role="region" aria-labelledby="contact-title" itemscope itemtype="https://schema.org/ContactPoint">
        <div class="contact-me">
            <div class="text-wrapper">
                <h2 id="contact-title">Un mot, un souffle</h2>
                <p class="contact__paragraphe">Je serais ravie d’échanger autour d’un projet, d’une idée ou simplement d’un rêve partagé.</p>
            </div>
            <div class="contact-main">
                <div class="cloudsContact">
                    <img class="clouds-contact"
                         src="<?php echo get_template_directory_uri(); ?>/assets/images/cloud-2.svg"
                         alt="Nuage décoratif">
                </div>
                <div class="form-section">
                    <section class="form-container">
                        <div class="form">
                            <?php session_start(); ?>

                            <?php if (!empty($_SESSION['contact_form_errors'])): ?>
                                <div class="form-errors" role="alert">
                                    <?php foreach ($_SESSION['contact_form_errors'] as $error): ?>
                                        <p><?= esc_html($error); ?></p>
                                    <?php endforeach; ?>
                                    <?php unset($_SESSION['contact_form_errors']); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($_SESSION['contact_form_success'])): ?>
                                <div class="form-success" role="status">
                                    <p><?= esc_html($_SESSION['contact_form_success']); ?></p>
                                    <?php unset($_SESSION['contact_form_success']); ?>
                                </div>
                            <?php endif; ?>

                            <form action="<?= get_template_directory_uri(); ?>/form/form-handler.php" method="post" aria-label="Formulaire de contact">
                                <input type="hidden" name="action" value="handle_contact_form">
                                <h2>Formulaire de contact</h2>
                                <div class="form-input-container">
                                    <div class="form-input-wrapper">
                                        <label for="familyname">Nom</label>
                                        <input type="text" id="familyname" name="familyname" itemprop="name" placeholder="Ex. Mark" aria-required="true">
                                    </div>
                                    <div class="form-input-wrapper">
                                        <label for="name">Prénom</label>
                                        <input type="text" id="name" name="name" placeholder="Ex. Smith" aria-required="true">
                                    </div>
                                    <div class="form-input-wrapper">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" itemprop="email" placeholder="Ex. marksmith@gmail.com" aria-required="true">
                                    </div>
                                    <div class="form-input-wrapper">
                                        <label for="object">Sujet</label>
                                        <input type="text" id="object" name="object" placeholder="Ex. Votre sujet" aria-required="true">
                                    </div>
                                    <div class="form-input-wrapper">
                                        <label for="message">Message</label>
                                        <textarea name="message" id="message" cols="30" rows="10" placeholder="Ex. Écrivez votre message ici" aria-required="true"></textarea>
                                    </div>
                                </div>
                                <button class="btn-form" type="submit">Contactez-moi !</button>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
