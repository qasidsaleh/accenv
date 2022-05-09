<?php 
/*
    * Template Name: Setup Consultation
*/
get_header(); ?>
	<main id="main">
		<?php get_template_part( 'inc/page-banner' ); ?>
		<section class="content pt-0">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-lg-9 proposal">
						<?php the_field('page_content'); ?>
						<?php echo do_shortcode('[contact-form-7 id="395" title="Setup Consultation"]'); ?>
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
			</div>
		</section>
	</main>
<?php get_footer(); ?>