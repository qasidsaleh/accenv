
<?php 
  $id = get_the_ID();
  if(is_singular('project')){
    $id = 13;
  }
  $banner_image = get_field('banner_image',$id);
  $title = get_field('page_title');
  if(empty($title)){
    $title = get_the_title();
  }
  $icon = get_field('page_title_icon');
  if(is_singular('product')){
    $banner_image = get_home_url().'/wp-content/themes/accenv/images/banner1.jpg';
    $title = 'TRAINING CLASSES';
    $icon = get_home_url().'/wp-content/themes/accenv/images/icon-pencil.png';
  } 
  if(is_404()){
    $banner_image = get_home_url().'/wp-content/themes/accenv/images/banner1.jpg';
    $title = '404';
    $icon = get_home_url().'/wp-content/themes/accenv/images/icon-i.png';
  }
  if(is_singular('project')){
    $title = 'Projects';
  }
  if(is_search()){
    $banner_image = get_home_url().'/wp-content/themes/accenv/images/banner1.jpg';
    $title = 'Search Results';
    $icon = get_home_url().'/wp-content/themes/accenv/images/icon-i.png';
  }
  if(is_taxonomy('Venues')){
    $id = 690; // Classes Page ID
    $banner_image = get_home_url().'/wp-content/themes/accenv/images/banner1.jpg';
    $title = 'ENROLLMENT CLASSES';
  }
  if(is_account_page()){
    if(is_user_logged_in()){
      $title = 'My Account';
    } else {
      $title = 'Login';
    }
  }
?>
<section class="page_banner"> 
	<img src="<?php echo $banner_image; ?>" class="img-fluid" alt="ACC Environmental"> 
</section>
<div class="sticky-popup">
  <a href="#" class="btn-open"><?php the_field('sticky_btn1','options'); ?></a>
  <a href="#" class="btn-close"><?php the_field('sticky_btn1','options'); ?></a>
  <div class="inner-slide">
    <h3><?php the_field('sticky_btn1','options'); ?></h3>
    <p>Please fill the form below and we will contact you soon.</p>
    <?php echo do_shortcode('[contact-form-7 id="132" title="Request Proposal"]'); ?>
  </div>
  <a href="<?php the_field('sticky_btn2_link','options'); ?>" class="btn-request"><?php the_field('sticky_btn2','options'); ?></a>
</div>
<section class="content-header">
	<div class="container">
		<div class="row align-items-center inner">
      		<div class="col-sm-7">
        		<div class="row">
          			<h1 class="mainTitle mb-0">
                  <?php if(!empty($icon)){ ?>
                    <img src="<?php echo $icon; ?>" class="img-fluid me-2" alt="Icon Mark">
                  <?php } else { ?>
               			<img src="<?php bloginfo('template_url'); ?>/images/icon-i.png" class="img-fluid me-2" alt="Icon Mark">
                  <?php } ?>
                  	<span><?php echo $title; ?></span>
              		</h1>
        		</div>
      		</div>
      		<div class="col-sm-5">
 				<div class="row">
  					<div class="col-sm-4 p-sm-0">
  						<a href="<?php echo get_page_link(19); ?>">
  							<span>Contact Us</span>
  							<img src="<?php bloginfo('template_url'); ?>/images/email.jpg" alt="Email icon" class="img-fluid">
  						</a>
  					</div>
            <?php if(!is_cart() && !is_checkout()){ ?>
     					<div class="col-sm-4 p-sm-0">
     						<a data-bs-toggle="modal" href="#sharefriend" role="button">
     							<span>Send to Friends</span>
     							<img src="<?php bloginfo('template_url'); ?>/images/face.jpg" alt="Face icon" class="img-fluid">
     						</a>
     					</div>
            <?php } ?>
  					<div class="col-sm-4 p-sm-0">
  						<a onclick="window.print()" href="#">
  							<span>Print</span>
  							<img src="<?php bloginfo('template_url'); ?>/images/print.jpg" alt="Print icon" class="img-fluid">
  						</a>
  					</div>
  				</div>
 			</div>
 		</div>
 	</div>
	<!-- Modal -->
	<div class="modal fade sharefriend" id="sharefriend" aria-hidden="true" aria-labelledby="sharefriendLabel" tabindex="-1">
	  	<div class="modal-dialog modal-dialog-centered">
	    	<div class="modal-content">
	      		<div class="modal-header">
	      			<h5>Share</h5>
	        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      		</div>
	      		<div class="modal-body">
	      			<span>Please fill out the fields below to share this page</span>
	      			<?php echo do_shortcode('[contact-form-7 id="6" title="Share Friend"]'); ?>
	      		</div>
	    	</div>
	  	</div>
	</div>
</section>