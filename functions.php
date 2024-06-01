<?php
/**
 * School Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package School_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fwd37_school_theme_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on School Theme, use a find and replace
     * to change 'fwd37-school-theme' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'fwd37-school-theme', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    /*
     * Add new image size at 200x300px
     */
    add_image_size( '200x300', 200, 300, true );

    /*
     * Add support for custom logo
     */
    add_theme_support( 'custom-logo' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'header' => esc_html__( 'Header Menu Location', 'fwd37-school-theme' ),
            'footer' => esc_html__( 'Footer Menu Location', 'fwd37-school-theme' ),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'fwd37_school_theme_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    /**
     * Add support for Block Editor features.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
     */
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action( 'after_setup_theme', 'fwd37_school_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fwd37_school_theme_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'fwd37_school_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'fwd37_school_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fwd37_school_theme_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'fwd37-school-theme' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'fwd37-school-theme' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'fwd37_school_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fwd37_school_theme_scripts() {
    wp_enqueue_style( 'fwd37-school-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_style_add_data( 'fwd37-school-theme-style', 'rtl', 'replace' );

    wp_enqueue_script( 'fwd37-school-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Enqueue Google Font "Fira Sans"
    wp_enqueue_style( 'fwd37-google-fonts', 'https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'fwd37_school_theme_scripts' );

// Setup Animate on Scroll so each blog post animates into the viewport when scrolling
// Enqueue Animate on Scroll (AOS) styles and scripts
function fwd37_school_theme_enqueue_aos() {
    if ( is_singular( 'post' ) || is_home() ) {
        // Enqueue AOS CSS
        wp_enqueue_style( 'aos-css', get_template_directory_uri() . '/assets/vendor/aos/dist/aos.css', array(), _S_VERSION );

        // Enqueue AOS JS
        wp_enqueue_script( 'aos-js', get_template_directory_uri() . '/assets/vendor/aos/dist/aos.js', array(), _S_VERSION, true );

        // Initialize AOS
        wp_add_inline_script( 'aos-js', 'AOS.init();' );
    }
}
add_action( 'wp_enqueue_scripts', 'fwd37_school_theme_enqueue_aos' );

function fwd37_school_theme_enqueue_styles() {
    wp_enqueue_style( 'fwd37-school-theme-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
}

add_action( 'wp_enqueue_scripts', 'fwd37_school_theme_enqueue_styles' );

function enqueue_theme_assets() {
    // Enqueue the SVG file
    wp_enqueue_style( 'menu-svg', get_template_directory_uri() . '/assets/images/menu.svg', array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_theme_assets' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

// Add the custom post types and custom taxonomies
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

?>


