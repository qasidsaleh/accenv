<?php
/**************************************************
                Projects CPT
**************************************************/
function PROJECT() {
  register_post_type( 'Project',
    array(
        'labels' => array(
            'name' => __( 'Project'),
            'singular_name' => __( 'Project')
        ),
        'public' => true,
            'menu_icon' => 'dashicons-open-folder',
            //'has_archive' => ture,
            'rewrite' => array('slug' => 'project'),
        )
    );
}
add_action( 'init', 'PROJECT' );
function PROJECT_a() {
  $labels = array(
    'name'                => _x( 'Project', 'Post Type General Name', 'acc' ),
    'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'acc' ),
    'menu_name'           => __( 'Project', 'acc' ),
    'parent_item_colon'   => __( 'Project', 'acc' ),
    'all_items'           => __( 'All Project', 'acc' ),
    'view_item'           => __( 'View Project', 'acc' ),
    'add_new_item'        => __( 'Add New Project', 'acc' ),
    'add_new'             => __( 'Add New', 'acc' ),
    'edit_item'           => __( 'Edit Project', 'acc' ),
    'update_item'         => __( 'Update Project', 'acc' ),
    'search_items'        => __( 'Search Project', 'acc' ),
    'not_found'           => __( 'Not Found', 'acc' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'acc' ),
  );
  $args = array(
    'label'               => __( 'Project', 'acc' ),
    'description'         => __( 'Project', 'acc' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'thumbnail'),
    'taxonomies'          => array( 'genres' ),
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 1,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( 'PROJECT', $args );
}
add_action( 'init', 'PROJECT_a', 0 );
/**************************************************
                News CPT
**************************************************/
function NEWS() {
  register_post_type( 'News',
    array(
        'labels' => array(
            'name' => __( 'News'),
            'singular_name' => __( 'News')
        ),
        'public' => true,
            'menu_icon' => 'dashicons-open-folder',
            //'has_archive' => ture,
            'rewrite' => array('slug' => 'news'),
        )
    );
}
add_action( 'init', 'NEWS' );
function NEWS_a() {
  $labels = array(
    'name'                => _x( 'News', 'Post Type General Name', 'acc' ),
    'singular_name'       => _x( 'News', 'Post Type Singular Name', 'acc' ),
    'menu_name'           => __( 'News', 'acc' ),
    'parent_item_colon'   => __( 'News', 'acc' ),
    'all_items'           => __( 'All News', 'acc' ),
    'view_item'           => __( 'View News', 'acc' ),
    'add_new_item'        => __( 'Add New News', 'acc' ),
    'add_new'             => __( 'Add New', 'acc' ),
    'edit_item'           => __( 'Edit News', 'acc' ),
    'update_item'         => __( 'Update News', 'acc' ),
    'search_items'        => __( 'Search News', 'acc' ),
    'not_found'           => __( 'Not Found', 'acc' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'acc' ),
  );
  $args = array(
    'label'               => __( 'News', 'acc' ),
    'description'         => __( 'News', 'acc' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'thumbnail'),
    'taxonomies'          => array( 'genres' ),
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 1,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( 'NEWS', $args );
}
add_action( 'init', 'NEWS_a', 0 );
/**************************************************
                Attendees CPT
**************************************************/
function ATTENDEES() {
  register_post_type( 'Attendees',
    array(
        'labels' => array(
            'name' => __( 'Attendees'),
            'singular_name' => __( 'Attendees')
        ),
        'public' => true,
            'menu_icon' => 'dashicons-open-folder',
            //'has_archive' => ture,
            'rewrite' => array('slug' => 'attendees'),
        )
    );
}
add_action( 'init', 'ATTENDEES' );
function ATTENDEES_a() {
  $labels = array(
    'name'                => _x( 'Attendees', 'Post Type General Name', 'acc' ),
    'singular_name'       => _x( 'Attendees', 'Post Type Singular Name', 'acc' ),
    'menu_name'           => __( 'Attendees', 'acc' ),
    'parent_item_colon'   => __( 'Attendees', 'acc' ),
    'all_items'           => __( 'All Attendees', 'acc' ),
    'view_item'           => __( 'View Attendees', 'acc' ),
    'add_new_item'        => __( 'Add New Attendees', 'acc' ),
    'add_new'             => __( 'Add New', 'acc' ),
    'edit_item'           => __( 'Edit Attendees', 'acc' ),
    'update_item'         => __( 'Update Attendees', 'acc' ),
    'search_items'        => __( 'Search Attendees', 'acc' ),
    'not_found'           => __( 'Not Found', 'acc' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'acc' ),
  );
  $args = array(
    'label'               => __( 'Attendees', 'acc' ),
    'description'         => __( 'Attendees', 'acc' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'thumbnail'),
    'taxonomies'          => array( 'genres' ),
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 1,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( 'ATTENDEES', $args );
}
add_action( 'init', 'ATTENDEES_a', 0 );
/**************************************************
                Supervisors CPT
**************************************************/
function SUPERVISORS() {
  register_post_type( 'Supervisors',
    array(
        'labels' => array(
            'name' => __( 'Supervisors'),
            'singular_name' => __( 'Supervisors')
        ),
        'public' => true,
            'menu_icon' => 'dashicons-open-folder',
            //'has_archive' => ture,
            'rewrite' => array('slug' => 'supervisors'),
        )
    );
}
add_action( 'init', 'SUPERVISORS' );
function SUPERVISORS_a() {
  $labels = array(
    'name'                => _x( 'Supervisors', 'Post Type General Name', 'acc' ),
    'singular_name'       => _x( 'Supervisors', 'Post Type Singular Name', 'acc' ),
    'menu_name'           => __( 'Supervisors', 'acc' ),
    'parent_item_colon'   => __( 'Supervisors', 'acc' ),
    'all_items'           => __( 'All Supervisors', 'acc' ),
    'view_item'           => __( 'View Supervisors', 'acc' ),
    'add_new_item'        => __( 'Add New Supervisors', 'acc' ),
    'add_new'             => __( 'Add New', 'acc' ),
    'edit_item'           => __( 'Edit Supervisors', 'acc' ),
    'update_item'         => __( 'Update Supervisors', 'acc' ),
    'search_items'        => __( 'Search Supervisors', 'acc' ),
    'not_found'           => __( 'Not Found', 'acc' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'acc' ),
  );
  $args = array(
    'label'               => __( 'Supervisors', 'acc' ),
    'description'         => __( 'Supervisors', 'acc' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'thumbnail'),
    'taxonomies'          => array( 'genres' ),
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 1,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( 'SUPERVISORS', $args );
}
add_action( 'init', 'SUPERVISORS_a', 0 );
/**************************************************
                Register Widget
**************************************************/
add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Latest News', 'theme-slug' ),
        'id' => 'latest-news',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ) );
}

?>
