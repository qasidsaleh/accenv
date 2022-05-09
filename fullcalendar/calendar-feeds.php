<?php
/*
* See: https://wordpress.stackexchange.com/questions/1447/
*
*/
include "wp-load.php";
global $wpdb;
//header('Content-Type:application/json');
$events = array();
$result = new WP_Query('post_type=product&posts_per_page=-1');
	foreach($result->posts as $post) {
		$post_id = $post->ID;
		$post_title = $post->post_title;
		$post_url = get_permalink();
		$post_course = get_field('course',$post_id);
		$post_course_title = get_term($post_course)->name;
		$post_class_date1 = get_field('class_date',$post_id);
		$post_class_date = date("Y-m-d", strtotime($post_class_date1));
	  	$events[] = array(
	  		'dot_color' => '<strong style="background:#198aec;width:5px;height:5px;color:#fff;">1 </strong>',
	    	'title'   => $post_course_title,
	    	'url'  	  => $post_url,
	    	'start'   => $post_class_date.'T10:00:00',
	    	// 'end'     => '2021-12-28T10:00:00',
	    );
	}
	echo json_encode($events);
// exit;

// [
//   {
//     "title": "Long Event",
//     "start": "2021-12-29",
//     "end": "2021-12-29"
//   },
// ]

?>