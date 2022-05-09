<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th class="product-name" width="55%"><?php esc_html_e( 'COURSE(S)', 'woocommerce' ); ?></th>
				<th class="product-quantity" width="15%"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-price" width="15%"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
				<th class="product-remove" width="15%"><?php esc_html_e( 'Remove', 'woocommerce' ); ?></th>
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
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input(
								array(
									'input_name'   => "cart[{$cart_item_key}][qty]",
									'input_value'  => $cart_item['quantity'],
									'max_value'    => $_product->get_max_purchase_quantity(),
									'min_value'    => '0',
									'product_name' => $_product->get_name(),
								),
								$_product,
								false
							);
						}
						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						$stock = $_product->get_stock_quantity();
						echo $stock.' available';
						?>

						</td>

						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
								$price_html = $_product->get_price_including_tax();
								$cart_item_price1 = WC()->cart->get_product_price( $_product );
								$cart_item_price2 = preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $cart_item_price1);
								$cart_item_quantity = $cart_item['quantity'];
								$cart_item_price = $cart_item_price2 * $cart_item_quantity;
								echo '<span class="text-center">$'.$cart_item_price.'<br></span>';
								echo '<em>('.apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ).' each)</em>'; // PHPCS: XSS ok.
							?>
						</td>

						<td class="product-remove">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
						</td>
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr>
				<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<button type="submit" class="btn btn-primary" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update Cart', 'woocommerce' ); ?></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
