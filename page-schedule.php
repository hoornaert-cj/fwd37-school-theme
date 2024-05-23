<?php
/*
 * Template Name: Schedule Page
 * Description: A custom template for displaying the schedule page with ACF fields.
 */
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
            // Output the page content.
            the_content();

            // Retrieve the repeater field data.
            $schedule_items = get_field('weekly_course_schedule');

            // Check if there are schedule items.
            if ($schedule_items):
        ?>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Course</th>
                            <th>Instructor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($schedule_items as $item): ?>
                            <tr>
                                <td><?php echo $item['date']; ?></td>
                                <td><?php echo $item['course']; ?></td>
                                <td><?php echo $item['instructor']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        <?php
            endif;
        // End the loop.
        endwhile;
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
// Include the footer template.
get_footer();
