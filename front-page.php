<?php
/*
 * The front page template file
 * If the user has selected a static page for their homepage, this is what will appear.
 * Template Name: Front Page
 */
get_header();
$id = get_the_ID(); ?>

<main id="main">
	<?php get_template_part( 'inc/slider' ); ?>
	<section class="callToAction">
	    <div class="container">
	        <div class="row">
	            <div class="col-sm-9">
	                <p><?php the_field('tagline'); ?></p>
	            </div>
	            <div class="col-sm-3 text-end">
	                <a class="btn btn-primary btn-lg" href="<?php the_field('tagline_button_link'); ?>">
	                	<span><?php the_field('tagline_button'); ?></span>
	                </a>
	            </div>
	        </div>  
	    </div>
	</section>
	<section class="content intro text-center pb-0">
		<div class="container">
			<h1><?php the_field('services_heading'); ?></h1>
			<p class="mb-0"><?php the_field('services_description'); ?></p>
		</div>
	</section>
	<section class="content">
		<div class="container">
			<ul class="nav nav-pills mb-3  nav-fill" id="pills-tab" role="tablist">
				<?php
				$count = 1;
				if( have_rows('services_tabs') ):
				    while( have_rows('services_tabs') ) : the_row(); ?>
					  	<li class="nav-item" role="presentation">
					    	<button class="nav-link <?php if($count == 1){echo 'active';} ?> w-100" id="pills<?php echo $count; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills<?php echo $count; ?>" type="button" role="tab" aria-controls="pills1" aria-selected="<?php if($count == 1){echo 'true';} else {echo 'false';} ?>>"><?php the_sub_field('tab_heading'); ?></button>
					  	</li>
					<?php $count++; 
					endwhile;
				endif; ?>
			</ul>
			<div class="tab-content" id="pills-tabContent">
				<?php
				$count = 1;
				if(have_rows('services_tabs')):
				    while( have_rows('services_tabs') ) : the_row(); ?>
					  	<div class="tab-pane fade <?php if($count == 1){echo 'show active';} ?>" id="pills<?php echo $count; ?>" role="tabpanel" aria-labelledby="pills<?php echo $count; ?>-tab">
					  		<div class="row">
					  			<div class="col-lg-6">
					  				<img src="<?php the_sub_field('tab_image'); ?>" class="img-fluid" alt="">
					  			</div>
					  			<div class="col-lg-6">
					  				<div class="text">
										<?php the_sub_field('tab_content'); ?>
									</div>
					  			</div>
					  		</div>
					  	</div>
					<?php 
					$count++;
					endwhile;
				endif; ?>
			</div>
		</div>
	</section>
	<section class="content training-block">
		<div class="container">
			<h2 class="text-center"><?php the_field('training_heading'); ?></h2>
			<p class="text-center"><?php the_field('training_description'); ?></p>
			<div class="row pt-5">
				<?php
				if(have_rows('training_blocks')):
				    while( have_rows('training_blocks') ) : the_row(); ?>
						<div class="post col-md-4 col-sm-6 ota1">
							<img src="<?php the_sub_field('block_image'); ?>" class="img-fluid" alt="<?php the_sub_field('block_heading'); ?>">
							<h3><?php the_sub_field('block_heading'); ?></h3>
							<p><?php the_sub_field('block_description'); ?></p>
							<a href="<?php the_sub_field('link'); ?>">Read More →</a>
						</div>
					<?php endwhile;
				endif; ?>
			</div>
		</div>
	</section>
	<section class="content two-columns">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 news-box">
					<h3>Latest news</h3>
					<div class="news-posts">
						<?php dynamic_sidebar('latest-news'); ?>
					</div>
				</div>
				<div class="col-lg-6">
					<style type="text/css">
						#script-warning {
					    	display: none;
					    	background: #eee;
					    	border-bottom: 1px solid #ddd;
					    	padding: 0 10px;
					    	line-height: 40px;
					    	text-align: center;
					    	font-weight: bold;
					    	font-size: 12px;
					    	color: red;
					  	}
					  	#loading {
					    	display: none;
					    	position: absolute;
					    	top: 10px;
					    	right: 10px;
					  	}
					  	.fc .fc-daygrid-more-link{
					  		font-size: 12px;
					  	}
					  	.fc .fc-event-time{
					  		display: none;
					  	}
					</style>
				    <link href='<?php bloginfo('template_url'); ?>/fullcalendar/main.css' rel='stylesheet' />
				    <script src='<?php bloginfo('template_url'); ?>/fullcalendar/main.js'></script>
					<script>
						document.addEventListener('DOMContentLoaded', function() {
						    var calendarEl = document.getElementById('calendar');
						    var today1 = new Date().toISOString().slice(0, 10);;
							//var date11 = today1.getFullYear()+'-'+(today1.getMonth()+1)+'-'+today1.getDate();
							//alert(today1);
						    <?php $url = get_home_url().'/wp-content/themes/accenv/fullcalendar/calendar-feeds.php'; ?>
						    var calendar = new FullCalendar.Calendar(calendarEl, {
						      	// headerToolbar: {
						       //  	left: 'prev,next today',
						       //  	center: 'title',
						       //  	right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
						      	// },
						      	//initialDate: '2022-01-03',
						      	initialDate: today1,
						      	editable: false,
						      	//customRender: true,
						      	navLinks: true,
						      	eventLimit: true,
						      	dayMaxEvents: 1,
							  	events: <?php get_template_part( 'fullcalendar/calendar-feeds' ); ?>,
						      	loading: function(bool) {
						        	document.getElementById('loading').style.display = bool ? 'block' : 'none';
						      	}
						    });
						    calendar.render();
					  	});
					</script>
					<div id='script-warning'>
						<code>error.
						</div>
						<div id='loading'>loading...</div>
				    <div id='calendar'></div>
				</div>
			</div>
		</div>
	</section>
	<section class="content projects">
		<div class="container">
			<h2 class="text-center mb-5"><?php the_field('projects_heading'); ?></h2>
			<div class="owl-carousel owl-theme">
				<?php $project = array(
                    'post_type' => 'project',
                    'posts_per_page' => 9,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'ASC',
                );
                $the_query1 = new WP_Query( $project );
                if( $the_query1->have_posts() ):
                    while( $the_query1->have_posts() ) : $the_query1->the_post(); ?>
						<div class="item">
							<img src="<?php the_field('featured_image'); ?>" class="img-fluid mb-3" alt="">
							<span>Service:</span>
							<p><?php the_field('service'); ?></p>
							<span>Facility type:</span>
							<p><?php the_field('facility_type'); ?></p>
							<a href="<?php the_permalink(); ?>">Read More</a>
						</div>
					<?php endwhile;
				endif; 
				wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
	<!--<section class="content">
		<div class="container">
			<div class="d-lg-flex justify-content-between align-items-center text-center">
				<?php
				if(have_rows('logos')):
				    while( have_rows('logos') ) : the_row(); ?>
						<img src="<?php the_sub_field('logo_image'); ?>" class="img-fluid" alt="">
					<?php endwhile;
				endif; ?>
			</div>
		</div>
	</section>-->
</main>

<?php get_footer(); ?>
