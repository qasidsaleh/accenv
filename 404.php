<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage accenv
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
			} else { ?>
				<h1 class="page-title" style="color:#676767;font-weight: 600;"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentyseventeen' ); ?></h1>
					<a href="<?php echo get_home_url(); ?>" class="btn btn-primary">Back to Home</a>
			<?php } ?>
		</div>
	</section>
</main>

<?php get_footer();
