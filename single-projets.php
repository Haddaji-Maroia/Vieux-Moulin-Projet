

<?php get_header(); ?>

<section class="single-project">
    <div class="container">
        <h1><?php the_title(); ?></h1>

        <div class="project_presentation">
            <div class="image_cover">
                <?php if (has_post_thumbnail()) : ?>
                    <figure><?php the_post_thumbnail('medium'); ?></figure>
                <?php endif; ?>
            </div>

            <div class="text_projet">
                <a href="<?php echo get_permalink(get_page_by_path('mes-projets')); ?>">← Tous les projets</a>

                <p>
                    <?php $description_project = get_field('description_project') ?>
                    <?= $description_project !== '' ? $description_project : '' ?>
                </p>

                <?php if (have_rows('link_project')) : ?>
                    <div class="project-links">
                        <?php while (have_rows('link_project')) : the_row();
                            $link_name = get_sub_field('link_name');
                            $link_url = get_sub_field('link_url');
                            ?>
                            <?php if ($link_name && $link_url) : ?>
                                <a href="<?= esc_url($link_url); ?>" target="_blank" rel="noopener noreferrer">
                                    <?= esc_html($link_name); ?>
                                </a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <p class="tech_title"><strong>Technologies :</strong></p>

                <?php

                if (have_rows('technologies')) : ?>
                    <div class="bloc_technologies">
                        <?php

                        while (have_rows('technologies')) : the_row();

                            $tech_name = get_sub_field('technology_name');

                            if (!empty($tech_name)) :
                                ?>
                                <span class="tech-badge"><?= esc_html($tech_name); ?></span>
                            <?php
                            endif;

                        endwhile;
                        ?>
                    </div>
                <?php else : ?>
                    <p>No technologies</p>
                <?php endif; ?>

            </div>
        </div>

        <?php if (have_rows('about_project')) : ?>
            <div class="explaination">
                <?php while (have_rows('about_project')) : the_row();
                    $title = get_sub_field('title_box_description');
                    $description = get_sub_field('explications');
                    ?>
                    <div class="cardproject">
                        <?php if (!empty($title)) : ?>
                            <h3><?= esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if (!empty($description)) : ?>
                            <p><?= esc_html($description); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p>no section</p>
        <?php endif; ?>

</section>

<?php
$gallery = get_field('galerie_projects'); // sostituisci col tuo campo ACF se ha un altro nome

if ($gallery): ?>
    <section class="project-gallery container">
        <h2>Galerie</h2>
        <?php foreach ($gallery as $image): ?>
            <figure>
                <img src="<?= esc_url($image['sizes']['medium']); ?>" alt="<?= esc_attr($image['alt']); ?>">
            </figure>
        <?php endforeach; ?>
    </section>
<?php endif; ?>


<?php get_footer(); ?>




