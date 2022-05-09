<?php 
/*
    * Template Name: Process Safety Management
*/
get_header(); ?>

	<main id="main">
		<?php get_template_part( 'inc/page-banner' ); ?>
		<section class="content pt-0">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
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
					<div class="col-md-9 listing">
				        <?php the_field('page_content'); ?>
				        <ul>
					        <?php
							$count = 1;
							if( have_rows('services_include') ):
							    while( have_rows('services_include') ) : the_row(); ?>
					        		<li>
					        			<a data-bs-toggle="modal" href="#services<?php echo $count; ?>" role="button"><?php the_sub_field('title'); ?></a>
								        <div class="modal fade" id="services<?php echo $count; ?>" aria-hidden="true" aria-labelledby="sharefriendLabel" tabindex="-1">
										  	<div class="modal-dialog modal-dialog-centered">
										    	<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
														<h4 class="modal-title"><?php the_sub_field('title'); ?></h4>
													</div>
													<div class="modal-body">
														<?php the_sub_field('content'); ?>
													</div>
												</div>
										  	</div>
										</div>
									</li>
								<?php $count++; 
								endwhile;
							endif; ?>
						</ul>   
					</div>
				</div>
			</div>
		</section>
	</main>
<?php get_footer(); ?>