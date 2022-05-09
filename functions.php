<?php
get_template_part( 'inc/functions/register-post-types' );
get_template_part( 'inc/functions/custom-woocommerce' );
get_template_part('inc/functions/woocommerce-custom-checkout-fields');
get_template_part('inc/functions/woocommerce-admin-columns');
get_template_part('inc/functions/woocommerce-admin-filter');
get_template_part('inc/functions/dashboard-widgets');

/**************************************************
            Declare WooCommerce support
**************************************************/
add_theme_support( 'woocommerce' );
/**************************************************
                REMOVE ADMIN MENU
**************************************************/
function remove_menus(){
  // remove_menu_page( 'index.php' );               //Dashboard
  remove_menu_page( 'edit.php' );    
  // remove_menu_page( 'upload.php' );              //Media
  remove_menu_page( 'edit-comments.php' );          //Comments
  // remove_menu_page( 'plugins.php' );             //Plugins
  // remove_menu_page( 'users.php' );               //Users
  //remove_menu_page( 'tools.php' );                  //Tools
  // remove_menu_page( 'options-general.php' );     //Settings
}
add_action( 'admin_menu', 'remove_menus' );
/**************************************************
            REGISTER HEADER AND FOOTER
**************************************************/
register_nav_menus( array(
  'header'  => __( 'Header', 'accenv' ),
  'footer1'  => __( 'Footer Menu1', 'accenv' ),
  'footer2'  => __( 'Footer Menu2', 'accenv' ),
  'footer3'  => __( 'Footer Menu3', 'accenv' ),
  'services-sidebar'  => __( 'Services Sidebar', 'accenv' ),
) );
add_theme_support( 'menus' );
/**************************************************
            Add Class in Menu
**************************************************/
function my_walker_nav_menu_start_el($item_output, $item, $depth, $args) {
  if ( $depth == 0 && 'header' == $args->theme_location ) {
    $item_output = preg_replace('/<a /', '<a class="nav-link" ', $item_output, 1);
  }
  return $item_output;
}
add_filter('walker_nav_menu_start_el', 'my_walker_nav_menu_start_el', 10, 4);
/**************************************************
            ACF THEME SETTINGS PAGE
**************************************************/
if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
      'page_title' => 'Theme General Settings',
      'menu_title' => 'Theme Settings',
      'menu_slug' => 'theme-general-settings',
      'capability' => 'edit_posts',
      'redirect' => false
  ));
}
/**************************************************
          Span option enabled in editor
**************************************************/
function override_mce_options($initArray)
{
  $opts = '*[*]';
  $initArray['valid_elements'] = $opts;
  $initArray['extended_valid_elements'] = $opts;
  return $initArray;
 }
 add_filter('tiny_mce_before_init', 'override_mce_options');
/**************************************************
      add class in image uploading in editor
**************************************************/
function nddt_add_class_to_images($class){
    $class .= ' img-fluid';
    return $class;
}
add_filter('get_image_tag_class','nddt_add_class_to_images');
/**************************************************
          removing default submit tag
**************************************************/
remove_action('wpcf7_init', 'wpcf7_add_form_tag_submit');
/**************************************************
adding action with function which handles our button markup
**************************************************/
add_action('wpcf7_init', 'twentysixteen_child_cf7_button');
/**************************************************
        adding out submit button tag
**************************************************/
if (!function_exists('twentysixteen_child_cf7_button')) {
  function twentysixteen_child_cf7_button() {
    wpcf7_add_form_tag('submit', 'twentysixteen_child_cf7_button_handler');
  }
}
/**************************************************
      out button markup inside handler
**************************************************/
if (!function_exists('twentysixteen_child_cf7_button_handler')) {
  function twentysixteen_child_cf7_button_handler($tag) {
    $tag = new WPCF7_FormTag($tag);
    $class = wpcf7_form_controls_class($tag->type);
    $atts = array();
    $atts['class'] = $tag->get_class_option($class);
    $atts['class'] .= ' twentysixteen-child-custom-btn';
    $atts['id'] = $tag->get_id_option();
    $atts['tabindex'] = $tag->get_option('tabindex', 'int', true);
    $value = isset($tag->values[0]) ? $tag->values[0] : '';
    if ($value == 'Submit') {
      $atts['type'] = 'Submit';
      $atts = wpcf7_format_atts($atts);
      $html = sprintf('<button class="btn btn-primary">Submit</button>', $atts, $value);
    } else {
      $atts['type'] = 'Submit';
      $atts = wpcf7_format_atts($atts);
      $html = sprintf('<button class="btn-primary black">Submit</button>', $atts, $value);
    }
    return $html;
  }
}
/**************************************************
              Custom Admin Css & JS
**************************************************/
add_action('admin_head', 'customAdmin');
function customAdmin() {
  $siteurl = get_settings('siteurl');
  $admin_css_url = $siteurl.'/wp-content/themes/accenv/css/wp-admin.css';
  $admin_js_url = $siteurl.'/wp-content/themes/accenv/js/wp-admin.js';
  echo '<link rel="stylesheet" href="'.$admin_css_url.'">';
  echo '<script type="text/javascript" src="'.$admin_js_url.'"></script>';
}
/**************************************************
    Limit Wordpress Search to specific posttype
**************************************************/
function searchfilter($query) {
  if ($query->is_search && !is_admin() ) {
    $query->set('post_type',array('product','page'));
    //$query->set('post_type',array('product'));
  }
  return $query;
}
add_filter('pre_get_posts','searchfilter');
/**************************************************
  SORT WORDPRESS SEARCH BY CUSTOM POST TYPE ORDER
**************************************************/
add_filter( 'the_posts', function( $posts, $q ) {
  if( $q->is_main_query() && $q->is_search() ) {
    usort( $posts, function( $a, $b ){
      $post_types = [
        'product' => 1,
        'news'    => 2,
        'page'    => 3
      ];              
      if ( $post_types[$a->post_type] != $post_types[$b->post_type] ) {
        return $post_types[$a->post_type] - $post_types[$b->post_type];
      } else {
        return $a->post_date < $b->post_date; // Change to > if you need oldest posts first
      }
    });
  }
  return $posts;
}, 10, 2 );
/**************************************************
  Admin redirects for cpt and taxonomies
**************************************************/
add_action( 'template_redirect', function() {
  if(is_singular('attendees') || is_singular('supervisors') || is_tax('product_cat')){
    global $post;
    $redirectLink = get_home_url();
    wp_redirect( $redirectLink, 302 );
    exit;
  }
});
/**************************************************
    Attendee Course title with id
**************************************************/
add_filter('enter_title_here', 'my_title_place_holder' , 20 , 2 );
function my_title_place_holder($title , $post){
  if($post->post_type == 'attendees'){
    $attendee_class_title = $_GET['class_enroll_id'];
    $attendee_class_object = get_page_by_title($attendee_class_title,null,'product');
    $attendee_class_id = $attendee_class_object->ID;
    $product = wc_get_product($attendee_class_id);
    $course_id = get_field('course',$attendee_class_id);
    $course_date1 = get_field('class_date',$attendee_class_id);
    $course_date = date("Y-m-d", strtotime($course_date1));
    $attendee_id = $post->ID;
    $course_title = get_term($course_id)->name;
    if(!empty($course_title)){
      echo '<strong style="display:block;">('.$course_title.' - Initial class dated '.$course_date.')</strong>';
    }
    return $my_title;
  }
}
/**************************************************
Enable font size & font family selects in the editor
**************************************************/
if ( ! function_exists( 'wpex_mce_buttons' ) ) {
  function wpex_mce_buttons( $buttons ) {
    array_unshift( $buttons, 'fontsizeselect' );
    return $buttons;
  }
}
add_filter( 'mce_buttons_2', 'wpex_mce_buttons' );
// Customize mce editor font sizes
if ( ! function_exists( 'wpex_mce_text_sizes' ) ) {
  function wpex_mce_text_sizes( $initArray ){
    $initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";
    return $initArray;
  }
}
add_filter( 'tiny_mce_before_init', 'wpex_mce_text_sizes' );
/**************************************************
    Custom User Role
**************************************************/
add_action('init', 'cloneRole');
function cloneRole() {
  $adm = get_role('administrator');
  $adm_cap= array_keys( $adm->capabilities ); //get administator capabilities
  add_role('new_role', 'Administrator2'); //create new role
  $new_role = get_role('new_role');
  foreach ( $adm_cap as $cap ) {
    $new_role->add_cap( $cap ); //clone administrator capabilities to new role
  }
}
/**************************************************
    custom Messages for CPT
**************************************************/
add_filter( 'post_updated_messages', 'attendee_cpt_messages' );
function attendee_cpt_messages( $messages ) {
  $post             = get_post();
  $post_type        = get_post_type( $post );
  $post_type_object = get_post_type_object( $post_type );

  $messages['attendees'] = array(
    0  => '', // Unused. Messages start at index 1.
    1  => __( 'Attendee updated.', 'textdomain' ),
    2  => __( 'Custom field updated.', 'textdomain' ),
    3  => __( 'Custom field deleted.', 'textdomain' ),
    4  => __( 'Attendee updated.', 'textdomain' ),
    5  => isset( $_GET['revision'] ) ? sprintf( __( 'attendee restored to revision from %s', 'textdomain' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6  => __( 'Attendee Created.', 'textdomain' ),
    7  => __( 'Attendee saved.', 'textdomain' ),
    8  => __( 'Attendee submitted.', 'textdomain' ),
    9  => sprintf(
        __( 'Attendee scheduled for: <strong>%1$s</strong>.', 'textdomain' ),
        date_i18n( __( 'M j, Y @ G:i', 'textdomain' ), strtotime( $post->post_date ) )
    ),
    10 => __( 'Attendee draft updated.', 'textdomain' )
  );

  if ( $post_type_object->publicly_queryable ) {
    $permalink = get_permalink( $post->ID );
    // $view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View Attendee', 'textdomain' ) );
    $messages[ $post_type ][1] .= $view_link;
    $messages[ $post_type ][6] .= $view_link;
    $messages[ $post_type ][9] .= $view_link;

    $preview_permalink = add_query_arg( 'preview', 'true', $permalink );
    $preview_link      = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview book', 'textdomain' ) );
    $messages[ $post_type ][8] .= $preview_link;
    $messages[ $post_type ][10] .= $preview_link;
  }
  return $messages;
}

/**************************************************
    Attendess Wordpress admin search expand
**************************************************/
function custom_search_query( $query ) {
  if(is_admin() && $_GET['post_type'] == 'attendees'){
    $custom_fields = array(
      "first_name",
      "last_name",
      "email",
      "company"
    );
    $searchterm = $query->query_vars['s'];
    $query->query_vars['s'] = "";
    if($searchterm != ""){
        $meta_query = array('relation' => 'OR');
        foreach($custom_fields as $cf) {
          array_push($meta_query, array(
              'key' => $cf,
              'value' => $searchterm,
              'compare' => 'LIKE'
          ));
        }
        $query->set("meta_query", $meta_query);
    };
  }
}
add_filter( "pre_get_posts", "custom_search_query");

?>
