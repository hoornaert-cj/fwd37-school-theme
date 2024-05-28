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
                        the_post_thumbnail('thumbnail');
                    }
                    ?>
                    <!-- Display the title of the post -->
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header><!-- .entry-header -->

                <!-- Display the content of the post -->
                <div class="entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry-content -->

                <!-- Display related students based on the same taxonomy terms -->
                <div class="related-students">
                    <?php
                    // Retrieve the terms of the taxonomy attached to the post
                    $taxonomy = 'fwd-student-category';
                    $terms = get_the_terms(get_the_ID(), $taxonomy);

                    // Check if there are terms and no errors
                    if ($terms && !is_wp_error($terms)) {
                        // Loop through each term
                        foreach ($terms as $term) {
                            echo '<h2>Meet other ' . esc_html($term->name) . ' students</h2>';
                            $args = array(
                                'post_type' => 'fwd-student',
                                'posts_per_page' => -1,
                                'post__not_in' => array(get_the_ID()), // Exclude the current post
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

                            // Create a new query for related students
                            $related_students = new WP_Query($args);

                            // Check if there are related students
                            if ($related_students->have_posts()) :
                                echo '<ul>';
                                // Loop through related students
                                while ($related_students->have_posts()) :
                                    $related_students->the_post();
                                    // Display each related student as a list item
                                    echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                                endwhile;
                                echo '</ul>';
                            else :
                                // Message if no related students are found
                                echo '<p>No related students found.</p>';
                            endif;
                            // Reset post data
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

<?php get_sidebar(); ?>
<?php get_footer(); ?>
