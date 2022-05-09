<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage acenv
 */

get_header(); ?>
	<main id="main">
		<?php get_template_part( 'inc/page-banner' ); ?>
		<section class="content listing pt-0">
			<div class="container">
				<?php if(is_cart()){
					echo do_shortcode('[woocommerce_cart]'); 
				} else if(is_checkout()) {
					echo do_shortcode('[woocommerce_checkout]');
				} else if(is_page('730')){ //lost password page
					wc_get_template( 'myaccount/form-lost-password.php', array( 'form' => 'lost_password' ) );
				} else if(is_page('684')){ // my account page
					the_content();
				} else { ?>
					<div class="row">
						<div class="col-md-8 col-lg-9">
							<?php the_field('page_content'); ?>   
						</div>
						<div class="col-md-4 col-lg-3">
							<div class="content-sidebar">
				                <ul>
				                	<?php
									if( have_rows('sidebar_links','options') ):
									    while( have_rows('sidebar_links','options') ) : the_row(); ?>
						                	<li>
						                		<a href="<?php the_sub_field('link','options'); ?>"><?php the_sub_field('heading','options'); ?></a>
						                	</li>
						                <?php endwhile;
						            endif; ?>
				    			</ul>
				    		</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</section>
	</main>
<?php get_footer(); ?>
