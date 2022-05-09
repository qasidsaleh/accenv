<?php 
/*
    * Template Name: News
*/
get_header(); ?>
    <main id="main">
        <?php get_template_part( 'inc/page-banner' ); ?>
        <section class="training-contain content pt-0 pb-3">
            <div class="container">
                <?php $blog = array(
                    'post_type' => 'news',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC',
                );
                $the_query = new WP_Query( $blog );
                if( $the_query->have_posts() ):
                    while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <div class="news-block mb-5">
                            <p><strong><?php the_title(); ?></strong></p>
                            <?php the_content(); ?>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </section>
    </main>
<?php get_footer(); ?>