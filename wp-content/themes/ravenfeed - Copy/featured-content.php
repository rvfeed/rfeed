<?php
$custom_query_args = array(
    'post_type'  => 'post',
    'meta_key'   => '_is_ns_featured_post',
    'meta_value' => 'yes',
    'cat' => 10,
    'posts_per_page'   =>5,
);
// Get current page and append to custom query parameters array
$custom_query_args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

$custom_query = new WP_Query( $custom_query_args ); ?>
<?php
// Pagination fix
global $wp_query;
$temp_query = $wp_query;
$wp_query   = NULL;
$wp_query   = $custom_query;
?>

<section id="ccr-sports-gallery" class="row">
  <!--  <div class="ccr-gallery-ttile">
        <span></span>
        <p>Sports Gallery</p>
    </div>--> <!-- .ccr-gallery-ttile -->
    <div class="col-md-7 col-left">
    <?php if ( $custom_query->have_posts() ) : ?>

            <!-- the loop -->
            <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

                <section class="col-md-12">
                    <div class="featured-sports-newss-img">
                        <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail("right-feature-thumb");?>
                    </a></div>
                    <div class="featured-sports-news-post">
                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <?php the_excerpt(); ?>
                        <span class="author-time">
                                <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago by '; ?>
                                <?php the_author_posts_link() ?>
                            <a href="<?php the_permalink(); ?>#disqus_thread">
                                <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?>. </a>
                        </span>



                        <!--  <div class="like-comment-readmore">-->
                         <!--   <i class="fa fa-thumbs-o-up"> 08</i>
                            <a href="#" class="comments"><i class="fa fa-comments-o"></i> 49</a>-->
                           <!-- <a class="read-more" href="<?php /*the_permalink(); */?>">Read More</a>
                        </div>--> <!-- /.like-comment-readmore -->
                    </div>
                </section> <!-- /#featured-sports-news -->

            <?php endwhile;?>
            <?php  endif;?>

        </div>


    <?php $args = array(
        'post_type'  => 'post',
        'meta_key'   => '_is_ns_featured_post',
        'meta_value' => 'yes',
        'posts_per_page'   =>10,
        'offset' =>1
    );
    $posts_health = get_posts( $args );?>
    <div class="col-md-5 col-right">
        <ul>
            <?php foreach($posts_health as $post_health):
                if (has_post_thumbnail( $post_health->ID ) ): ?>
                    <li>
                        <div>
                            <?php echo get_the_post_thumbnail($post_health->ID , 'front-side-thumb');?>
                            <!--<p><a href="<?php /*echo get_permalink( $post_health->ID); */?>">Read More</a></p>-->
                        </div>
                        <h4><a href="<?php echo get_permalink( $post_health->ID); ?>"><?=$post_health->post_title?></a></h4>
                         <span class="author-time">
                                <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago by '; ?>
                            <?php the_author_posts_link() ?>
                            <a href="<?php the_permalink(); ?>#disqus_thread">
                                <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?>. </a>
                        </span>

                    </li>
                <?php endif; ?>
            <?php endforeach;?>
        </ul>
        </div>

</section>


<?php $args = array(
    'posts_per_page'   =>20,
    'offset'           => 0,
    'category'         => '10',
    'meta_key'   => '_is_ns_featured_post',
    'meta_value' => 'yes',
    'orderby'          => 'post_date',
    'order'            => 'DESC',
    'post_type'        => 'post',
    'post_status'      => 'publish',
    'suppress_filters' => true
);
/*$posts_health = get_posts( $args );*/?><!--
<section id="ccr-latest-post-gallery">
    <div class="ccr-gallery-ttile">
        <span></span>
        <p>You also Love</p>
    </div>--><!-- .ccr-gallery-ttile -->
<!--    <ul class="ccr-latest-post">
        <?php /*foreach($posts_health as $post_health):
            if (has_post_thumbnail( $post_health->ID ) ): */?>
                <li>
                    <div class="ccr-thumbnail">
                        <?php /*echo get_the_post_thumbnail($post_health->ID , 'feature-thumb');*/?>
                        <p><a href="<?php /*echo get_permalink( $post_health->ID); */?>">Read More</a></p>
                    </div>
                    <h4><a href="<?php /*echo get_permalink( $post_health->ID); */?>"><?/*=$post_health->post_title*/?></a></h4>
                </li>
            <?php /*endif; */?>
        <?php /*endforeach;*/?>
    </ul><!-- /.ccr-latest-post -->

<!-- </section>--> <!--  /#ccr-latest-post-gallery  -->