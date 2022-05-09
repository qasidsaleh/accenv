<?php 
/*
    * Template Name: Thanks
*/
get_header(); ?>
	<main id="main">
		<?php get_template_part( 'inc/page-banner' ); ?>
		<section class="training-contain content pt-0">
			<div class="container">
				<div class="row">
		        	<div class="col-md-12">
		                <?php the_field('page_content'); ?>        
					</div>
				</div>
			</div>
		</section>
	</main>
<?php get_footer(); ?>