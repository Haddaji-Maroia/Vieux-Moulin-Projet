<?php /* Template Name: Page : "Projets" */ ?>
<?php get_header(); ?>

<section id="projects" class="projects-section">
    <div class="projects container">
        <h1 class="hidden">
            Projects page
        </h1>

        <h2>
            <?php $title = get_field('title'); ?>
            <?= $title !== '' ? esc_html($title) : ''; ?>
        </h2>

        <p>
            <?php $description = get_field('description'); ?>
            <?= $description !== '' ? esc_html($description) : ''; ?>
        </p>

        <!-- Filter Buttons -->
        <div class="filter-buttons">
            <button data-filter="all" class="active">Tous</button>
            <button data-filter="web">Web</button>
            <button data-filter="mobile">Mobile</button>
            <button data-filter="design">Design</button>
        </div>

        <!-- Projects Grid -->
        <div class="project-container">
            <?php
            $args = [
                'post_type' => 'projets',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ];
            $projects = new WP_Query($args);
            if ($projects->have_posts()) :
                while ($projects->have_posts()) : $projects->the_post();

                    // tassonomia "type_projet"
                    $terms = get_the_terms(get_the_ID(), 'type_projet');
                    $classes = 'project';
                    if ($terms && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            $classes .= ' ' . $term->slug;
                        }
                    }
                    ?>
                    <article class="<?= esc_attr($classes); ?>">
                        <div class="floating">
                            <a class="project-card" href="<?php the_permalink(); ?>">
                                <div class="project-cover">
                                    <figure>
                                        <?php the_post_thumbnail('medium'); ?>
                                        <span><?php the_title(); ?></span>
                                    </figure>
                                </div>
                            </a>
                        </div>
                    </article>
                <?php endwhile;
                wp_reset_postdata();
            else :
                echo '<p>Aucun projet trouvé.</p>';
            endif;
            ?>
        </div>

    </div>
</section>

<!-- JS per filtro progetti -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".filter-buttons button");
        const projects = document.querySelectorAll(".project");

        buttons.forEach(button => {
            button.addEventListener("click", () => {
                const filter = button.getAttribute("data-filter");

                buttons.forEach(btn => btn.classList.remove("active"));
                button.classList.add("active");

                projects.forEach(project => {
                    if (filter === "all" || project.classList.contains(filter)) {
                        project.style.display = "block";
                    } else {
                        project.style.display = "none";
                    }
                });
            });
        });
    });
</script>

<?php get_footer(); ?>
