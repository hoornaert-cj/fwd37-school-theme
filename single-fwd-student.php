<?php
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
    // Check if there are any posts to display
    if (have_posts()) :
        // Loop through the posts
        while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php
                    // Display the featured image if available
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('student-thumbnail');
                    }
                    ?>
                    <!-- Display the title of the post -->
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header><!-- .entry-header -->

                <!-- Display the content of the post -->
                <div class="entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry-content -->


                <div class="related-students">
                    <?php

                    $taxonomy = 'fwd-student-category';
                    $terms = get_the_terms(get_the_ID(), $taxonomy);


                    if ($terms && !is_wp_error($terms)) {

                        foreach ($terms as $term) {
                            echo '<h2>Meet other ' . esc_html($term->name) . ' students</h2>';
                            $args = array(
                                'post_type' => 'fwd-student',
                                'posts_per_page' => -1,
                                'post__not_in' => array(get_the_ID()), //
                                'orderby' => 'title',
                                'order' => 'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => $taxonomy,
                                        'field' => 'slug',
                                        'terms' => $term->slug,
                                    ),
                                ),
                            );


                            $related_students = new WP_Query($args);

                            if ($related_students->have_posts()) :
                                echo '<ul>';

                                while ($related_students->have_posts()) :
                                    $related_students->the_post();
                                    echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                                endwhile;
                                echo '</ul>';
                            else :
                                echo '<p>No related students found.</p>';
                            endif;

                            wp_reset_postdata();
                        }
                    }
                    ?>
                </div><!-- .related-students -->

            </article><!-- #post-<?php the_ID(); ?> -->
        <?php endwhile; // End of the loop.
    endif;
    ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
