<?php 
/*
    * Template Name: Projects
*/
get_header(); ?>
	<main id="main">
		<?php get_template_part( 'inc/page-banner' ); ?>
		<section class="content pt-0 content-projects">
          	<div class="container">
          		<?php $project = array(
                    'post_type' => 'project',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'ASC',
                );
                $the_query1 = new WP_Query( $project );
                if( $the_query1->have_posts() ):
                    while( $the_query1->have_posts() ) : $the_query1->the_post(); ?>
		          		<div class="project-block">
			            	<p><strong>Service:</strong> <?php the_field('service'); ?><br class="d-block"><strong>Facility Type:</strong> <?php the_field('facility_type'); ?></p>
			            	<p class="mb-0"><strong>Description: </strong></p>
			            	<?php $content = get_the_content(); 
			            	echo '<p>'.mb_strimwidth($content, 0, 300, '...').'</p>'; ?>
			            	<a href="<?php the_permalink(); ?>">Read More</a>
			            </div>
			        <?php endwhile;
				endif; 
				wp_reset_postdata(); ?>
      		</div>
    	</div>
	</main>
<?php get_footer(); ?>