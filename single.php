<?php

use Hwale\Controllers\Post;

get_header(); ?>

<main id="main" class="main">
    <?php if (have_posts()) {
        while (have_posts()) {
            the_post();

            // Full, unaliased class name must be used in class_exists()
            if (class_exists('Hwale\Controllers\Post')) {
                new Post();
            }
        }
    } ?>
</main>

<?php get_footer();
