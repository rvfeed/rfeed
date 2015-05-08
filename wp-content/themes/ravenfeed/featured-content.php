<?php
$custom_query_args1 = array(
    'post_type'  => 'post',
    'meta_key'   => '_is_ns_featured_post',
    'meta_value' => 'yes',
    'posts_per_page'   =>1,
);
// Get current page and append to custom query parameters array
$custom_query_args1['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

$custom_query1 = new WP_Query( $custom_query_args1 ); ?>
<?php
// Pagination fix
global $wp_query1;
$temp_query1 = $wp_query1;
$wp_query1   = NULL;
$wp_query1   = $custom_query1;
?>
<section class="main-banner">

    <!-- .ccr-gallery-ttile -->
    <div class="col-md-12 col-left" style="padding:0px">
        <?php if ( $custom_query1->have_posts() ) : ?>

            <!-- the loop -->
            <?php while ( $custom_query1->have_posts() ) : $custom_query1->the_post(); ?>


                <div class="featured-sports-newss-img feature-img">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail("banner-feature-thumb");?>
                        <h2><span><?php the_title()?></span></h2>
                    </a></div>


            <?php endwhile;?>
        <?php  endif;?>

    </div>

</section>
<?php $args = array(
    'post_type'  => 'post',
    'meta_key'   => '_is_ns_featured_post',
    'meta_value' => 'yes',
    // 'posts_per_page'   =>10,
    'offset' => 0
);
$featured_post_ids = array();
$posts_feature = get_posts( $args );?>

        <?php foreach($posts_feature as $post_feature):
            array_push($featured_post_ids, $post_feature->ID);
        endforeach;
        ?>

<section id="ccr-sports-gallery" class="row">
  <!--  <div class="ccr-gallery-ttile">
        <span></span>
        <p>Sports Gallery</p>
    </div>--> <!-- .ccr-gallery-ttile -->
    <div class="col-md-8 col-left">


            <!-- the loop -->


                <section class="col-md-12">
                        <?php $args = array(
                            'posts_per_page'   =>10,
                            'offset'           => 0,
                            'post__not_in'     => $featured_post_ids,
                            'orderby'          => 'post_date',
                            'order'            => 'DESC',
                            'post_type'        => 'post',
                            'post_status'      => 'publish',
                            'suppress_filters' => true
                        );
                        $posts_health = get_posts( $args );?>
                        <section class="main-feed">
                            <!-- .ccr-gallery-ttile -->
                            <ul id="main-feed">
                                <?php foreach($posts_health as $post_health):
                                    if (has_post_thumbnail( $post_health->ID ) ): ?>
                                        <li>
                                            <div class="imgleft">
                                                <a href="<?php echo get_permalink( $post_health->ID); ?>">
                                            <?php echo get_the_post_thumbnail($post_health->ID , 'feature-thumb');?>
                                                    </a>
                                            </div>
                                            <div class="textright">
                                            <p><a href="<?php echo get_permalink( $post_health->ID); ?>"><?=$post_health->post_title?></a></p>
                                                <div class="author-time" style>
                                                    <span id='time-img' class="ok"'></span>
                                                    <span class="ok"> <?php echo human_time_diff( get_the_time('U', $post_health->ID), current_time('timestamp') ) . ' ago by '; ?></span>
                                                    <?php $author_id = $post_health->post_author; ?>
                                                    <span id='auth-img' class="ok"></span>
                                                    <a class="ok" href="<?php echo get_author_posts_url( get_the_author_meta($post_health->ID ) ); ?>">
                                                        <?php echo the_author_meta( 'user_nicename' , $author_id ); ?> </a>
                                                    <span class="ok" id='comment-img'></span>
                                                    <a class="ok" href="<?php echo get_permalink($post_health->ID); ?>#disqus_thread">
                                                        <?php echo get_comments_number( $post_health->ID, '' ); ?> </a>
                                                </div>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach;?>
                            </ul><!-- /.ccr-latest-post -->
                           <div>
                                <div class="loading" ></div>
                               </div>
                        </section><!--  /#ccr-latest-post-gallery  -->
                  <!--  </div>-->
                </section> <!-- /#featured-sports-news -->



        </div>


    <?php $args = array(
        'post_type'  => 'post',
        'meta_key'   => '_is_ns_featured_post',
        'meta_value' => 'yes',
       // 'posts_per_page'   =>10,
        'offset' =>1
    );
    $posts_feature = get_posts( $args );?>
    <div class="col-md-4 col-right">
        <ul>
            <?php foreach($posts_feature as $post_feature):
                if (has_post_thumbnail( $post_feature->ID ) ): ?>
                    <li>
                        <div>
                            <a href="<?php echo get_permalink( $post_feature->ID); ?>">
                            <?php echo get_the_post_thumbnail($post_feature->ID , 'front-side-thumb');?>
                                </a>
                            <!--<p><a href="<?php /*echo get_permalink( $post_health->ID); */?>">Read More</a></p>-->
                        </div>
                        <h4><a href="<?php echo get_permalink( $post_feature->ID); ?>"><?=$post_feature->post_title?></a></h4>
                          <div class="author-time" style>
                               <span id='time-img' class="ok"'></span>
                               <span class="ok"> <?php echo human_time_diff( get_the_time('U', $post_feature->ID), current_time('timestamp') ) . ' ago by '; ?></span>
                              <?php $author_id = $post_feature->post_author; ?>
                              <span id='auth-img' class="ok"></span>
                              <a class="ok" href="<?php echo get_author_posts_url( get_the_author_meta($post_feature->ID ) ); ?>">
                                  <?php echo the_author_meta( 'user_nicename' , $author_id ); ?> </a>
                               <span class="ok" id='comment-img'></span>
                                                    <a class="ok" href="<?php echo get_permalink($post_feature->ID); ?>#disqus_thread">
                                                        <?php echo get_comments_number( $post_feature->ID, ''); ?> </a>
                        </div>

                    </li>
                <?php endif; ?>
            <?php endforeach;?>
        </ul>
        </div>

</section>


