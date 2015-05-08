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
<div class="container">
      <section id="ccr-left-section" class="col-md-8">
     <?php
/**
 * The template for displaying featured content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php
$custom_query_args = array(
    'post_type'  => 'post',
    'meta_key'   => '_is_ns_featured_post',
    'meta_value' => 'yes',
    'cat' => 10
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

<section id="ccr-sports-gallery">
					<div class="ccr-gallery-ttile">
							<span></span>
							<p>Sports Gallery</p>
					</div> <!-- .ccr-gallery-ttile -->
<?php if ( $custom_query->have_posts() ) : ?>
    <div class="cat-right-thumb">
    <!-- the loop -->
    <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

        <section class="featured-sports-news">
            <div class="featured-sports-newss-img"><?php the_post_thumbnail("cat-feature-thumb");?></div>
            <div class="featured-sports-news-post">
                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <?php the_excerpt(); ?>
                <div class="like-comment-readmore">
                    <i class="fa fa-thumbs-o-up"> 08</i>
                    <a href="#" class="comments"><i class="fa fa-comments-o"></i> 49</a>
                    <a class="read-more" href="<?php the_permalink(); ?>">Read More</a>
                </div> <!-- /.like-comment-readmore -->
            </div>
        </section> <!-- /#featured-sports-news -->

    <?php endwhile;?>
    </div>
<?php  endif;?>

<?php $args = array(
    'posts_per_page'   =>20,
    'offset'           => 0,
    'category'         => '10',
    'orderby'          => 'post_date',
    'order'            => 'DESC',
    'post_type'        => 'post',
    'post_status'      => 'publish',
    'suppress_filters' => true
);
$posts_health = get_posts( $args );?>
<div class="cat-left-thumb">
					<ul>
					<?php foreach($posts_health as $post_health):
    if (has_post_thumbnail( $post_health->ID ) ): ?>
				        <li>
            <div class="ccr-thumbnail">
                <?php echo get_the_post_thumbnail($post_health->ID , 'thumb');?>
                <p><a href="<?php echo get_permalink( $post_health->ID); ?>">Read More</a></p>
            </div>
            <h4><a href="<?php echo get_permalink( $post_health->ID); ?>"><?=$post_health->post_title?></a></h4>
        </li>
    <?php endif; ?>
<?php endforeach;?>
					</ul></div>

				</section>


<?php $args = array(
    'posts_per_page'   =>20,
    'offset'           => 0,
    'category'         => '10',
    'orderby'          => 'post_date',
    'order'            => 'DESC',
    'post_type'        => 'post',
    'post_status'      => 'publish',
    'suppress_filters' => true
);
$posts_health = get_posts( $args );?>
                    <section id="ccr-latest-post-gallery">
                        <div class="ccr-gallery-ttile">
                            <span></span>
                            <p>You also Love</p>
                        </div><!-- .ccr-gallery-ttile -->
                        <ul class="ccr-latest-post">
                            <?php foreach($posts_health as $post_health):
    if (has_post_thumbnail( $post_health->ID ) ): ?>
        <li>
            <div class="ccr-thumbnail">
                <?php echo get_the_post_thumbnail($post_health->ID , 'feature-thumb');?>
                <p><a href="<?php echo get_permalink( $post_health->ID); ?>">Read More</a></p>
            </div>
            <h4><a href="<?php echo get_permalink( $post_health->ID); ?>"><?=$post_health->post_title?></a></h4>
        </li>
    <?php endif; ?>
<?php endforeach;?>
                        </ul><!-- /.ccr-latest-post -->

                </section> <!--  /#ccr-latest-post-gallery  -->
  <!--              <?php /*$args = array(
                    'posts_per_page'   =>6,
                    'offset'           => 0,
                    'category'         => '6',
                    'orderby'          => 'post_date',
                    'order'            => 'DESC',
                    'post_type'        => 'post',
                    'post_status'      => 'publish',
                    'suppress_filters' => true
                );
                $posts_psych = get_posts( $args );*/?>
            <section id="ccr-latest-post-gallery">
                <div class="ccr-gallery-ttile">
                    <span></span>
                    <p>Psychology</p>
                </div><!-- .ccr-gallery-ttile -->
<!--    <ul class="ccr-latest-post">
                    <?php /*foreach($posts_psych as $post_psych):
                        if (has_post_thumbnail( $posts_psych->ID ) ): */?>
                            <li>
                                <div class="ccr-thumbnail">
                                    <?php /*$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_psych->ID ), 'medium' ); */?>
<?php /*echo get_the_post_thumbnail($post_psych->ID , 'feature-thumb');*/?>
                                    <p><a href="<?php /*echo get_permalink( $post_psych->ID); */?>">Read More</a></p>
                                </div>
                                <h4><a href="<?php /*echo get_permalink( $post_psych->ID); */?>"><?/*=$post_psych->post_title*/?></a></h4>
                            </li>
                        <?php /*endif; */?>
<?php /*endforeach;*/?>
                </ul><!-- /.ccr-latest-post -->
<!--
</section> <!--  /#ccr-latest-post-gallery  -->


                <section class="bottom-border"></section>


              </section>
       <?php get_sidebar(); ?>
         </div><!-- /.container -->
     </section><!-- #main-content -->

<?php
get_footer();
