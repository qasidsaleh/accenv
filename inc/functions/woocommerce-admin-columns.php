<?php
/***************************************************
    Remove Admin Columns in Products List
***************************************************/
add_filter( 'manage_edit-product_columns', 'change_columns_filter',10, 1 );
function change_columns_filter( $columns ) {
  	unset($columns['product_tag']);
  	unset($columns['sku']);
  	unset($columns['featured']);
  	unset($columns['product_type']);
  	unset($columns['date']);
  	unset($columns['taxonomy-Course Certifications']);
  	unset($columns['taxonomy-Venues']);
  	unset($columns['stock']);
	return $columns;
}
add_filter('manage_product_posts_columns', function($columns) {
  $columns['product_cat'] = __('Course', 'textdomain');
  return $columns;
});
/***************************************************
    Add Admin Columns in Products List
***************************************************/
add_filter( 'manage_edit-product_columns', 'bbloomer_admin_products_visibility_column', 9999 );
function bbloomer_admin_products_visibility_column( $columns ){
  	$columns['Class Status'] = 'Status';
  	$columns['Class Date'] = 'Date';
  	$columns['Class Time'] = 'Time';
  	$columns['Class City'] = 'City';
    $columns['Number Of Class Days'] = 'Number Of Class Days';
    $columns['Sale Ends Before (Days)'] = 'Registration Deadline Before (Days)';
  	$columns['Class Cost'] = 'Cost';
    $columns['Class Capacity'] = 'Capacity';
  	return $columns;
}
add_action( 'manage_product_posts_custom_column', 'bbloomer_admin_products_visibility_column_content', 10, 2 );
function bbloomer_admin_products_visibility_column_content( $column, $product_id ){
	$product = wc_get_product($product_id);
  $product_title = $product->get_title();
  $pro_stock1 = $product->get_stock_quantity();
	$classdate2 = get_field('class_date',$product_id);
  $course_id = get_field('course',$product_id);
  $course_title = get_term($course_id)->name;
  $venue_id = get_field('venue',$product_id);
  $venue_object = get_term($venue_id, 'Venues' );
  $venue_city = get_field('city',$venue_object);
	$today_2 = date("Y-m-d");
  if($column == 'name'){
    echo date("d-m-Y", strtotime($classdate2)).' - '.$venue_city.' - '.$course_title;
  }
	if($column == 'Class City'){
  	echo $venue_city;
	}
	if($column == 'Class Date'){
  	echo date("Y-m-d", strtotime($classdate2));
	}
	if($column == 'Class Time'){
  	$classstartime2 = get_field('class_start_time',$product_id);
  	$classendtime2 = get_field('class_end_time',$product_id);
  	echo date("g:ia", strtotime($classstartime2)).' to '.date("g:ia", strtotime($classendtime2));
	}
	if($column == 'Class Cost'){
  	echo '$'.$product->get_price();
	}
	if($column == 'Class Status'){
  	$date_2 = date("Y-m-d", strtotime($classdate2));
  	$cancel_status = get_field('class_status',$product_id);
  	if($cancel_status == 'Cancel'){
  		echo 'Cancel';
  	} else {
    	if($today_2 < $date_2 || $today_2 == $date_2){
      		echo 'Live';
    	} else if($today_2 > $date_2){
      		echo 'Completed';
    	}
		}
  }
  if($column == 'Number Of Class Days'){
    echo get_field('number_of_class_days',$product_id);
  }
  if($column == 'Sale Ends Before (Days)'){
    echo get_field('sale_ends_before_days',$product_id);
  }
  if($column == 'Class Capacity'){
    $query_args1 = array(
      'post_type'  => 'attendees',
      'meta_query' => array(
          array(
          'key'   => 'class_id',
          'value' => $product_title,
          ),
      )
    );
    $query = new WP_Query( $query_args1 );
    $pro_stock = $pro_stock1 + $query->post_count;
    echo 'Enrolled: '.$query->post_count;
    echo '<br>';
    if($pro_stock1 > 0){
      echo 'Total: '.$pro_stock;
    } else {
      echo 'Total: '.$query->post_count;
    }
  }
}
/***************************************************
    Add Admin Columns in Attendees List
***************************************************/
add_filter('the_title', 'my_meta_on_title',10, 2);
function my_meta_on_title($title, $id) {
  if('attendees' == get_post_type($id)) {
    $t = get_field('first_name',$id).' '.get_field('last_name',$id);
    return $t;
  }
  else {
    return $title;
  }
}
add_filter( 'manage_edit-attendees_columns', 'bbloomer_admin_attendees_visibility_column', 9999 );
function bbloomer_admin_attendees_visibility_column( $columns ){
    $columns['First Name'] = 'First Name';
    $columns['Last Name'] = 'Last Name';
    $columns['Email'] = 'Email';
    $columns['Company'] = 'Company';
    $columns['Enrollments'] = 'Enrollments';
    return $columns;
}
add_action( 'manage_attendees_posts_custom_column', 'bbloomer_admin_attendees_visibility_column_content', 10, 2 );
function bbloomer_admin_attendees_visibility_column_content( $column, $product_id ){
  if($column == 'First Name'){
    echo get_field('first_name',$product_id);
  }
  if($column == 'Last Name'){
    echo get_field('last_name',$product_id);
  }
  if($column == 'Email'){
    echo get_field('email',$product_id);
  }
  if($column == 'Company'){
    echo get_field('company',$product_id);
  }
  if($column == 'Enrollments'){ ?>
    <a href="<?php echo get_home_url(); ?>/wp-admin/edit.php?s=<?php echo get_field('class_id',$product_id); ?>&post_status=all&post_type=product&action=-1&filter_attendee_id&product_cat&paged=1&action2=-1" class="button">View Enrollments</a>
  <?php }
}
/***************************************************
    Add Admin Columns in Supervisors List
***************************************************/
add_filter( 'manage_edit-supervisors_columns', 'bbloomer_admin_supervisors_visibility_column', 9999 );
function bbloomer_admin_supervisors_visibility_column( $columns ){
    $columns['Name'] = 'Full Name';
    $columns['Email'] = 'Email';
    return $columns;
}
add_action( 'manage_supervisors_posts_custom_column', 'bbloomer_admin_supervisors_visibility_column_content', 10, 2 );
function bbloomer_admin_supervisors_visibility_column_content( $column, $product_id ){
  if($column == 'Name'){
    echo get_field('supervisor_name',$product_id);
  }
  if($column == 'Email'){
    echo get_field('supervisor_email',$product_id);
  }
}
/***************************************************
    Sort Admin Columns in Products List
***************************************************/
// add_filter( 'manage_edit-product_sortable_columns', 'bbloomer_admin_products_visibility_column_sortable' ); 
// function bbloomer_admin_products_visibility_column_sortable( $columns ){
//   $columns['Class Status'] = 'Status';
//   $columns['Class Date'] = 'Date';
//   $columns['Class Time'] = 'Time';
//   $columns['Class City'] = 'City';
//   $columns['Class Cost'] = 'Cost';
//   return $columns;
// }
/***************************************************
    Admin Columns in Orders List
***************************************************/
add_filter( 'manage_edit-shop_order_columns', 'custom_shop_order_column', 20 );
function custom_shop_order_column($columns){
  $reordered_columns = array();
  // Inserting columns to a specific location
  foreach( $columns as $key => $column){
    $reordered_columns[$key] = $column;
    if($key ==  'order_status'){
      // Inserting after "Status" column
      $reordered_columns['first_name'] = __( 'First Name','theme_domain');
      $reordered_columns['last_name'] = __( 'Last Name','theme_domain');
      $reordered_columns['email'] = __( 'Email','theme_domain');
      $reordered_columns['company'] = __( 'Company','theme_domain');
    }
  }
  return $reordered_columns;
}
add_action( 'manage_shop_order_posts_custom_column' , 'custom_orders_list_column_content', 20, 2 );
function custom_orders_list_column_content($column, $post_id){
  $order = new WC_Order($post_id);
  switch($column){
    case 'first_name':
      $order_first_name = $order->get_billing_first_name();
      if(!empty($order_first_name)){
        echo $order_first_name;
        break;
      }
    case 'last_name' :
      $order_last_name = $order->get_billing_last_name();
      if(!empty($order_last_name)){
        echo $order_last_name;
        break;
      }
    case 'email' :
      $order_email = $order->get_billing_email();
      if(!empty($order_email)){
        echo $order_email;
        break;
      }
    case 'company' :
      $order_company = $order->get_billing_company();
      if(!empty($order_company)){
        echo $order_company;
        break;
      }
    break;
  }
}
/***************************************************
    Add Row actions in admin Products List
***************************************************/
add_filter('post_row_actions','my_action_row', 10, 2);
function my_action_row($actions, $post){
    $postid =  $post->ID;
    $posttitle = $post->post_title;
    if ($post->post_type =="product"){
      $class_s2 = get_field('class_status',$postid);
      $classd2 = get_field('class_date',$postid);
      $class_sale_end_days = get_field('sale_ends_before_days',$postid);
      $expire_date1 = date("Y-m-d", strtotime($classd2));
      $expire_date2 = new DateTime($expire_date1);
      $expire_date2->modify("-".$class_sale_end_days." day");
      $expire_date_d = $expire_date2->format("Ymd");
      $post1 = wc_get_product($postid);
      $post1_stock = $post1->get_stock_quantity();
      if($class_s2 != 'Cancel' && $class_s2 != 'Completed'){
        $actions['reschedule'] = '<a href="'.get_home_url().'/wp-admin/post.php?post='.$postid.'&action=edit">Reschedule</a>';
      }
      if($class_s2 != 'Cancel'){
        $actions['cancel'] = '<a href="'.get_home_url().'/wp-admin/edit.php?post_type=product&class_status=Cancel&classid='.$postid.'">Cancel</a>';
      }
      $actions['view-enrollments'] = '<a href="'.get_home_url().'/wp-admin/edit.php?s&post_status=all&post_type=attendees&action=-1&m=0&filter_class_id='.$posttitle.'&filter_action=Filter&paged=1&action2=-1">View Enrollments</a>';
      $todayd2 = date("Ymd");
      $dated2 = date("Ymd", strtotime($classd2));
      if(($todayd2 < $dated2 || $todayd2 == $dated2) && $class_s2 != 'Cancel'  && $post1_stock > 0){
        $actions['enroll-attendee'] = '<a href="'.get_home_url().'/wp-admin/post-new.php?post_type=attendees&class_enroll_id='.$posttitle.'&attendee_quantity=1">Enroll an Attendee</a>';
      }
      if($todayd2 == $dated2){
        unset($actions['edit']);
        unset($actions['trash']);
        unset($actions['reschedule']);
        unset($actions['cancel']);
      }
      if($class_s2 == 'Cancel' || $class_s2 == 'Completed'){
        unset($actions['edit']);
        //unset($actions['trash']);
        unset($actions['reschedule']);
      }
      if(($expire_date_d < $todayd2 || $expire_date_d == $todayd2) && !empty($class_sale_end_days)){
        unset($actions['edit']);
        unset($actions['reschedule']);
        unset($actions['cancel']);
        unset($actions['trash']);
      }
      if($class_s2 == 'Completed'){
        unset($actions['cancel']);
      }
      unset($actions['inline hide-if-no-js']);
    }
    return $actions;
}
/***************************************************
    Add Row actions in admin Users List
***************************************************/
//add_filter( 'user_row_actions', 'my_user_row_actions', 10, 2 );
function my_user_row_actions( $actions, $user_object ) {
  $userid = $user_object->ID;
  $user = get_user_by( 'id', $userid );
  $user_email = $user->user_email;
  //print("<pre>");print_r($user_object);print("</pre>");
  //unset( $actions['edit'] );
  // Add your custom action.
  $actions['users_enrollments'] = '<a href="'.get_home_url().'/wp-admin/edit.php?s&post_status=all&post_type=attendees&action=-1&m=0&filter_class_id&filter_useremail='.$user_email.'&filter_action=Filter&paged=1&action2=-1">View Enrollments</a>';
  return $actions;
}
?>