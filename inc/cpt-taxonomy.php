<?php

function fwd_register_custom_post_types() {
    $labels = array(
        'name'                  => _x( 'Staff', 'post type general name' ),
        'singular_name'         => _x( 'Staff', 'post type singular name' ),
        'menu_name'             => _x( 'Staff', 'admin menu' ),
        'name_admin_bar'        => _x( 'Staff', 'add new on admin bar' ),
        'add_new'               => _x( 'Add New', 'staff' ),
        'add_new_item'          => __( 'Add New Staff' ),
        'new_item'              => __( 'New Staff' ),
        'edit_item'             => __( 'Edit Staff' ),
        'view_item'             => __( 'View Staff' ),
        'all_items'             => __( 'All Staff' ),
        'search_items'          => __( 'Search Staff' ),
        'parent_item_colon'     => __( 'Parent Staff:' ),
        'not_found'             => __( 'No staff found.' ),
        'not_found_in_trash'    => __( 'No staff found in Trash.' ),
        'archives'              => __( 'Staff Archives' ),
        'insert_into_item'      => __( 'Insert into staff' ),
        'uploaded_to_this_item' => __( 'Uploaded to this staff' ),
        'filter_items_list'     => __( 'Filter staff list' ),
        'items_list_navigation' => __( 'Staff list navigation' ),
        'items_list'            => __( 'Staff list' ),
        'featured_image'        => __( 'Staff featured image' ),
        'set_featured_image'    => __( 'Set staff featured image' ),
        'remove_featured_image' => __( 'Remove staff featured image' ),
        'use_featured_image'    => __( 'Use as featured image' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'staff' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array( 'title' ),
    );

    register_post_type( 'fwd-staff', $args );
}
add_action( 'init', 'fwd_register_custom_post_types' );

function fwd_register_custom_taxonomies() {
    $labels = array(
        'name'                          => _x( 'Staff Categories', 'taxonomy general name' ),
        'singular_name'         => _x( 'Staff Category', 'taxonomy singular name' ),
        'search_items'          => __( 'Search Staff Categories' ),
        'all_items'                  => __( 'All Staff Categories' ),
        'parent_item'            => __( 'Parent Staff Category' ),
        'parent_item_colon' => __( 'Parent Staff Category:' ),
        'edit_item'                 => __( 'Edit Staff Category' ),
        'view_item'                => __( 'View Staff Category' ),
        'update_item'           => __( 'Update Staff Category' ),
        'add_new_item'        => __( 'Add New Staff Category' ),
        'new_item_name'     => __( 'New Staff Category Name' ),
        'menu_name'            => __( 'Staff Categories' ),
    );

    $args = array(
        'hierarchical'                      => true,
        'labels'                                 => $labels,
        'show_ui'                             => true,
        'show_in_menu'                 => true,
        'show_in_nav_menus'        => true,
        'show_in_rest'                     => true,
        'show_admin_column'       => true,
        'query_var'                           => true,
        'rewrite'           => array( 'slug' => 'fwd-staff-category' ),
    );

    register_taxonomy( 'fwd- staff-category', array( 'fwd-staff' ), $args );

    if ( ! term_exists( 'Faculty', 'fwd_staff-category' ) ) {
        wp_insert_term( 'Faculty', 'fwd_staff-category' );
    }
    if ( ! term_exists( 'Administrative', 'fwd_staff-category' ) ) {
        wp_insert_term( 'Administrative', 'fwd_staff-category' );
    }
}
add_action( 'init', 'fwd_register_custom_taxonomies' );


function fwd_change_staff_title_placeholder( $title ) {
    $screen = get_current_screen();

    if ( 'fwd-staff' == $screen->post_type ) {
        $title = 'Add staff name';
    }

    return $title;
}
add_filter( 'enter_title_here', 'fwd_change_staff_title_placeholder' );
