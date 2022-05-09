<?php 
/*
    * Template Name: Classes
*/
get_header(); ?>
	<main id="main">
		<?php get_template_part( 'inc/page-banner' ); ?>
		<section class="training-contain content pt-0">
			<div class="container">
				<div class="courses-tabs">
		      <ul class="nav nav-tabs">
		        <li class="active">
              <a href="#">OPEN ENROLLMENT CLASSES</a>
            </li>
            <li>
            	<a href="<?php echo get_page_link(686); ?>">ALL AVAILABLE COURSES</a>
            </li>
          </ul>
          <div class="row mb-3">
          	<div class="col-md-6 mb-4 mb-md-0">
          		<p>Filter By City</p>
          		<form>
				        <fieldset>
				          <select id="class_city" class="filterField tbl_filter" data-index="1" name="city" aria-label="select" onchange="changefilter()">
                    <option <?php if(empty($class_city)){echo 'selected="selected"';} ?> value="">All</option>
                    <?php 
                      $class_city = $_GET['city']; 
                      $venues_terms = get_terms( 
                        array(
                          'taxonomy' => 'Venues',
                          'hide_empty' => false,
                        ) 
                      );
                      //print("<pre>");print_r($venues_terms);print("</pre>");
                      foreach($venues_terms as $venues_term){
                        $venueid = $venues_term->term_id;
                        $venuecity = get_field('city',$venues_term);
                        $venuestate = get_field('state',$venues_term);
                        $today = date('Ymd');
                        $venueclass1 = array(
                          'post_type' => 'product',
                          'posts_per_page' => -1,
                          'post_status' => 'publish',
                          'orderby' => 'date',
                          'order' => 'ASC',
                          'meta_query'  => array(
                            'relation'    => 'AND',
                            array(
                              'key'   => 'class_date',
                              'value'   => $today,
                              'type'    => 'date',
                              'compare' => '>=',
                            )
                          ),
                          'tax_query' => array(
                            array(
                              'taxonomy' => 'Venues',
                              'terms' => $venueid,
                            ),
                          ),
                        );
                        $venueclass = new WP_Query( $venueclass1 );
                        $venueclassfound = $venueclass->found_posts;
                        if($venueclassfound > 0){ ?>
                          <option <?php if($class_city == 'oakland'){echo 'selected="selected"';} ?> value="<?php echo $venuestate; ?> - <?php echo $venuecity; ?>"><?php echo $venuestate; ?> - <?php echo $venuecity; ?></option>
                        <?php }
                      }
                    ?>
				          </select>
				        </fieldset>
				      </form>
          	</div>
          	<div class="col-md-6">
          		<p>Filter By Course</p>
        			<form>
                <fieldset>
              		<select class="filterField tbl_filter" data-index="2" id="course" name="course" aria-label="select" onchange="changefilter()">
                    <option value="">All</option> 
                    <?php 
                      $cat_args = array(
                        'orderby'       => 'term_id', 
                        'order'         => 'ASC',
                        'hide_empty'    => false, 
                      );
                      $terms = get_terms('Course Certifications', $cat_args);
                      //print("<pre>");print_r($terms);print("</pre>");
                      foreach($terms as $term){
                        $term_id = $term->term_id;
                        $term_name = $term->name;
                        $cat_args1 = array(
                          'orderby'       => 'term_id', 
                          'order'         => 'ASC',
                          'hide_empty'    => false,
                          'meta_query'  => array(
                            'relation'    => 'AND',
                            array(
                              'key'   => 'course_certification',
                              'value'   => $term_id,
                            )
                          ) 
                        );
                        $terms1 = get_terms('product_cat', $cat_args1);
                        //print("<pre>");print_r($terms1);print("</pre>"); ?>
                        <optgroup label="<?php echo $term_name; ?>">
                          <?php if(!empty($terms1)){
                            foreach($terms1 as $term1){ 
                              $term_id1 = $term1->term_id;
                              $term_name1 = $term1->name; ?>
                              <option value="<?php echo $term_name1; ?>"><?php echo $term_name1; ?></option>
                            <?php }
                          } ?>
                        </optgroup>
                      <?php }
                    ?>
                  </select>
                </fieldset>
              </form>
          	</div>
          </div>
          <table id="tbl_classes" class="table classes-table" role="grid">
          	<thead>
            	<tr role="row">
            		<th align="left" width="95" class="sorting_asc" tabindex="0" aria-controls="tbl_classes" rowspan="1" colspan="1" aria-sort="ascending" aria-label="DATE : activate to sort column descending">DATE </th>
            		<th align="left" class="sorting" tabindex="0" aria-controls="tbl_classes" rowspan="1" colspan="1" aria-label="LOCATION: activate to sort column ascending">LOCATION</th>
            		<th align="left" class="sorting" tabindex="0" aria-controls="tbl_classes" rowspan="1" colspan="1" aria-label="COURSE: activate to sort column ascending">COURSE</th>
            		<th align="center" width="70" class="sorting_disabled" rowspan="1" colspan="1" aria-label="TIME">TIME</th>
            		<th align="center" class="sorting" tabindex="0" aria-controls="tbl_classes" rowspan="1" colspan="1" aria-label="COST: activate to sort column ascending">COST</th>
            		<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="&amp;nbsp;">&nbsp;</th>
            	</tr>
          	</thead>
          	<tbody>
              <?php
              $new_date = date('Ymd');
              $product = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'ASC',
                'meta_query'  => array(
                  'relation'    => 'AND',
                  array(
                    'key'   => 'class_date',
                    'value'   => $new_date,
                    'type'    => 'date',
                    'compare' => '>='
                  ),
                  // array(
                  //   'key'   => 'class_status',
                  //   'value'   => 'cancel',
                  //   'type'    => 'text',
                  //   'compare' => '!='
                  // )
                )
              );
              $the_query2 = new WP_Query($product);
              if($the_query2->have_posts()):
                while($the_query2->have_posts()) : $the_query2->the_post(); 
                  global $product; 
                  $class_days = get_field('number_of_class_days');
                  $class_days1 = $class_days - 1;
                  $class_date1 = get_field('class_date');
                  $nextday1 = date("d-m-Y", strtotime("$class_date1 +$class_days1 day"));
                  $nextday = date("M j, Y (D)", strtotime($nextday1));
                  $class_date = date("M j, Y (D)", strtotime($class_date1));
                  $venue_id = get_field('venue');
                  $venue_object = get_term($venue_id, 'Venues' );
                  $venue_city = get_field('city',$venue_object);
                  $venue_state = get_field('state',$venue_object);
                  $course_id = get_field('course');
                  $course_title = get_term($course_id)->name;
                  $class_start_time = get_field('class_start_time');
                  $class_end_time = get_field('class_end_time');
                  $wokshop_price = get_field('workshop_ticket_price');
                  $link = get_the_permalink(); 
                  $product = wc_get_product(get_the_ID());
                  $stock = $product->get_stock_quantity();
                  $price = $product->get_price();
                  $number_of_class_days = get_field('sale_ends_before_days');
                  $today_date = date('d-m-Y');
                  $expire_date1 = date("Y-m-d", strtotime($class_date1));
                  $expire_date2 = new DateTime($expire_date1);
                  $expire_date2->modify("-".$number_of_class_days." day");
                  $expire_date = $expire_date2->format("d-m-Y");
                  $class_status = get_field('class_status');
                  //echo $date->format("Y-m-d");
                  if($class_status != 'Cancel'){ ?>
                    <tr role="row">
              				<td class="sorting_1" title="Date"><?php echo $class_date; if($class_days > 1){echo '-<br>'.$nextday;} ?></td>
              				<td title="Location"><?php echo $venue_state.' - '.$venue_city; ?></td>
              				<td title="Course">
              					<a href="<?php echo $link; ?>"><?php echo $course_title; ?></a>
              				</td>
              				<td align="center" title="Time"><?php echo $class_start_time; ?> - <?php echo $class_end_time; ?></td>
              				<td align="center" title="Cost">$<?php echo $price; ?></td>
              				<td title="view">
              					<a href="<?php echo $link; ?>" class="view-details">View Details</a>
              				</td>
            				</tr>
                  <?php }
                endwhile;
              endif; 
              wp_reset_postdata(); ?>
      			</tbody>
          </table>
				</div>
        <div class="mt-5">
          <?php the_field('custom_content'); ?>
			   </div>
      </div>
		</section>
	</main>
<?php get_footer(); ?>