<?php 
/*
    * Template Name: Sitemap
*/
get_header(); ?>
	<main id="main">
		<?php get_template_part( 'inc/page-banner' ); ?>
		<section class="training-contain content pt-0 sitemap listing">
			<div class="container">
				<?php //echo do_shortcode('[simple-sitemap types="page"]'); ?>
          		<?php //the_field('sitemap_links'); ?>
          		<?php 
					if( have_rows('sitemap_links') ):
				    	while( have_rows('sitemap_links') ) : the_row(); 
				    		$heading = get_sub_field('heading'); ?>
				    		<ul class="mb-0">
				    			<?php if(!empty($heading)){ ?>
				    				<li>
				    					<?php 
				    						echo $heading;
				    						if( have_rows('links') ): ?>
				    							<ul class="mb-0">
				    								<?php while( have_rows('links') ) : the_row(); ?> 
				    									<li>
				    										<a href="<?php the_sub_field('page_link'); ?>"><?php the_sub_field('page_heading'); ?></a>
				    									</li>
				    								<?php endwhile; ?>
				    							</ul>
				    						<?php endif; 
				    					?>
				    				</li>
				    			<?php } else {
				    				if( have_rows('links') ):
	    								while( have_rows('links') ) : the_row(); ?> 
	    									<li>
	    										<a href="<?php the_sub_field('page_link'); ?>"><?php the_sub_field('page_heading'); ?></a>
	    									</li>
	    								<?php endwhile;
		    						endif; 
				    			} ?>
				    		</ul>
				    	<?php endwhile;
				    endif;
          		?>
            	<div class="content-sidebar mt-3">
	                <ul class="p-0">
	                	<?php
						if(have_rows('sidebar_links','options')):
						    while( have_rows('sidebar_links','options') ) : the_row(); ?>
			                	<li>
			                		<a href="<?php the_sub_field('link','options'); ?>"><?php the_sub_field('heading','options'); ?></a>
			                	</li>
			                <?php endwhile;
			            endif; ?>
	    			</ul>
	    		</div>
        	</div>
		</section>
	</main>
<?php  get_footer(); ?>