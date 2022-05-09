<?php 
/*
    * Template Name: Services Template
*/
get_header(); ?>

	<main id="main">
		<?php get_template_part( 'inc/page-banner' ); ?>
		<section class="content pt-0">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-lg-3">
						<?php
			                echo str_replace( '<li class="', '<li class="',
			                    wp_nav_menu( array(
			                    'container'       => false,
			                    'theme_location' => 'services-sidebar',
			                    'items_wrap'      => '<ul class="side-nav services">%3$s</ul>',
			                    'menu_class' => ''
			                )));
			            ?>
						<div class="content-sidebar listing">
			                <ul class="p-0">
			                	<?php
			                	if( have_rows('sidebar_links') ):
								    while( have_rows('sidebar_links') ) : the_row(); ?>
					                	<li>
					                		<a href="<?php the_sub_field('link'); ?>"><?php the_sub_field('heading'); ?></a>
					                	</li>
					                <?php endwhile;
					            else:
									if( have_rows('sidebar_links','options') ):
									    while( have_rows('sidebar_links','options') ) : the_row(); ?>
						                	<li>
						                		<a href="<?php the_sub_field('link','options'); ?>"><?php the_sub_field('heading','options'); ?></a>
						                	</li>
						                <?php endwhile;
						            endif;
						        endif; ?>
			    			</ul>
			    		</div>
					</div>
					<div class="col-md-8 col-lg-9 listing">
				        <?php the_field('page_content'); ?>       
					</div>
				</div>
			</div>
		</section>
	</main>
<?php get_footer(); ?>