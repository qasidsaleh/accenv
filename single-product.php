<?php
/**
 * The template for displaying all single projects
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage accenv
 */
get_header(); ?>
<main id="main">
    <?php 
        get_template_part( 'inc/page-banner' ); 
        $id1 = get_the_ID();
        $date = get_field('class_date');
        $class_days = get_field('number_of_class_days');
        $class_days1 = $class_days - 1;
        $date1 = date("m-d-Y", strtotime($date));
        $date2 = date("D, j F Y", strtotime($date));
        $date4 = date("j F Y", strtotime($date));
        $nextday1 = date("d-m-Y", strtotime("$date2 +$class_days1 day"));
        $nextday = date("D, j F Y", strtotime($nextday1));
        $course_id = get_field('course');
        $course_object = get_term( $course_id, 'product_cat' );
        $course_title = get_term($course_id)->name;
        $venue_id = get_field('venue');
        $venue_object = get_term($venue_id, 'Venues' );
        $venue_title = get_term($venue_id)->name;
        $venue_city = get_field('city',$venue_object);
        $venue_state = get_field('state',$venue_object);
        $venue_address1 = get_field('address_1',$venue_object);
        $venue_address2 = get_field('address_2',$venue_object);
        $venue_zipcode = get_field('zip_code',$venue_object);
        $venue_map = get_field('iframe',$venue_object);
        //$venue = str_replace(' -', ',', $venue1);
        $class_start_time = get_field('class_start_time');
        $class_end_time = get_field('class_end_time');
        $sales_end_days = get_field('sale_ends_before_days');
        $Workshop_price = get_field('workshop_ticket_price');
        $product = wc_get_product($id1);
        $stock = $product->get_stock_quantity();
        $price = $product->get_price();
        $number_of_class_days = get_field('sale_ends_before_days');
        $today_date = date('d-m-Y');
        $today_date1 = date('Ymd');
        $expire_date1 = date("Y-m-d", strtotime($date));
        $expire_date2 = new DateTime($expire_date1);
        $expire_date2->modify("-".$number_of_class_days." day");
        $expire_date = $expire_date2->format("d-m-Y");
        $expire_date_d = $expire_date2->format("Ymd");
        $class_status = get_field('class_status');
    ?>
    <section class="training-contain content pt-0">
        <div class="container">
            <h2><?php echo $date1; ?> - <?php echo $venue_city.', '.$venue_state; ?> - <?php echo $course_title; ?></h2>
            <div class="row">
                <div class="col-md-6">
                    <p><?php echo $date2; if($class_days > 1){echo ' - '.$nextday;} ?>, from <?php echo $class_start_time; ?> to <?php echo $class_end_time; ?></p>
                </div>
                <div class="col-md-6">
                    <?php if($expire_date_d > $today_date1 && !empty($number_of_class_days)){ ?>
                        <p>Select a Different Date:</p>
                        <form>
                            <fieldset>
                                <div>
                                    <select class="filterField" name="diff_class" id="diff_class" aria-label="select" onchange="changefilter2()">
                                        <?php 
                                        $new_date1 = date('Ymd');
                                        $product = array(
                                            'post_type' => 'product',
                                            'posts_per_page' => -1,
                                            'post_status' => 'publish',
                                            'orderby' => 'date',
                                            'order' => 'ASC',
                                            'meta_key'      => 'course',
                                            'meta_value'    => $course_id,
                                            'meta_query'  => array(
                                              'relation'    => 'AND',
                                              array(
                                                'key'   => 'class_date',
                                                'value'   => $new_date1,
                                                'type'    => 'date',
                                                'compare' => '>='
                                              )
                                            )
                                        );
                                        $the_query2 = new WP_Query( $product );
                                        if( $the_query2->have_posts() ):
                                            while( $the_query2->have_posts() ) : $the_query2->the_post(); 
                                                $id2 = get_the_ID();
                                                $date = get_field('class_date');
                                                $date3 = date("j F Y", strtotime($date));
                                                ?>
                                            <option <?php if($id1 == $id2){echo 'selected="selected"';} ?>value="<?php the_permalink(); ?>"><?php echo $date3; ?></option>
                                        <?php endwhile;
                                        else: ?>
                                            <option selected="selected" value="#"><?php echo $date4; ?></option>
                                        <?php endif;
                                        wp_reset_postdata(); ?>  
                                    </select>
                                </div>
                            </fieldset>
                        </form>
                    <?php } ?>
                </div>
            </div>
            <h2>Course Registration</h2>
            <form class="mb-4">
                <table class="tbl-class mb-4" width="100%" cellspacing="0" cellpadding="0" border="0">
                    <thead>
                        <tr>
                            <th width="30%">TICKET TYPE</th>
                            <th width="25%">REGISTRATION DEADLINE</th>
                            <th width="25%">PRICE</th>
                            <th width="20%">QUANTITY</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td valign="top" align="left">
                                <strong>Workshop Ticket</strong>
                            </td>
                            <td valign="top" align="left"><?php echo $sales_end_days; ?> days before class</td>
                            <td valign="top" align="left">$<?php echo $price; ?></td>
                            <td valign="top" align="left">
                                <?php if($expire_date_d > $today_date1 && !empty($number_of_class_days) && $stock > 0){ ?>
                                    <select class="qtyField" id="qtyField" name="qtys" aria-label="select">
                                        <?php 
                                        $x = 0;
                                        while($x < $stock){ 
                                            $x++; ?>
                                            <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } 
                                if($stock < 0 || $stock == 0){
                                    echo 'SOLD OUT';
                                } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
                    if($expire_date == $today_date || $expire_date_d < $today_date1){ ?>
                        <div class="row">
                            <div class="col-md-12">
                                <strong style="color: red;">Registration for this class have been closed.</strong>
                            </div>
                        </div>
                    <?php }
                    if($stock < 0 || $stock == 0){ ?>
                        <div class="row">
                            <div class="col-md-12">
                                <strong style="color: red;">No seat is available for registration, you may register for any available alternate date.</strong>
                            </div>
                        </div>
                    <?php }
                ?>
                <?php if($expire_date_d > $today_date1 && !empty($number_of_class_days) && $stock > 0){ ?>
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <a href="<?php echo get_home_url(); ?>/?add-to-cart=<?php echo $id1; ?>&quantity=1" class="btn-secondary ms-auto" id="register-now">Register Now</a>
                            <div class="d-flex justify-content-end mt-2">
                                <img alt="" src="<?php bloginfo('template_url'); ?>/images/credit_card-1.png" class="img-fluid" alt=""> 
                                <img alt="" src="<?php bloginfo('template_url'); ?>/images/credit_card-2.png" class="img-fluid" alt=""> 
                                <img alt="" src="<?php bloginfo('template_url'); ?>/images/credit_card-3.png" class="img-fluid" alt="">
                                <img alt="" src="<?php bloginfo('template_url'); ?>/images/credit_card-4.png" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </form>
            <?php if(!empty(get_field('custom_content'))){ ?>
	            <h2>Questions & Requirements</h2>
	            <div class="requirements mb-3">
	            	<div class="requirements-inner">
	                	<?php the_field('custom_content'); ?>
	                </div>
	            </div>
	        <?php } ?>
            <div class="content-map mb-5">
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $venue_map; ?>
                    </div>      
                    <div class="col-md-6 pt-3 pb-3 pe-3">
                        <p><strong><?php echo $venue_title; ?> </strong><br><?php echo $venue_address1; ?> <br><?php echo $venue_address2; ?> <?php echo $venue_city; ?>, <?php echo $venue_state; ?> <?php echo $venue_zipcode; ?></p>
                        <p><strong>Enter your address:</strong></p>
                        <div class="get-direction">
                            <form target="_blank" name="direction_frm" id="direction_frm" method="get" action="https://maps.google.com/maps" class="mb-2">
                                <fieldset>
                                    <input name="saddr" type="text" id="saddr">
                                    <input type="hidden" name="daddr" id="daddr" value="<?php echo $venue_address1; ?> <?php echo $venue_address2; ?> <?php echo $venue_city; ?> <?php echo $venue_state; ?>">
                                    <button type="submit">Get Directions</button>
                                </fieldset>
                            </form>
                        </div>
                        <p><?php echo $date2; if($class_days > 1){echo ' - '.$nextday;} ?> <br><em>(from <?php echo $class_start_time; ?> - <?php echo $class_end_time; ?>)</em></p>
                    </div>
                </div>
            </div>
            <div class="class-content">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-details-tab" data-bs-toggle="pill" data-bs-target="#pills-details" type="button" role="tab" aria-controls="pills-details" aria-selected="true">Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-faq-tab" data-bs-toggle="pill" data-bs-target="#pills-faq" type="button" role="tab" aria-controls="pills-faq" aria-selected="false">FAQ</button>
                    </li>
                </ul>
                <div class="tab-content listing" id="pills-tab-Content">
                    <div class="tab-pane fade active show" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab">
                        <?php the_field('course_detail',$course_object); ?>
                    </div>
                    <div class="tab-pane fade" id="pills-faq" role="tabpanel" aria-labelledby="pills-faq-tab">
                        <?php
                        $l1 = 0;
                        $l2 = 0;
                        $s1 = 0;
                        $s2 = 0;
                        if(have_rows('faqs',$course_object)):
                            while(have_rows('faqs',$course_object)) : the_row();
                                $group = get_sub_field('group',$course_object);
                                if($group == 'course-logistics'){
                                    $course_logistic_question[$l1] = get_sub_field('question',$course_object);
                                    $course_logistic_answer[$l2] = get_sub_field('answer',$course_object);
                                    $l1++;
                                    $l2++;
                                } else {
                                    $course_state_question[$s1] = get_sub_field('question',$course_object);
                                    $course_state_answer[$s2] = get_sub_field('answer',$course_object);
                                    $s1++;
                                    $s2++;
                                }
                            endwhile;
                        endif;
                        if(!empty($course_logistic_question) && !empty($course_logistic_answer)){ 
                            $count = count($course_logistic_question); ?>
                            <table class="class-dt" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th colspan="2" align="center">
                                            <strong>COURSE LOGISTICS</strong>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $y = 0;
                                        while($y < $count){ ?>
                                            <tr>
                                                <td width="30%"><?php echo $course_logistic_question[$y]; ?></td>
                                                <td><?php echo $course_logistic_answer[$y]; ?></td>
                                            </tr>
                                        <?php $y++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        <?php } ?>
                        <?php if(!empty($course_state_question) && !empty($course_state_answer)){
                            $count2 = count($course_state_question); ?>
                            <table class="class-dt" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th colspan="2" align="center">
                                            <strong>State Requirements</strong>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $z = 0;
                                        while($z < $count2){ ?>
                                            <tr>
                                                <td width="30%"><?php echo $course_state_question[$z]; ?></td>
                                                <td><?php echo $course_state_answer[$z]; ?></td>
                                            </tr>
                                        <?php $z++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer();
