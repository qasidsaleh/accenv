	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<!-- Option 1: Bootstrap Bundle with Popper -->
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">	</script>  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  	<script src="<?php bloginfo('template_url'); ?>/js/owl.carousel.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.main.js"></script>
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src='<?php bloginfo('template_url'); ?>/fullcalendar/main.js'></script>
	<!-- <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script> -->
	<script type="text/javascript">
        jQuery(window).load(function() {
            jQuery('.loader').removeClass("d-block");
            jQuery('.loader').addClass("d-none");
            //AOS.init();
        });
    </script>
	<script type="text/javascript">
		$(window).scroll(function() {    
		    var scroll = $(window).scrollTop();
		    if (scroll >= 100) {
		        $("header").addClass("fixed");
		    } else {
		    	$("header").removeClass("fixed");
		    }
		});
	</script>
	<script type="text/javascript">
		jQuery('.projects .owl-carousel').owlCarousel({
            loop:false,
            dots:false,
            nav:true,
            navText:["<div class='nav-btn prev-slide'><img src='<?php bloginfo("template_url"); ?>/images/left-arrow.png' class='img-fluid' alt=''></div>","<div class='nav-btn next-slide'><img src='<?php bloginfo("template_url"); ?>/images/right-arrow.png' class='img-fluid' alt=''></div>"],
            margin:50,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                1000:{
                    items:3
                }
            }
        });
	</script>
	<script type="text/javascript">
		$('.side-nav.services a[href="#"]').click(function() {
		  	$(this).toggleClass('active');
		  	$('.side-nav.services li.current_page_item').parent('ul').parent('li').parent('ul').removeClass('active');
			$('.side-nav.services li.current_page_item').parent('ul').removeClass('active');
		  	return false;
		});
		$('.side-nav.services li.current_page_item').parent('ul').parent('li').parent('ul').addClass('active');
		$('.side-nav.services li.current_page_item').parent('ul').parent('li').parent('ul').parent('li').addClass('active');
		$('.side-nav.services li.current_page_item').parent('ul').addClass('active');
		$('.side-nav.services li.current_page_item').parent('ul').parent('li').addClass('active');
		$('li.active > a').addClass('active');
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('.sticky-popup .btn-close').click(function(){
				$(this).parent().addClass("closed");
				$(this).parent().removeClass("opened");
			});
		});
		$(document).ready(function () {
			var windowsize = $(window).width();
		  	if (windowsize > 767) {
				$('.sticky-popup .btn-open').click(function(){
					$(this).parent().removeClass("closed");
					$(this).parent().addClass("opened");
				});
			} else {
				$('.sticky-popup .btn-open').click(function(){
					$(this).parent().toggleClass("opened");
				});
			}
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#tbl_classes').DataTable();
		} );
	</script>
	<script type="text/javascript">
		var city;
		var course;
		function changefilter(){
			city = $("#class_city").val();
			course = $("#course").val();
			//var table1 = $('#tbl_classes').DataTable();
			//table1.search(city).draw();
		}
		var table = $('#tbl_classes').DataTable(
			{"paging":false, "info":false, responsive: true,   "language": {
				"lengthMenu": "Display _MENU_ enrollment classes per page",
				"zeroRecords": "No enrollment classes available",
				"info": "Showing page _PAGE_ of _PAGES_",
				"infoEmpty": "No enrollment classes available",
				"infoFiltered": "(filtered from _MAX_ total enrollment classes)"
			},
			"columnDefs": [ {
				"targets": [-1,-3],
				"sortable": false
			},{
				"targets": [0],
				"type": "date",
				"createdCell": function (td, cellData, rowData, row, col) {
					if($(td).text().length == 10) {
						var col_date = new Date($(td).text()).toUTCString();
						var utc_array = col_date.split(" ");
						var utc_day = utc_array[0].replace(",", "");
						var utc_text_date = utc_array[2]+" "+utc_array[1]+", "+utc_array[3] +" ("+utc_day+")";
						var data_b = $(td).attr("data-ndate");
						if(data_b.length) {
							$(td).html(utc_text_date+"- <br />"+data_b);
						} else {
							$(td).html(utc_text_date);
						}
					}
				}
			}
			]
		});
		if(city != "") {
			table
			.columns( 1 )
			.search( city )
			.draw();
		}
		if(course != "") {
			table
			.columns( 2 )
			.search( course )
			.draw();
		}
		$('.tbl_filter').on( 'change', function () {
			var col_index = parseInt($(this).attr("data-index"));
			table
			.columns( col_index )
			.search( this.value )
			.draw();
		} );
	</script>
	<?php
	  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	  $taxonomy_name = 'Venues';
	  $taxonomy_id = get_queried_object()->term_id;
	  $taxonomy = get_term($taxonomy_id, $taxonomy_name);
	  $venuecity = get_field('city',$taxonomy);
	  $venuestate = get_field('state',$taxonomy);
	  $class_city1 = $venuestate.' - '.$venuecity;
	  if(!empty($class_city1)){
	?>
		<script type="text/javascript">
			var venusearch = '<?php echo $class_city1; ?>';
	    	table.columns(1).search(venusearch).draw();
	  	</script>
	<?php } ?>
	<script type="text/javascript">
		function changefilter2(){
			var diff_class_url = $("#diff_class").val();
			window.location.href = diff_class_url;
		}
	</script>
	<script type="text/javascript">
	    var $selected_qty1 = 1;
	    var $selected_qty;
	    jQuery("#qtyField").change(function(){
	        $selected_qty = jQuery("#qtyField option:selected").val();
	        var oldUrl = $('#register-now').attr("href"); // Get current url
	        var newUrl = oldUrl.replace("&quantity="+$selected_qty1, "&quantity="+$selected_qty);
	        jQuery('#register-now').attr("href", newUrl);
	        $selected_qty1 = $selected_qty;
	    });
	</script>
	<script type="text/javascript">
		jQuery( "#show_sv_info" ).click(function() {
			jQuery(".show_sv_content").toggleClass("removed");
			jQuery(".show_sv_content").toggleClass("show");
			return false;
		});
	</script>
	<script type="text/javascript">
        document.addEventListener( 'wpcf7mailsent', function( event ) {
            location = '<?php echo get_page_link(769); ?>';
        }, false );
	</script>
	<?php wp_footer(); ?>
</body>
</html>