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
<main>
    <?php get_template_part( 'inc/page-banner' ); ?>
    <section class="content pt-0 content-projects">
        <div class="container">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post(); ?>
                    <div class="project-block">
                        <p><strong>Service:</strong> <?php the_field('service'); ?><br class="d-block"><strong>Facility Type:</strong> <?php the_field('facility_type'); ?></p>
                        <p class="mb-0"><strong>Description: </strong></p>
                        <?php $content = get_the_content(); 
                        echo '<p>'.$content.'</p>'; ?>
                    </div>
                <?php endwhile;
            endif; ?>
        </div>
    </section>
</main>
<?php get_footer();
