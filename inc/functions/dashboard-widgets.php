<?php
  add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');  
  function my_custom_dashboard_widgets(){
    global $wp_meta_boxes;
    wp_add_dashboard_widget('custom_dashboard_widget1', 'Live Classes', 'custom_dashboard_live_class');
    wp_add_dashboard_widget('custom_dashboard_widget2', 'Courses', 'custom_dashboard_courses');
    wp_add_dashboard_widget('custom_dashboard_widget3', 'Attendees', 'custom_dashboard_attendees');
    wp_add_dashboard_widget('custom_dashboard_widget4', 'Cancelled Classes', 'custom_dashboard_cancelled_class');
    wp_add_dashboard_widget('custom_dashboard_widget5', 'Orders', 'custom_dashboard_orders');
  }
  // Live Classes Dashboard Widget
  function custom_dashboard_live_class(){
    $site_url1 = get_site_url();
    $class_args = array(
      'post_type' => 'product',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      'meta_query'  => array(
        'relation'    => 'AND',
        array(
          'key'   => 'class_date',
          'value'   => date('Ymd'),
          'type'    => 'date',
          'compare' => '>='
        ),
      )
    );
    $class_args1 = new WP_Query($class_args);
    $class_count = $class_args1->found_posts;
    echo '<h1>'.$class_count.'</h1>';
    echo '<h2>Live Classes</h2>';
    echo '<a href="'.$site_url1.'/wp-admin/edit.php?s&post_status=all&post_type=product&action=-1&filter_attendee_id&filter_class_status1=live&product_cat&filter_action=Filter&paged=1&action2=-1">Manage</a>';
  }
  //Course Widget
  function custom_dashboard_courses(){
    $site_url1 = get_site_url();
    $courses_terms = get_terms(
      array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
      )
    );
    $course_count = count($courses_terms);
    echo '<h1>'.$course_count.'</h1>';
    echo '<h2>Courses</h2>';
    echo '<a href="'.$site_url1.'/wp-admin/edit-tags.php?taxonomy=product_cat&post_type=product">Manage</a>';
  }
  //Attendees Dashboard Widget
  function custom_dashboard_attendees(){
    $site_url1 = get_site_url();
    $attendees_args = array(
      'post_type' => 'attendees',
      'posts_per_page' => -1,
      'post_status' => 'publish',
    );
    $attendees_args1 = new WP_Query($attendees_args);
    $attendees_count = $attendees_args1->found_posts;
    echo '<h1>'.$attendees_count.'</h1>';
    echo '<h2>Attendees</h2>';
    echo '<a href="'.$site_url1.'/wp-admin/edit.php?post_type=attendees">Manage</a>';
  }
  //Cancelled Classes Dashboard Widget
  function custom_dashboard_cancelled_class(){
    $site_url1 = get_site_url();
    $cancelled_args = array(
      'post_type' => 'product',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      'meta_query'  => array(
        'relation'    => 'AND',
        array(
          'key'   => 'class_status',
          'value'   => 'Cancel',
          'type'    => 'text',
          'compare' => '='
        ),
      )
    );
    $cancelled_args1 = new WP_Query($cancelled_args);
    $cancelled_count = $cancelled_args1->found_posts;
    echo '<h1>'.$cancelled_count.'</h1>';
    echo '<h2>Cancelled Classes</h2>';
    echo '<a href="'.$site_url1.'/wp-admin/edit.php?s&post_status=all&post_type=product&action=-1&filter_attendee_id&filter_class_status1=Cancel&product_cat&filter_action=Filter&paged=1&action2=-1">Manage</a>';
  }
  //Orders Dashboard Widget
  function custom_dashboard_orders(){
    $site_url1 = get_site_url();
    $args5 = array(
      'post_status' => 'completed',
      'post_type' => 'shop_order',
      'return' => 'ids',
    );
    $orders_count = count(wc_get_orders($args5));
    echo '<h1>'.$orders_count.'</h1>';
    echo '<h2>Orders</h2>';
    echo '<a href="'.$site_url1.'/wp-admin/edit.php?post_type=shop_order">Manage</a>';
  }
?>