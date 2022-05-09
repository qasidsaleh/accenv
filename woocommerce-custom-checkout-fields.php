<?php
/********************************************************
  Custom WooCommerce Checkout Fields based on Quantity
********************************************************/
add_action( 'woocommerce_before_order_notes', 'person_details' );
function person_details($checkout) {
  global $woocommerce;
  $count = $woocommerce->cart->cart_contents_count;
  print ('<h3>ATTENDEE INFORMATION</h3>');
  $i = 0;
  for($k=1; $k<= $count; $k++){
    $i++;
    $attendee_first_name = 'Attendee '.$i.' - First Name';
    $attendee_last_name = 'Attendee '.$i.' - Last Name';
    $attendee_email_name = 'Attendee '.$i.' - Email';
    woocommerce_form_field( 'cstm_first_name'.$i, array(
      'type'          => 'text',
      'class'         => array('my-field-class form-row-wide attendee-info'),
      'label'         => __($attendee_first_name),
      'required' => 'true',
    ),
    $checkout->get_value( 'cstm_first_name'.$i ));
    echo '<div class="clear"></div>';
    woocommerce_form_field( 'cstm_last_name'.$i, array(
      'type'          => 'text',
      'class'         => array('my-field-class form-row-wide attendee-info'),
      'label'         => __($attendee_last_name),
      'required' => 'true',
    ),
    $checkout->get_value( 'cstm_last_name'.$i ));
    woocommerce_form_field( 'cstm_email'.$i, array(
      'type'          => 'email',
      'class'         => array('my-field-class form-row-wide attendee-info'),
      'label'         => __($attendee_email_name),
      'required' => 'true',
    ),
    $checkout->get_value( 'cstm_email'.$i ));
    echo '<div class="clear"></div>';
    echo '<div class="mb-4"></div>';
  }
  $supervisor_name = 'Approving Supervisor Name<a href="#" id="show_sv_info">(?)</a><span class="show_sv_content removed">Please provide the name of the person that approved this purchase. If it was yourself (i.e. you do not have a supervisor) these fields can be left blank.</span>';
  $supervisor_email = 'Approving Supervisor Email';
  $ordernotes = 'Do you have any special requests or notes for this order?:';
  woocommerce_form_field( 'cstm_supervisor_name', array(
    'type'          => 'text',
    'class'         => array('my-field-class form-row-wide attendee-info'),
    'label'         => __($supervisor_name),
  ),
  $checkout->get_value( 'cstm_supervisor_name'));
  woocommerce_form_field( 'cstm_supervisor_email', array(
    'type'          => 'email',
    'class'         => array('my-field-class form-row-wide attendee-info'),
    'label'         => __($supervisor_email),
  ),
  $checkout->get_value( 'cstm_supervisor_email'));
  woocommerce_form_field( 'cstm_supervisor_notes', array(
    'type'          => 'textarea',
    'class'         => array('my-field-class form-row-wide attendee-info'),
    'label'         => __($ordernotes),
  ),
  $checkout->get_value( 'cstm_supervisor_notes'));
}
/********************************************************
        For data validation of the custom field.
********************************************************/
add_action('woocommerce_checkout_process', 'customise_checkout_field_process');
function customise_checkout_field_process() {
  global $woocommerce;
  $count = $woocommerce->cart->cart_contents_count;
  $i = 0;
  for($k=1; $k<= $count; $k++) {
    $i++;
    // if the field is set, if not then show an error message.
    if(!$_POST['cstm_first_name'.$i]) wc_add_notice(__('<strong>First Name of Attendee '.$i.'</strong> is a required field.') , 'error');
    if(!$_POST['cstm_last_name'.$i]) wc_add_notice(__('<strong>Last Name of Attendee '.$i.'</strong> is a required field.') , 'error');
    if(!$_POST['cstm_email'.$i]) wc_add_notice(__('<strong>Email of Attendee '.$i.'</strong> is a required field.') , 'error');
  }  
}
/********************************************************
Save Custom WooCommerce Checkout Fields based on Quantity
********************************************************/
add_action('woocommerce_checkout_update_order_meta', 'customise_checkout_field_update_order_meta');
function customise_checkout_field_update_order_meta($order_id) {
  global $woocommerce;
  $count = $woocommerce->cart->cart_contents_count;
  $i = 0;
  for($k=1; $k<= $count; $k++){
    $i++;
    if (!empty($_POST['cstm_first_name'.$i])) {
      update_post_meta($order_id, 'First Name of Attendee'.$i, sanitize_text_field($_POST['cstm_first_name'.$i]));
    }
    if (!empty($_POST['cstm_last_name'.$i])) {
      update_post_meta($order_id, 'Last Name of Attendee'.$i, sanitize_text_field($_POST['cstm_last_name'.$i]));
    }
    if (!empty($_POST['cstm_email'.$i])) {
      update_post_meta($order_id, 'Email of Attendee'.$i, sanitize_text_field($_POST['cstm_email'.$i]));
    }
  }
  if (!empty($_POST['cstm_supervisor_name'])) {
    update_post_meta($order_id, 'Approving Supervisor Name', sanitize_text_field($_POST['cstm_supervisor_name']));
  }
  if (!empty($_POST['cstm_supervisor_email'])) {
    update_post_meta($order_id, 'Approving Supervisor Email', sanitize_text_field($_POST['cstm_supervisor_email']));
  }
  if (!empty($_POST['cstm_supervisor_notes'])) {
    update_post_meta($order_id, 'Special Requests', sanitize_text_field($_POST['cstm_supervisor_notes']));
  }
}
/********************************************************
Show Custom WooCommerce Checkout Fields on Thanks Page
********************************************************/
function cloudways_display_order_data( $order_id ){  ?>
  <h2><?php _e( 'ATTENDEE INFORMATION' ); ?></h2>
  <table class="shop_table shop_table_responsive additional_info">
      <tbody>
        <?php
        $order = wc_get_order( $order_id );
        $count = $order->get_item_count();
        $i = 0;
        for($k=1; $k<=$count; $k++){
          $i++; ?>
          <tr>
            <th><?php _e( 'First Name of Attendee'.$i ); ?></th>
            <td data-title="<?php _e( 'First Name of Attendee'.$i ); ?>">
              <?php 
                $fattendee = get_post_meta($order_id, 'First Name of Attendee'.$i, sanitize_text_field($_POST['cstm_first_name'.$i])); 
                echo $fattendee[0];
              ?>
            </td>
          </tr>
          <tr>
            <th><?php _e( 'Last Name of Attendee'.$i ); ?></th>
            <td data-title="<?php _e( 'Last Name of Attendee'.$i ); ?>">
              <?php
                $lattendee = get_post_meta($order_id, 'Last Name of Attendee'.$i, sanitize_text_field($_POST['cstm_last_name'.$i]));
                echo $lattendee[0];
              ?>
            </td>
          </tr>
          <tr>
            <th><?php _e( 'Email of Attendee'.$i ); ?></th>
            <td data-title="<?php _e( 'Email of Attendee'.$i ); ?>">
              <?php 
                $eattendee = get_post_meta($order_id, 'Email of Attendee'.$i, sanitize_text_field($_POST['cstm_email'.$i]));
                echo $eattendee[0];
              ?>
            </td>
          </tr>
        <?php 
          //Create attendee in admin and add acf data
          $firstname = $fattendee[0];
          $lastname = $lattendee[0];
          $email = $eattendee[0];
          $post_id = wp_insert_post(
            array(
              'post_title'    => $firstname.' '.$lastname,
              'post_status'   => 'publish',
              'post_type'   => 'attendees'
            )
          );
          update_field('first_name', $firstname, $post_id);
          update_field('last_name', $lastname, $post_id);
          update_field('email', $email, $post_id);
        } ?>
        <tr>
          <th><?php _e( 'Approving Supervisor Name' ); ?></th>
          <td data-title="<?php _e( 'Approving Supervisor Name' ); ?>">
            <?php 
              $supervisorname = get_post_meta($order_id, 'Approving Supervisor Name', sanitize_text_field($_POST['cstm_supervisor_name'])); 
              echo $supervisorname[0];
            ?>
          </td>
        </tr>
        <tr>
          <th><?php _e( 'Approving Supervisor Email' ); ?></th>
          <td data-title="<?php _e( 'Approving Supervisor Email' ); ?>">
            <?php 
              $supervisoremail = get_post_meta($order_id, 'Approving Supervisor Email', sanitize_text_field($_POST['cstm_supervisor_email']));
              echo $supervisoremail[0];
            ?>
          </td>
        </tr>
        <tr>
          <th><?php _e( 'Special Requests' ); ?></th>
          <td data-title="<?php _e( 'Special Requests' ); ?>">
            <?php 
              $supervisornotes = get_post_meta($order_id, 'Special Requests', sanitize_text_field($_POST['cstm_supervisor_notes']));
              echo $supervisornotes[0];
            ?>
          </td>
        </tr>
        <?php
          //Create supervisor in admin and add acf data
          $supname = $supervisorname[0];
          $supemail = $supervisoremail[0];
          $post_id = wp_insert_post(
            array(
              'post_title'    => $supname,
              'post_status'   => 'publish',
              'post_type'   => 'supervisors'
            )
          );
          update_field('supervisor_name', $supname, $post_id);
          update_field('supervisor_email', $supemail, $post_id);
          update_field('email', $email, $post_id);
        ?>
      </tbody>
  </table>
<?php }
add_action( 'woocommerce_thankyou', 'cloudways_display_order_data', 20 );
add_action( 'woocommerce_view_order', 'cloudways_display_order_data', 20 );
/***********************************************************************
Save Custom WooCommerce Checkout Fields based on Quantity in admin order
************************************************************************/
function cloudways_display_order_data_in_admin( $order ){  ?>
  <div class="order_data_column">
    <h4><?php _e( 'ATTENDEE INFORMATION', 'woocommerce' ); ?>
      <a href="#" class="edit_address"><?php _e( 'Edit', 'woocommerce' ); ?></a>
    </h4>
    <div class="address">
      <?php 
        $order_id = $order->get_id();
        $count = $order->get_item_count();
        $i = 0;
        for($k=1; $k<= $count; $k++){
          $i++;
          $order_afname = get_post_meta($order_id, 'First Name of Attendee'.$i, sanitize_text_field($_POST['cstm_first_name'.$i]));
          $order_alname = get_post_meta($order_id, 'Last Name of Attendee'.$i, sanitize_text_field($_POST['cstm_last_name'.$i]));
          $order_aemail = get_post_meta($order_id, 'Email of Attendee'.$i, sanitize_text_field($_POST['cstm_email'.$i]));
          $order_sn = get_post_meta($order_id, 'Approving Supervisor Name', sanitize_text_field($_POST['cstm_supervisor_name']));
          $order_se = get_post_meta($order_id, 'Approving Supervisor Email', sanitize_text_field($_POST['cstm_supervisor_email']));
          $order_sr = get_post_meta($order_id, 'Special Requests', sanitize_text_field($_POST['cstm_supervisor_notes']));

          echo '<p><strong>' . __( 'First Name of Attendee'.$i ) . ':</strong>' . $order_afname[0] . '</p>';
          echo '<p><strong>' . __( 'Last Name of Attendee'.$i ) . ':</strong>' . $order_alname[0] . '</p>';
          echo '<p><strong>' . __( 'Email of Attendee'.$i ) . ':</strong>' . $order_aemail[0] . '</p>';
        }
        echo '<p><strong>' . __( 'Approving Supervisor Name' ) . ':</strong>' . $order_sn[0] . '</p>';
        echo '<p><strong>' . __( 'Approving Supervisor Email' ) . ':</strong>' . $order_se[0] . '</p>';
        echo '<p><strong>' . __( 'Special Requests' ) . ':</strong>' . $order_sr[0] . '</p>';
      ?>
    </div>
  </div>
<?php 
  //add_filter( 'after_setup_theme', 'programmatically_create_post' );
}
add_action( 'woocommerce_admin_order_data_after_order_details', 'cloudways_display_order_data_in_admin' );
/**********************************************************************
Add Custom WooCommerce Checkout Fields based on Quantity in order email
**********************************************************************/
add_filter('woocommerce_email_order_meta_keys', 'my_custom_checkout_field_order_meta_keys');
function my_custom_checkout_field_order_meta_keys( $keys ) {
  $i = 0;
  for($k=2; $k<= 50; $k++) {
    $i++;
    $keys[] = 'First Name of Attendee'.$i;
    $keys[] = 'Last Name of Attendee'.$i;
    $keys[] = 'Email of Attendee'.$i;
  } 
  $keys[] = 'Approving Supervisor Name';
  $keys[] = 'Approving Supervisor Email';
  $keys[] = 'Special Requests';
  return $keys;
}
?>