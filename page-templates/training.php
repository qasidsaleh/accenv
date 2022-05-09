<?php 
/*
    * Template Name: Training
*/
get_header(); ?>
	<main id="main">
		<?php get_template_part( 'inc/page-banner' ); ?>
		<section class="training-contain content pt-0">
			<div class="container">
				<div class="courses-tabs">
          <ul class="nav nav-tabs">
            <li>
            	<a href="<?php echo get_page_link('690'); ?>">OPEN ENROLLMENT CLASSES</a>
            </li>
            <li class="active">
            	<a href="#">ALL AVAILABLE COURSES</a>
            </li>
          </ul>
          <div class="tab-content">
             <?php the_field('page_content'); ?> 			
          </div>
        </div>
			</div>
		</section>
	</main>
<?php get_footer(); ?>