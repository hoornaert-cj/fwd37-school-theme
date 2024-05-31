<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'fwd37-school-theme' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="site-branding">
            <?php
            $logo_url = get_template_directory_uri() . '/assets/images/logo.svg';
            if ( file_exists( get_template_directory() . '/assets/images/logo.svg' ) ) :
                ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                </a>
                <?php
            else :
                if ( is_front_page() && is_home() ) :
                    ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php
                else :
                    ?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php
                endif;
            endif;

            $fwd37_school_theme_description = get_bloginfo( 'description', 'display' );
            if ( $fwd37_school_theme_description || is_customize_preview() ) :
                ?>
                <p class="site-description"><?php echo $fwd37_school_theme_description; ?></p>
            <?php endif; ?>
        </div><!-- .site-branding -->

        <!-- Navigation -->
        <nav id="site-navigation" class="main-navigation">
            <!-- Menu Toggle Button for small screens -->
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/menu.svg' ); ?>" alt="<?php esc_attr_e( 'Menu', 'fwd37-school-theme' ); ?>">
            </button>
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'header',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'header-menu',
                    'container'      => false,
                )
            );
            ?>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->
</div>
</body>
</html>
