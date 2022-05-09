<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage accenv
 */

get_header(); ?>
	<main id="main">
		<?php get_template_part( 'inc/page-banner' ); ?>
		<section class="training-contain content pt-0">
			<div class="container">
				<?php //echo do_shortcode('[ivory-search id="1685" title="Default Search Form"]'); ?>
				<?php
					$post_count = 0;
					if(have_posts()):
						while(have_posts()):the_post(); ?>
							<?php 
							$postid = get_the_ID();
							if(get_post_type($postid) == 'product'){
								$date = get_field('class_date',$postid);
								$new_date1 = date('Ymd');
						        $class_days = get_field('number_of_class_days',$postid);
						        $class_days1 = $class_days - 1;
						        $date5 = date("Ymd", strtotime($date));
						        $date1 = date("m-d-Y", strtotime($date));
						        $date2 = date("D, j F Y", strtotime($date));
						        $nextday1 = date("d-m-Y", strtotime("$date2 +$class_days1 day"));
						        $nextday = date("D, j F Y", strtotime($nextday1));
						        $course_id = get_field('course',$postid);
						        $course_object = get_term( $course_id, 'product_cat');
						        $course_title = get_term($course_id)->name;
						        $venue_id = get_field('venue',$postid);
						        $venue_object = get_term($venue_id, 'Venues');
						        $venue_title = get_term($venue_id)->name;
						        $venue_city = get_field('city',$venue_object);
						        $venue_state = get_field('state',$venue_object);
						        $class_start_time = get_field('class_start_time',$postid);
    							$class_end_time = get_field('class_end_time',$postid); 
    							if($new_date1 < $date5){ ?>
    								<div class="search-block">
										<h2 class="mb-0"><a href="<?php the_permalink(); ?>"><?php echo $venue_city.', '.$venue_state; ?> - <?php echo $course_title; ?></a></h2>
										<p class="mb-0"><?php echo $date2; if($class_days > 1){echo ' - '.$nextday;} ?>, from <?php echo $class_start_time; ?> to <?php echo $class_end_time; ?></p>
									</div>
								<?php $post_count++; } 
							} else if(get_post_type($postid) == 'news'){ ?>
								<div class="search-block">
									<h2 class="mb-0"><a href="<?php echo get_page_link(88); ?>"><?php the_title(); ?></a></h2>
									<?php
									$page_content = get_the_content();
									if(!empty($page_content)){
										$page_content = wp_filter_nohtml_kses($page_content);
										echo mb_strimwidth($page_content, 0, 150, '...');
									} else {
										$page_content = get_field('page_content'); 
										$page_content = wp_filter_nohtml_kses($page_content);
										echo mb_strimwidth($page_content, 0, 150, '...');
									} ?>
								</div>
							<?php } else { $post_count++; ?>
								<div class="search-block">
									<h2 class="mb-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<?php
									$page_content = get_the_content();
									if(!empty($page_content)){
										$page_content = wp_filter_nohtml_kses($page_content);
										echo mb_strimwidth($page_content, 0, 150, '...');
									} else {
										$page_content = get_field('page_content'); 
										$page_content = wp_filter_nohtml_kses($page_content);
										echo mb_strimwidth($page_content, 0, 150, '...');
									} ?>
								</div>
							<?php } ?>
						<?php endwhile;
					else :
						$post_count++; ?>
						<div class="listing">
							<h2>SORRY, THERE ARE NO RESULTS</h2>
	                        <strong>Try your search again using these tips:</strong>
	                        <ul>
	                            <li>Double check the spelling. Try modifying the spelling.</li>
	                            <li>Limit the search to one or two words.</li>
	                            <li>Be less specific in your wording. Sometimes a more general term will lead you to similar products.</li>
	                        </ul>
	                    </div>
					<?php endif;
					if($post_count == 0){ ?>
						<div class="listing">
							<h2>SORRY, THERE ARE NO RESULTS</h2>
	                        <strong>Try your search again using these tips:</strong>
	                        <ul>
	                            <li>Double check the spelling. Try modifying the spelling.</li>
	                            <li>Limit the search to one or two words.</li>
	                            <li>Be less specific in your wording. Sometimes a more general term will lead you to similar products.</li>
	                        </ul>
	                    </div>
					<?php }
				?>
			</div>
		</section>
	</main>
<?php get_footer(); ?>
