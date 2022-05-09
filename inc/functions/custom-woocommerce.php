<?php
/***************************************
    Remove Menu in Dashboard
***************************************/
function custom_my_account_menu_items( $items ) {
  unset($items['downloads']);
  unset($items['payment-methods']);
  return $items;
}
add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items' );
/***************************************
    Remove Product Tag in woocommerce
***************************************/
add_action( 'admin_menu', 'misha_hide_product_tags_admin_menu', 9999 );
function misha_hide_product_tags_admin_menu() {
    remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?taxonomy=product_tag&amp;post_type=product' );
}
function plt_hide_woocommerce_menus() {
    //Hide "Tools → Scheduled Actions".
    //remove_submenu_page('tools.php', 'action-scheduler');
    //Hide "WooCommerce".
    //remove_menu_page('woocommerce');
    //Hide "WooCommerce → Home".
    //remove_submenu_page('woocommerce', 'wc-admin');
    //Hide "WooCommerce → Orders".
    //remove_submenu_page('woocommerce', 'edit.php?post_type=shop_order');
    //Hide "WooCommerce → Customers".
    //remove_submenu_page('woocommerce', 'wc-admin&path=/customers');
    //Hide "WooCommerce → Coupons".
    //remove_submenu_page('woocommerce', 'coupons-moved');
    //Hide "WooCommerce → Reports".
    //remove_submenu_page('woocommerce', 'wc-reports');
    //Hide "WooCommerce → Settings".
    //remove_submenu_page('woocommerce', 'wc-settings');
    //Hide "WooCommerce → Status".
    //remove_submenu_page('woocommerce', 'wc-status');
    //Hide "WooCommerce → Extensions".
    //remove_submenu_page('woocommerce', 'wc-addons');
    //Hide "Products".
    //remove_menu_page('edit.php?post_type=product');
    //Hide "Products → All Products".
    //remove_submenu_page('edit.php?post_type=product', 'edit.php?post_type=product');
    //Hide "Products → Add New".
    //remove_submenu_page('edit.php?post_type=product', 'post-new.php?post_type=product');
    //Hide "Products → Categories".
    //remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=product_cat&post_type=product');
    //Hide "Products → Tags".
    //remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=product_tag&post_type=product');
    //Hide "Products → Attributes".
    remove_submenu_page('edit.php?post_type=product', 'product_attributes');
    //Hide "Analytics".
    //remove_menu_page('wc-admin&path=/analytics/overview');
    //Hide "Analytics → Overview".
    //remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/overview');
    //Hide "Analytics → Products".
    //remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/products');
    //Hide "Analytics → Revenue".
    //remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/revenue');
    //Hide "Analytics → Orders".
    //remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/orders');
    //Hide "Analytics → Variations".
    //remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/variations');
    //Hide "Analytics → Categories".
    //remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/categories');
    //Hide "Analytics → Coupons".
    //remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/coupons');
    //Hide "Analytics → Taxes".
    //remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/taxes');
    //Hide "Analytics → Downloads".
    //remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/downloads');
    //Hide "Analytics → Stock".
    //remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/stock');
    //Hide "Analytics → Settings".
    //remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/settings');
    //Hide "Marketing".
    //remove_menu_page('woocommerce-marketing');
    //Hide "Marketing → Overview".
    //remove_submenu_page('woocommerce-marketing', 'admin.php?page=wc-admin&path=/marketing');
    //Hide "Marketing → Coupons".
    //remove_submenu_page('woocommerce-marketing', 'edit.php?post_type=shop_coupon');
}
add_action('admin_menu', 'plt_hide_woocommerce_menus', 71);
/***************************************
    Create Taxonomy in woocommerce
***************************************/
add_action( 'init', 'create_subjects_hierarchical_taxonomy', 0 );
function create_subjects_hierarchical_taxonomy() {
  $labels = array(
    'name' => _x( 'Course Category', 'taxonomy general name' ),
    'singular_name' => _x( 'Course Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Course Categories' ),
    'all_items' => __( 'All Course Categories' ),
    'parent_item' => __( 'Parent Course Categories' ),
    'parent_item_colon' => __( 'Parent Course Categories:' ),
    'edit_item' => __( 'Edit Course Category' ), 
    'update_item' => __( 'Update Course Category' ),
    'add_new_item' => __( 'Add New Course Category' ),
    'new_item_name' => __( 'New Course Category Name' ),
    'menu_name' => __( 'Course Categories' ),
  );    
  register_taxonomy('Course Certifications',array('product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'course_certifications' ),
  ));
}
add_action( 'init', 'create_subjects_hierarchical_taxonomy2', 0 );
function create_subjects_hierarchical_taxonomy2() {
  $labels = array(
    'name' => _x( 'Venues', 'taxonomy general name' ),
    'singular_name' => _x( 'Venues', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Venues' ),
    'all_items' => __( 'All Venues' ),
    'parent_item' => __( 'Parent Venues' ),
    'parent_item_colon' => __( 'Parent Venues:' ),
    'edit_item' => __( 'Edit Venues' ), 
    'update_item' => __( 'Update Venues' ),
    'add_new_item' => __( 'Add New Venues' ),
    'new_item_name' => __( 'New Venues Name' ),
    'menu_name' => __( 'Venues' ),
  );    
  register_taxonomy('Venues',array('product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'venues' ),
  ));
}
/***************************************************
  Custom privacy policy checkbox on checkout page
***************************************************/
add_action('woocommerce_checkout_before_order_review', 'add_my_checkout_tickbox', 9);
function add_my_checkout_tickbox() {
 //you can change the message here just ensure that the formatting is maintained
echo '<p class="terms-checkbox mt-4"> <input type="checkbox" class="input-checkbox" name="deliverycheck" id="deliverycheck" required="required" /> <label for="deliverycheck" class="checkbox">By checking this box you agree to our Terms of Service (Required).</label> </p>';
}
/***************************************************
  Add Custom CSS Class in checkout form
***************************************************/
add_filter('woocommerce_checkout_fields', 'addBootstrapToCheckoutFields' );
function addBootstrapToCheckoutFields($fields) {
  foreach ($fields as &$fieldset) {
    foreach ($fieldset as &$field) {
      $field['class'][] = 'form-group';
      $field['input_class'][] = 'form-control';
    }
  }
  return $fields;
}
/***************************************************
        Change Place Order text on checkout
***************************************************/
add_filter( 'woocommerce_order_button_html', 'misha_custom_button_html' );
function misha_custom_button_html( $button_html ) {
    $button_html = str_replace( 'Place order', 'Confirm Order', $button_html );
    return $button_html;
}
/***************************************************
    Change Continue Shopping text on Cart
***************************************************/
add_filter( 'wc_add_to_cart_message_html', 'my_changed_wc_add_to_cart_message_html', 10, 2 );
function my_changed_wc_add_to_cart_message_html($message, $products){
    if (strpos($message, 'Continue shopping') !== false) {
        $message = str_replace("Continue shopping", "Continue", $message);
    }
    return $message;
}
/***************************************************
    Change 'Return to Shop' text on button
***************************************************/
add_filter('woocommerce_return_to_shop_text', 'prefix_store_button');
function prefix_store_button() {
    $store_button = "Return to Classes";
    return $store_button;
}
/***************************************************
    Shop Page Redirect to Classes Page
***************************************************/
add_action( 'template_redirect', 'custom_shop_page_redirect' );
function custom_shop_page_redirect() {
    if( is_shop() ){
        wp_redirect(get_page_link(579));
        exit();
    }
}
/***************************************************
    lost password redirect
***************************************************/
add_filter( 'lostpassword_url',  'wdm_lostpassword_url', 10, 0 );
function wdm_lostpassword_url() {
    return site_url('/lost-password');
}
/***************************************************
    Remove Additional Information
***************************************************/
add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );
/***************************************************
    Added to Cart Message
***************************************************/
add_filter('wc_add_to_cart_message', 'handler_function_name', 10, 2);
function handler_function_name($message, $product_id) {
  return "The Class has been added to your cart.";
}
/***************************************************
    Remove from Cart Message
***************************************************/
add_filter( 'woocommerce_cart_item_removed_title', 'removed_from_cart_title', 12, 2);
function removed_from_cart_title( $message, $cart_item ) {
    $product = wc_get_product( $cart_item['product_id'] );
    if( $product ){
        $message = sprintf( __('The Class has been removed from cart.'), $product->get_name() );
    }
    return $message;
}
/***************************************************
    Remove from Cart Message
***************************************************/
add_filter( 'woocommerce_cart_item_removed_title', 'removed_from_cart_title1', 12, 2);
function removed_from_cart_title1( $message, $cart_item ) {
  $product = wc_get_product( $cart_item['product_id'] );
  if( $product ){
    $message = sprintf( __('The Class has been removed from cart.'), $product->get_name() );
  }
  return $message;
}
/**********************************************************************
      Complete All Woocommerce Orders
**********************************************************************/
add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) { 
  if ( ! $order_id ) {
    return;
  }
  $order = wc_get_order( $order_id );
  $order->update_status( 'completed' );
}

function wpd_default_title_filter( $post_title, $post ) {
    if( 'product' == $post->post_type ) {
        return $post->ID;
    }
    return $post_title;
}
add_filter( 'default_title', 'wpd_default_title_filter', 20, 2 );
function wpd_default_title_filter2( $post_title, $post ) {
    if( 'attendees' == $post->post_type ) {
        return $post->ID;
    }
    return $post_title;
}
add_filter( 'default_title', 'wpd_default_title_filter2', 20, 2 );
/**********************************************************************
                Cancel Status assign to Class
**********************************************************************/
add_action( 'wp', 'wpse69369_special_thingy' );
function wpse69369_special_thingy(){
    if(is_admin()){
        $today2 = date('Ymd');
        $args5 = array(
            'numberposts' => -1,
            'post_type' => 'product',
            'meta_query'  => array(
                'relation'    => 'AND',
                array(
                  'key'   => 'class_status',
                  'value'   => 'Cancel',
                  'type'    => 'text',
                  'compare' => '!=',
                ),
                array(
                  'key'   => 'class_status',
                  'value'   => 'Completed',
                  'type'    => 'text',
                  'compare' => '!=',
                ),
            ),
        );
        $queryproduct = new WP_Query($args5);
        //echo $queryproduct->found_posts;
        if($queryproduct->have_posts()):
            while($queryproduct->have_posts()) : $queryproduct->the_post(); 
                $cid = get_the_ID();
                $class_status1 = get_field('class_status');
                $class_date1 = get_field('class_date');
                $expire = date("Y-m-d", strtotime($class_date1));
                $today_date = date('Y-m-d');
                if($today_date > $expire){
                    //the_title();
                    //echo '<br>';
                    update_field('class_status', 'Completed', $cid);
                } else {
                    update_field('class_status', 'Live', $cid);
                }
            endwhile;
        endif;
        wp_reset_postdata();
        if(!empty($_GET['class_status']) && !empty($_GET['classid'])){ 
            $classstatus = $_GET['class_status'];
            $classid = $_GET['classid'];
            update_field('class_status', $classstatus, $classid);
        }
    }
}
if(!empty($_GET['class_enroll_id'])){
    $products_list = get_posts([
        'post_type'  => 'product',
        'title' => $_GET['class_enroll_id'],
    ]);
    $productid = $products_list[0]->ID;
    session_start();
    //print_r($products_list);
    $_SESSION['classenrollid'] = $productid;
    $_SESSION['classenrolltitle'] = $_GET['class_enroll_id'];
}
/**********************************************************************
                Enroll an Attendee through backoffice
**********************************************************************/
function afterPostUpdated($post_id, $post){
    if(get_post_type($_GET['post']) == 'attendees'){
        session_start();
        //echo $_SESSION['classenrolltitle'];
        if(!empty($_SESSION['classenrollid'])){
            //echo 'test';
            update_field('class_id', $_SESSION['classenrolltitle'], $_GET['post']);
            $stock_q = $_SESSION['classenrollid'];
            //$product5 = wc_get_product($stock_q);
            $pro_stock5 = get_post_meta( $stock_q, '_stock', true );;
            $final_pro_stock =  $pro_stock5 - 1;
            wc_update_product_stock($_SESSION['classenrollid'], $final_pro_stock);
            $_SESSION['classenrollid'] = '';
            $_SESSION['classenrolltitle'] = '';
        }
    }
}
add_action('updated_post_meta', 'afterPostUpdated', 10, 4);

function my_search_pre_get_posts( $query ) {
   // Verify that we are on the search page that that this came from the event search form
   if($query->query_vars['s'] != '' && is_search()) {
       // If "s" is a positive integer, assume post id search and change the search variables
       if(absint($query->query_vars['s'])) {
           // Set the post id value
           $query->set('p', $query->query_vars['s']);
           // Reset the search value
           $query->set('s', '');
       }
   }
}

// Filter the search page
//add_filter('pre_get_posts', 'my_search_pre_get_posts');


/**************************************************
  Change label of Product Categories
**************************************************/
add_filter( 'woocommerce_taxonomy_args_product_cat', 'custom_wc_taxonomy_args_product_cat' );
function custom_wc_taxonomy_args_product_cat( $args ) {
  $args['label'] = __( 'Courses', 'woocommerce' );
  $args['labels'] = array(
    'name'        => __( 'Courses', 'woocommerce' ),
    'singular_name'   => __( 'Courses', 'woocommerce' ),
    'menu_name'     => _x( 'Courses', 'Admin menu name', 'woocommerce' ),
    'search_items'    => __( 'Search Courses', 'woocommerce' ),
    'all_items'     => __( 'All Courses', 'woocommerce' ),
    'parent_item'     => __( 'Parent Product Category', 'woocommerce' ),
    'parent_item_colon' => __( 'Parent Product Category:', 'woocommerce' ),
    'edit_item'     => __( 'Edit Course', 'woocommerce' ),
    'update_item'     => __( 'Update Course', 'woocommerce' ),
    'add_new_item'    => __( 'Add New Course', 'woocommerce' ),
    'new_item_name'   => __( 'New Course Name', 'woocommerce' )
  );
  return $args;
}
/**************************************************
  Attendee Trash class status update
**************************************************/
add_action( 'wp_trash_post', 'my_wp_trash_post' );
function my_wp_trash_post($post_id){
  $post_type = get_post_type($post_id);
  if($post_type == 'attendees'){
    $attendee_class_title = get_field('class_id',$post_id);
    if(!empty($attendee_class_title)){
      $attendee_classes = get_posts([
          'post_type'  => 'product',
          'title' => $attendee_class_title,
      ]);
      $attendee_class_id = $attendee_classes[0]->ID;
      $class_status_current = get_post_meta($attendee_class_id, '_stock', true);
      $class_status_current = $class_status_current + 1;
      wc_update_product_stock($attendee_class_id, $class_status_current);
    }
  }
}
/**************************************************
  Duplicate Class update status
**************************************************/
//add_action( 'save_post', 'update_product_link', 1, 3 );
// function update_product_link( $post_id, $post, $update ) {
//     if( $post->post_type == "product" ) {
//         $class_date1 = get_field('class_date',$post_id);
//         $expire = date("Y-m-d", strtotime($class_date1));
//         $today_date = date('Y-m-d');
//         if($today_date < $expire){
//             update_field('class_status', 'Live', $post_id);
//         } else {
//             update_field('class_status', 'Completed', $post_id);
//         }
//     }
// }

add_action( 'save_post', 'my_save_post_function', 10, 3 );
function my_save_post_function( $post_ID, $post, $update ) {
    if( $post->post_type == "product" ) {
        $class_date1 = get_field('class_date',$post_id);
        $expire = date("Y-m-d", strtotime($class_date1));
        $today_date = date('Y-m-d');
        if($today_date < $expire){
            update_field('class_status', 'Live', $post_id);
        } else {
            update_field('class_status', 'Completed', $post_id);
        }
    }
}
/**************************************************
  By Default Enable Manage Stock Option in Admin
**************************************************/
$postType = "product";
add_action("save_post_" . $postType, function ($post_ID, \WP_Post $post, $update) {
  if(!$update){
  update_post_meta($post->ID, "_manage_stock", "yes");
      update_post_meta($post->ID, "_stock", 1);
    return;
  }
}, 10, 3);



function my_account_menu_order() {
  $menuOrder = array(
    'dashboard'          => __( 'Dashboard', 'woocommerce' ),
    'orders'             => __( 'Orders', 'woocommerce' ),
    //'subscriptions'          => __( 'subscriptions', 'woocommerce' ),
    'edit-address'      => __( 'Address', 'woocommerce' ),
    'edit-account'      => __( 'My Account', 'woocommerce' ),
    //'payment-methods'       => __( 'Payment Methods', 'woocommerce' ),
    'customer-logout'    => __( 'Logout', 'woocommerce' ),
  );
  return $menuOrder;
}
add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );
?>