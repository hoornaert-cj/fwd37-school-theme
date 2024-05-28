<?php

function fwd_register_custom_post_types() {
    //Staff CPT
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
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array( 'title' ),
    );

    register_post_type( 'fwd-staff', $args );

    //Student CPT
    $labels = array(
        'name'                  => _x( 'Students', 'post type general name' ),
        'singular_name'         => _x( 'Student', 'post type singular name' ),
        'menu_name'             => _x( 'Student', 'admin menu' ),
        'name_admin_bar'        => _x( 'Student', 'add new on admin bar' ),
        'add_new'               => _x( 'Add New', 'student' ),
        'add_new_item'          => __( 'Add New Student' ),
        'new_item'              => __( 'New Student' ),
        'edit_item'             => __( 'Edit Student' ),
        'view_item'             => __( 'View Student' ),
        'all_items'             => __( 'All Student' ),
        'search_items'          => __( 'Search Student' ),
        'parent_item_colon'     => __( 'Parent Student:' ),
        'not_found'             => __( 'No student found.' ),
        'not_found_in_trash'    => __( 'No student(s) found in Trash.' ),
        'archives'              => __( 'Student Archives' ),
        'insert_into_item'      => __( 'Insert into student' ),
        'uploaded_to_this_item' => __( 'Uploaded to this student' ),
        'filter_items_list'     => __( 'Filter student list' ),
        'items_list_navigation' => __( 'Student list navigation' ),
        'items_list'            => __( 'Student list' ),
        'featured_image'        => __( 'Student featured image' ),
        'set_featured_image'    => __( 'Set student featured image' ),
        'remove_featured_image' => __( 'Remove student featured image' ),
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
        'rewrite'            => array( 'slug' => 'students' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-admin-users',
        'supports'           => array('title', 'editor', 'excerpt', 'thumbnail'),
        'template'           => array(array('core/paragraph', array('placeholder' => 'Describe the student...')), array('core/button')),
        'template_lock'      => 'all',
    );

    register_post_type( 'fwd-student', $args );
}
add_action( 'init', 'fwd_register_custom_post_types' );

function fwd_register_custom_taxonomies() {
    //Staff Category
    $labels = array(
        'name'                          => _x( 'Staff Categories', 'taxonomy general name' ),
        'singular_name'                 => _x( 'Staff Category', 'taxonomy singular name' ),
        'search_items'                  => __( 'Search Staff Categories' ),
        'all_items'                     => __( 'All Staff Categories' ),
        'parent_item'                   => __( 'Parent Staff Category' ),
        'parent_item_colon'             => __( 'Parent Staff Category:' ),
        'edit_item'                     => __( 'Edit Staff Category' ),
        'view_item'                     => __( 'View Staff Category' ),
        'update_item'                   => __( 'Update Staff Category' ),
        'add_new_item'                  => __( 'Add New Staff Category' ),
        'new_item_name'                 => __( 'New Staff Category Name' ),
        'menu_name'                     => __( 'Staff Categories' ),
    );

    $args = array(
        'hierarchical'                  => true,
        'labels'                        => $labels,
        'show_ui'                       => true,
        'show_in_menu'                  => true,
        'show_in_nav_menus'             => true,
        'show_in_rest'                  => true,
        'show_admin_column'             => true,
        'query_var'                     => true,
        'rewrite'                       => array( 'slug' => 'fwd-staff-category' ),
    );

    register_taxonomy( 'fwd-staff-category', array( 'fwd-staff' ), $args );

    if ( ! term_exists( 'Faculty', 'fwd-staff-category' ) ) {
        wp_insert_term( 'Faculty', 'fwd-staff-category' );
    }
    if ( ! term_exists( 'Administrative', 'fwd-staff-category' ) ) {
        wp_insert_term( 'Administrative', 'fwd-staff-category' );
    }

    $labels = array(
        'name'                          => _x( 'Student Categories', 'taxonomy general name' ),
        'singular_name'                 => _x( 'Student Category', 'taxonomy singular name' ),
        'search_items'                  => __( 'Search Student Categories' ),
        'all_items'                     => __( 'All Student Categories' ),
        'parent_item'                   => __( 'Parent Student Category' ),
        'parent_item_colon'             => __( 'Parent Student Category:' ),
        'edit_item'                     => __( 'Edit Student Category' ),
        'view_item'                     => __( 'View Student Category' ),
        'update_item'                   => __( 'Update Student Category' ),
        'add_new_item'                  => __( 'Add New Student Category' ),
        'new_item_name'                 => __( 'New Student Category Name' ),
        'menu_name'                     => __( 'Student Categories' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'student-categories' ),
    );

    register_taxonomy( 'fwd-student-category', array( 'fwd-student' ), $args );

    // Check if terms exist and insert if they do not
    if ( ! term_exists( 'Designer', 'fwd-student-category' ) ) {
        wp_insert_term( 'Designer', 'fwd-student-category' );
    }
    if ( ! term_exists( 'Developer', 'fwd-student-category' ) ) {
        wp_insert_term( 'Developer', 'fwd-student-category' );
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
function fwd_change_student_title_placeholder( $title ) {
    $screen = get_current_screen();

    if ( 'fwd-student' == $screen->post_type ) {
        $title = 'Add student name';
    }

    return $title;
}
add_filter( 'enter_title_here', 'fwd_change_staff_title_placeholder' );
add_filter( 'enter_title_here', 'fwd_change_student_title_placeholder' );

?>
