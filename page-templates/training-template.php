<?php 
/*
    * Template Name: Training Template
*/
get_header(); ?>  
	<main id="main">
		<?php get_template_part( 'inc/page-banner' ); ?>
		<section class="training-contain content pt-0 sitemap listing">
			<div class="container">
          		<div class="row">
					<div class="col-md-8 col-lg-9 listing">
						<ul class="color-list p-0">
							<?php
							$current_id = get_the_ID();
							if( have_rows('training_menu','options') ):
							    while( have_rows('training_menu','options') ) : the_row(); 
							    	$page_object = get_sub_field('page_name');
							    	//print("<pre>");print_r($page_object);print("</pre>");
							    	$page_title = $page_object->post_title;
							    	$page_id = $page_object->ID;
							    	$page_url = get_the_permalink($page_id); ?>
		                            <li>
		                  				<a href="<?php echo $page_url; ?>" class="<?php if($current_id == $page_id){echo 'active';} ?>" title="<?php echo $page_title; ?>">1</a>
		                			</li>
		                		<?php endwhile;
		                	endif; ?>
                        </ul>
						<?php the_field('page_content'); ?>  
					</div>
					<div class="col-md-4 col-lg-3">
						<div class="content-sidebar listing">
			                <ul class="p-0 mb-4">
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
			    		<hr>
			    		<h2>Other Training Available</h2>
						<ul class="side-nav color p-0">
							<?php
							$current_id = get_the_ID();
							if( have_rows('training_menu','options') ):
							    while( have_rows('training_menu','options') ) : the_row(); 
							    	$page_object = get_sub_field('page_name');
							    	//print("<pre>");print_r($page_object);print("</pre>");
							    	$page_title = $page_object->post_title;
							    	$page_id = $page_object->ID;
							    	$page_url = get_the_permalink($page_id); ?>
							    	<?php if($current_id != $page_id){ ?>
									    <li>
									    	<a href="<?php echo $page_url; ?>"><?php echo $page_title; ?></a>
									    </li>
									<?php } 
								endwhile;
							endif; ?>
						</ul>
					</div>
				</div>
        	</div>
		</section>
	</main>
<?php  get_footer(); ?>