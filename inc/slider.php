<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-interval="5000" data-bs-ride="carousel">
	<?php if( have_rows('banner') ): ?>
		<div class="carousel-indicators d-none d-lg-flex">
			<?php $count = 0; while( have_rows('banner') ): the_row();  ?>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $count; ?>" class="<?php if($count==0){echo 'active';}?>" aria-current="true" aria-label="Slide <?php echo $count;  ?>"></button>
			<?php $count++; endwhile; ?>
		</div>
		<div class="carousel-inner">
			<?php $count = 0; while( have_rows('banner') ): the_row();
			$banner_image = get_sub_field('banner_image');
			?>
			<div class="carousel-item <?php if($count==0){echo 'active';}?>">
				<img src="<?php echo $banner_image; ?>" class="d-block w-100" alt="Image <?php echo $count; ?>">
			</div>
			<?php $count++; endwhile; ?>
		</div>
	<?php endif; ?>
</div>
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