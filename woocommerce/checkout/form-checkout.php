<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<!-- Get Cart Table Data -->
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th class="product-name" width="70%"><?php esc_html_e( 'COURSE(S)', 'woocommerce' ); ?></th>
				<th class="product-quantity" width="15%"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-price" width="15%"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td class="product-name" data-title="<?php esc_attr_e( 'Course', 'woocommerce' ); ?>">
							<?php
								$course_id = get_field('course',$product_id);
						        $course_object = get_term($course_id, 'product_cat');
						        $course_title = get_term($course_id)->name;
						        $venue_id = get_field('venue',$product_id);
						        $venue_object = get_term($venue_id, 'Venues' );
						        $venue_title = get_term($venue_id)->name;
						        $venue_city = get_field('city',$venue_object);
						        $venue_state = get_field('state',$venue_object);
						        $venue_address1 = get_field('address_1',$venue_object);
						        $venue_address2 = get_field('address_2',$venue_object);
						        $venue_zipcode = get_field('zip_code',$venue_object);
						        $class_start_time = get_field('class_start_time',$product_id);
						        $class_end_time = get_field('class_end_time',$product_id);
						        $date = get_field('class_date',$product_id);
	        					$date1 = date("m-d-Y", strtotime($date));
	        					$date2 = date("D, j F Y", strtotime($date));
	        					$class_days = get_field('number_of_class_days',$product_id);
	        					$class_days1 = $class_days - 1;
	        					$nextday1 = date("d-m-Y", strtotime("$date2 +$class_days1 day"));
        						$nextday = date("D, j F Y", strtotime($nextday1));
							?>
							<strong><?php echo $course_title; ?> (<?php echo $date1; ?> - <?php echo $venue_city; ?>)</strong><br>
							<strong>Date:</strong> <?php echo $date2; if($class_days > 1){echo ' - '.$nextday;} ?><br>
							<strong>Time:</strong> <?php echo $class_start_time.' - '.$class_end_time; ?><br>
							<strong>Location: </strong><?php echo $venue_address1.', '.$venue_address2.', '.$venue_city.', '.$venue_state; ?>
						</td>

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						<?php
							echo $cart_item['quantity'];
						?>

						</td>

						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>
					</tr>
					<?php
				}
			}
			?>
			<tr>
				<td class="order-total-desktop"><strong>Order Total:</strong></td>
				<td class="d-none d-md-block"></td>
				<td data-title="Order Total"><strong><?php echo WC()->cart->get_total(); ?></strong></td>
			</tr>
		</tbody>
	</table>
</form>

<!-- Start Checkout Form -->
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div>
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div>
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
	<h3 id="order_review_heading"><?php esc_html_e( 'Total', 'woocommerce' ); ?></h3>
	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
