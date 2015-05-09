<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<div class="container" style="margin-top: 20px">
<?php
$custom_query_args1 = array(
    'post_type'  => 'post',
    'meta_key'   => '_is_ns_featured_post',
    'meta_value' => 'yes',
    'cat' => $cat,
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

      <section id="ccr-left-section" class="col-md-8" style="padding:0px">

<section>
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
        <!--            <div class="featured-sports-news-post">
                <h5><a href="<?php /*the_permalink(); */?>"><?php /*the_title(); */?></a></h5>
                <?php /*the_excerpt(); */?>
                <span class="author-time">
                                <?php /*echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago by '; */?>
                    <?php /*the_author_posts_link() */?>
                    <a href="<?php /*the_permalink(); */?>#disqus_thread">
                        <?php /*comments_number( '0 Comments', '1 Comment', '% Comments' ); */?>. </a>
                        </span>



                <!--  <div class="like-comment-readmore">-->
        <!--   <i class="fa fa-thumbs-o-up"> 08</i>
           <a href="#" class="comments"><i class="fa fa-comments-o"></i> 49</a>-->
        <!-- <a class="read-more" href="<?php /*the_permalink(); */?>">Read More</a>
                        </div>--> <!-- /.like-comment-readmore
            </div>-->
        <!-- /#featured-sports-news -->

    <?php endwhile;?>
<?php  endif;?>

    </div>

</section>

                  <?php $args = array(
    'posts_per_page'   =>20,
    'offset'           => 1,
    'meta_key'   => '_is_ns_featured_post',
    'meta_value' => 'yes',
    'category'         => $cat,
    'orderby'          => 'post_date',
    'order'            => 'DESC',
    'post_type'        => 'post',
    'post_status'      => 'publish',
    'suppress_filters' => true
);
$posts_health = get_posts( $args );
$featured_post_ids = array()
//print_r($posts_health);?>
                        <section class="cat-feature-feed">
                            <!-- .ccr-gallery-ttile -->
                            <ul>
                                <?php foreach($posts_health as $post_health):
        array_push($featured_post_ids, $post_health->ID);
    if (has_post_thumbnail( $post_health->ID ) ): ?>
        <li>
            <div class="imgleft">
                <?php echo get_the_post_thumbnail($post_health->ID , 'feature-thumb');?>
            </div>
            <div class="textright">
                <a href="<?php echo get_permalink( $post_health->ID); ?>"><?=$post_health->post_title?></a>
                <br/>
                <?php echo $post_health->post_excerpt; ?>
            </div>         <div class="author-time" style>
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

                        </section><!--  /#ccr-latest-post-gallery  -->


                <!--<section class="bottom-border"></section>-->
               <?php $args = array(
    'posts_per_page'   =>20,
    'offset'           => 0,
    'category'         => $cat,
    'post__not_in'     => $featured_post_ids,
    'orderby'          => 'post_date',
    'order'            => 'DESC',
    'post_type'        => 'post',
    'post_status'      => 'publish',
    'suppress_filters' => true
);
$posts_health = get_posts( $args );
//print_r($posts_health);?>
                        <section class="cat-main-feed main-feed">
                            <!-- .ccr-gallery-ttile -->
                            <ul>
                                <?php foreach($posts_health as $post_health):
    if (has_post_thumbnail( $post_health->ID ) ): ?>
        <li>
            <div class="imgleft">
                <?php echo get_the_post_thumbnail($post_health->ID , 'front-side-thumb');?>
            </div>
            <div class="textright">

                <?php //print_r($post_health);
                 $sumfield = simple_fields_values('sumfield', $post_health->ID);
                ?>
                <p><a href="<?php echo get_permalink( $post_health->ID); ?>"><?=$post_health->post_title?></a></p>
                <p><?php echo $sumfield[0]?></p>
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
                        </section><!--  /#ccr-latest-post-gallery  -->

              </section>
       <?php get_sidebar(); ?>
         </div><!-- /.container -->
     </section><!-- #main-content -->

<?php
get_footer();
