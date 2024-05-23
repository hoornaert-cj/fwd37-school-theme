<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

	<?php while (have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->


	<div class="entry-content">
	<?php
		the_content();
		$taxonomy = 'fwd-staff-category';
		$terms    = get_terms(
			array(
				'taxonomy' => $taxonomy
			)
		);

		if($terms && ! is_wp_error($terms) ){
			foreach($terms as $term){
				$args = array(
					'post_type'      => 'fwd-staff',
					'posts_per_page' => -1,
					'order'          => 'ASC',
					'orderby'        => 'title',
					'tax_query'      => array(
						array(
							'taxonomy' => $taxonomy,
							'field'    => 'slug',
							'terms'    => $term->slug,
						)
					),
				);
						 
				$query = new WP_Query( $args );
					
				if ( $query -> have_posts() ) {
					// Output Term name.
					echo '<h2>' . esc_html( $term->name ) . '</h2>';
					
					// Output Content.
					while ( $query -> have_posts() ) {
						$query -> the_post();
					
						if ( function_exists( 'get_field' ) ) {
							if ( get_field( 'short_biography' ) ) {

								echo '<h3 id="'. esc_attr( get_the_ID() ) .'">'. esc_html( get_the_title() ) .'</h3>';
								?>
								<p><strong>Bio:</strong> <?php the_field( 'short_biography' ); ?></p>
									<?php 
									if($term->name == 'Faculty') {
									?>

									<p><strong>Courses Taught:</strong> <?php the_field( 'courses_taught' ); ?></p>
									<p><strong>Website: </strong><a href="<?php the_field( 'instructor_website' );?>"><?php the_field( 'instructor_website' );?></a></p>
									
									<?php
									}
							}
						}
					
					}
					wp_reset_postdata();
				}
			}
		}
		?>
	</div>


</article><!-- #post-<?php the_ID(); ?> -->
<?php endwhile; ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
