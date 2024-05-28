<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-aos="fade-up">
    <header class="entry-header">
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;

        if ( 'post' === get_post_type() ) :
            ?>
            <div class="entry-meta">
                <?php
                fwd37_school_theme_posted_on();
                fwd37_school_theme_posted_by();
                ?>
            </div>
        <?php endif; ?>
    </header>

    <?php fwd37_school_theme_post_thumbnail(); ?>

    <?php if ( ! is_singular() ) : ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>
    <?php else : ?>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    <?php endif; ?>

    <footer class="entry-footer">
        <?php fwd37_school_theme_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
