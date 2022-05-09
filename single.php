<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage accenv
 */
get_header();
 ?>
<?php  
    $page_id = 21;
    $banner_image = get_field('banner_image',$page_id);
    $banner_heading = get_field('banner_heading',$page_id);
    $banner_content = get_field('banner_description',$page_id);
?>
<div class="banner" id="banner">
    <img src="<?php echo $banner_image; ?>" class="img-fluid w-100" alt="">
    <div class="banner-caption">
        <h1 data-aos="fade-up" data-aos-duration="1500"><?php echo $banner_heading; ?></h1>
        <p data-aos="fade-up" data-aos-duration="1500"><?php echo $banner_content; ?></p>
    </div>
</div>
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
            <section class="content simple-content" data-aos="fade-right" data-aos-duration="1500">
                <div class="container">
                    <div class="blog-image pull-left pr-md-5">
                        <img src="<?php the_field('post_large_image'); ?>" class="img-fluid mb-3" alt="">
                    </div>
                    <div class="blog-content">
                        <?php the_field('detail_content'); ?>
                    </div>
                </div>
            </section>
        <?php endwhile;
    endif; ?>

<?php get_footer();
