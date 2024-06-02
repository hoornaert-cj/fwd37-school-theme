<?php
/*
Template Name: Students List
*/
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    <h1 class="page-title">The Class</h1>
    <?php
    // Modify excerpt length and more link text for this template
    function custom_student_excerpt_length($length) {
        return 25;
    }
    add_filter('excerpt_length', 'custom_student_excerpt_length');

    function custom_student_excerpt_more($more) {
        return '... <a href="' . get_permalink() . '">Read More about the Student</a>';
    }
    add_filter('excerpt_more', 'custom_student_excerpt_more');

    // Query to get all student posts
    $args = array(
        'post_type' => 'fwd-student',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    );
    $student_query = new WP_Query($args);

    // Check if any students are found
    if ($student_query->have_posts()) :
        echo '<ul class="students-list">';
        // Loop through students
        while ($student_query->have_posts()) : $student_query->the_post(); ?>
            <li class="student-item">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="student-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="student-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <div class="student-specialty">
                    <?php
                    $terms = get_the_terms(get_the_ID(), 'fwd-student-category');
                    if ($terms && !is_wp_error($terms)) {
                        $term_list = wp_list_pluck($terms, 'name');
                        echo 'Specialty: ' . implode(', ', $term_list);
                    }
                    ?>
                </div>
            </li>
        <?php endwhile;
        echo '</ul>';
    else :
        echo '<p>No students found.</p>';
    endif;

    // Reset post data
    wp_reset_postdata();

    // Remove the filters after use
    remove_filter('excerpt_length', 'custom_student_excerpt_length');
    remove_filter('excerpt_more', 'custom_student_excerpt_more');
    ?>
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
