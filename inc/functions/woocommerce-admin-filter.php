<?php
/***************************************************
      Remove Custom Filter in Admin Products List
***************************************************/
add_filter( 'woocommerce_products_admin_list_table_filters', 'remove_products_admin_list_table_filters', 10, 1 );
function remove_products_admin_list_table_filters( $filters ){
  // Remove "Product type" dropdown filter
  if( isset($filters['product_type']))
      unset($filters['product_type']);
  // Remove "Product stock status" dropdown filter
  if( isset($filters['stock_status']))
      unset($filters['stock_status']);
  return $filters;
}

/***************************************************
  Add Class City Filter in Admin Products List
***************************************************/
add_action( 'restrict_manage_posts', 'wose45411_admin_posts_filter_restrict_manage_posts4' );
function wose45411_admin_posts_filter_restrict_manage_posts4(){
  $type = 'product';
  if(isset($_GET['post_type'])){
    $type = $_GET['post_type'];
  }
  if('product' == $type){ ?>
    <select name="filter_class_city">
      <option value=""><?php _e('Select City ', 'wose45466'); ?></option>
      <option value="">All</option>
      <?php 
        $vanuesterms = get_terms([
          'taxonomy' => 'Venues',
          'hide_empty' => false,
        ]); 
        foreach($vanuesterms as $vterm){ ?>
          <option value="<?php echo $vterm->term_id; ?>"><?php the_field('city',$vterm); ?></option>
        <?php } 
      ?>
    </select>
   <?php } 
} 
add_filter( 'parse_query', 'wose45466_posts_filter' ); 
function wose45466_posts_filter( $query ){ 
  global $pagenow; 
  $type = 'product'; 
  if(isset($_GET['post_type']) && !empty($_GET['filter_class_city'])){ 
    $type = $_GET['post_type']; 
    $query->query_vars['meta_value'] = $_GET['filter_class_city'];
  } 
}
/***************************************************
  Add Class Status Filter in Admin Products List
***************************************************/
add_action( 'restrict_manage_posts', 'wose45411_admin_posts_filter_restrict_manage_posts3' );
function wose45411_admin_posts_filter_restrict_manage_posts3(){
  $type = 'product';
  if(isset($_GET['post_type'])){
    $type = $_GET['post_type'];
  }
  if('product' == $type){ ?>
    <select name="filter_class_status">
      <option value=""><?php _e('Select Status ', 'wose45455'); ?></option>
      <option value="">All</option>
      <option value="Live">Live</option>
      <option value="Completed">Completed</option>
      <option value="Cancel">Cancel</option>
    </select>
   <?php } 
} 
add_filter( 'parse_query', 'wose45455_posts_filter' ); 
function wose45455_posts_filter( $query ){ 
  global $pagenow; 
  $type = 'product'; 
  if(isset($_GET['post_type']) && !empty($_GET['filter_class_status'])){ 
    $type = $_GET['post_type']; 
    $query->query_vars['meta_value'] = $_GET['filter_class_status'];
  } 
}
/***************************************************
      Add Class ID Filter in Attendees List
***************************************************/
add_action( 'restrict_manage_posts', 'wose454361_admin_posts_filter_restrict_manage_posts1' );
function wose454361_admin_posts_filter_restrict_manage_posts1(){
  $type = 'attendees';
  if(isset($_GET['post_type'])){
    $type = $_GET['post_type'];
  }
  if('attendees' == $type){ ?>
    <select name="filter_class_id" style="display: none;">
      <option value=""><?php _e('Select Class ID ', 'wose454361'); ?></option>
      <?php $current_v = isset($_GET['filter_class_id'])? $_GET['filter_class_id']:''; ?>
      <option value="1657">1657</option>
    </select>
  <?php } 
}

add_filter( 'parse_query', 'wose454361_posts_filter1' ); 
function wose454361_posts_filter1( $query ){ 
  global $pagenow; 
  $type = 'post'; 
  if(isset($_GET['post_type']) && !empty($_GET['filter_class_id'])){ 
    $type = $_GET['post_type']; 
    $query->query_vars['meta_value'] = $_GET['filter_class_id'];
  } 
}
/***************************************************
      Add Attendee ID Filter in Attendees List
***************************************************/
add_action( 'restrict_manage_posts', 'wose45411_admin_posts_filter_restrict_manage_posts' );
function wose45411_admin_posts_filter_restrict_manage_posts(){
  $type = 'product';
  if(isset($_GET['post_type'])){
    $type = $_GET['post_type'];
  }
  if('product' == $type){ ?>
    <select name="filter_attendee_id" style="display: none;">
      <option value=""><?php _e('Select Attendee ID ', 'wose45411'); ?></option>
      <?php $current_v = isset($_GET['filter_attendee_id'])? $_GET['filter_attendee_id']:''; ?>
      <option value="1732">1732</option>
    </select>
   <?php } 
} 
add_filter( 'parse_query', 'wose45411_posts_filter' ); 
function wose45411_posts_filter( $query ){ 
  global $pagenow; 
  $type = 'product'; 
  if(isset($_GET['post_type']) && !empty($_GET['filter_attendee_id'])){ 
    $type = $_GET['post_type']; 
    $query->query_vars['meta_value'] = $_GET['filter_attendee_id'];
  } 
}
/***************************************************
      Add User Email Filter in Attendees List
***************************************************/
add_action( 'restrict_manage_posts', 'wose4541111_admin_posts_filter_restrict_manage_posts' );
function wose4541111_admin_posts_filter_restrict_manage_posts(){
  $type = 'attendees';
  if(isset($_GET['post_type'])){
    $type = $_GET['post_type'];
  }
  if('attendees' == $type){ ?>
    <select name="filter_useremail" style="display: none;">
      <option value=""><?php _e('Select User Email ', 'wose4541111'); ?></option>
      <?php $current_v = isset($_GET['filter_useremail'])? $_GET['filter_useremail']:''; ?>
      <option value="qasid@espinspire.com">qasid@espinspire.com</option>
    </select>
   <?php } 
} 
add_filter( 'parse_query', 'wose4541111_posts_filter' ); 
function wose4541111_posts_filter( $query ){ 
  global $pagenow; 
  $type = 'attendees';
  if(isset($_GET['post_type']) && !empty($_GET['filter_useremail'])){ 
    $type = $_GET['post_type']; 
    $query->query_vars['meta_value'] = $_GET['filter_useremail'];
  } 
}