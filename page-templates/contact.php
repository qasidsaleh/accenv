<?php 
/*
    * Template Name: Contact
*/
get_header(); ?>
	<main id="main">
		<?php get_template_part( 'inc/page-banner' ); ?>
		<section class="content contact pt-0">
			<div class="container">
				<?php
				if( have_rows('contact_list') ):
				    while( have_rows('contact_list') ) : the_row(); ?>
						<div class="row mb-4">
				        	<div class="col-md-5">
								<?php the_sub_field('contact_content'); ?>
				        	</div>
				        	<div class="col-md-7">
				        		<?php the_sub_field('iframe'); ?>
				        	</div>
						</div>
					<?php endwhile;
				endif; ?>
			</div>
		</section>
	</main>
<?php get_footer(); ?>