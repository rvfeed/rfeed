<?php
/**
 * The template for displaying featured content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>


                <?php $args = array(
                    'posts_per_page'   =>3,
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
                            <p>Health</p>
                        </div><!-- .ccr-gallery-ttile -->
                        <ul class="ccr-latest-post">
                            <?php foreach($posts_health as $post_health):
                                if (has_post_thumbnail( $post_health->ID ) ): ?>
                            <li>
                                <div class="ccr-thumbnail">
                                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_health->ID ), 'single-post-thumbnail' ); ?>
                                    <img src="<?php echo $image[0]; ?>" alt="<?=$post_health->post_title?>" height="220"/>
                                    <p><a href="<?php echo get_permalink( $post_health->ID); ?>">Read More</a></p>
                                </div>
                                <h4><a href="<?php echo get_permalink( $post_health->ID); ?>"><?=$post_health->post_title?></a></h4>
                            </li>
                            <?php endif; ?>
                            <?php endforeach;?>
                        </ul><!-- /.ccr-latest-post -->
                    
                </section> <!--  /#ccr-latest-post-gallery  -->
                <?php $args = array(
                    'posts_per_page'   =>3,
                    'offset'           => 0,
                    'category'         => '6',
                    'orderby'          => 'post_date',
                    'order'            => 'DESC',
                    'post_type'        => 'post',
                    'post_status'      => 'publish',
                    'suppress_filters' => true
                );
                $posts_psych = get_posts( $args );?>
            <section id="ccr-latest-post-gallery">
                <div class="ccr-gallery-ttile">
                    <span></span>
                    <p>Psychology</p>
                </div><!-- .ccr-gallery-ttile -->
                <ul class="ccr-latest-post">
                    <?php foreach($posts_psych as $post_psych):
                        if (has_post_thumbnail( $post_health->ID ) ): ?>
                            <li>
                                <div class="ccr-thumbnail">
                                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_psych->ID ), 'single-post-thumbnail' ); ?>
                                    <img src="<?php echo $image[0]; ?>" alt="<?=$post_psych->post_title?>" height="220"/>
                                    <p><a href="<?php echo get_permalink( $post_psych->ID); ?>">Read More</a></p>
                                </div>
                                <h4><a href="<?php echo get_permalink( $post_psych->ID); ?>"><?=$post_psych->post_title?></a></h4>
                            </li>
                        <?php endif; ?>
                    <?php endforeach;?>
                </ul><!-- /.ccr-latest-post -->

</section> <!--  /#ccr-latest-post-gallery  -->
                
                <section class="bottom-border">
                </section> <!-- /#bottom-border -->




                <section id="ccr-world-news">
                    <div class="ccr-gallery-ttile">
                            <span></span> 
                            <p>World News</p>
                    </div> <!-- .ccr-gallery-ttile -->
                    
                    <section class="featured-world-news">
                        <div class="featured-world-news-img"><img src="<?php echo get_template_directory_uri(); ?>/images/thumbnail-big1.jpg" alt="Thumb"></div>
                        <div class="featured-world-news-post">
                        <h5>Featured World News Post Title</h5>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro, quod, nostrum, corrupti, maxime quis doloribus debitis id consectetur laudantium iure aperiam soluta consequuntur modi accusamus molestias. Ab veniam atque eius...
                            <div class="like-comment-readmore">
                                <i class="fa fa-thumbs-o-up"> 08</i>
                                <a href="#" class="comments"><i class="fa fa-comments-o"></i> 49</a>
                                <a class="read-more" href="#">Read More</a>
                            </div> <!-- /.like-comment-readmore -->
                        </div>
                    </section> <!-- /#featured-world-news -->


                    <ul>
                        <li>
                            
                                <div class="ccr-thumbnail">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/thumbnail-small-1.jpg" alt="thumbnail-small-1.jpg">
                                    <p><a href="#postlink">Read More</a></p>
                                </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                                <div class="ccr-thumbnail">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/thumbnail-small-2.jpg" alt="thumbnail-small-1.jpg">
                                    <p><a href="#postlink">Read More</a></p>
                                </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                                <div class="ccr-thumbnail">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/thumbnail-small-3.jpg" alt="thumbnail-small-1.jpg">
                                    <p><a href="#postlink">Read More</a></p>
                                </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                                <div class="ccr-thumbnail">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/thumbnail-small-4.jpg" alt="thumbnail-small-1.jpg">
                                    <p><a href="#postlink">Read More</a></p>
                                </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                                <div class="ccr-thumbnail">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/thumbnail-small-5.jpg" alt="thumbnail-small-1.jpg">
                                    <p><a href="#postlink">Read More</a></p>
                                </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                                <div class="ccr-thumbnail">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/thumbnail-small-6.jpg" alt="thumbnail-small-1.jpg">
                                    <p><a href="#postlink">Read More</a></p>
                                </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                                <div class="ccr-thumbnail">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/thumbnail-small-7.jpg" alt="thumbnail-small-1.jpg">
                                    <p><a href="#postlink">Read More</a></p>
                                </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                                <div class="ccr-thumbnail">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/thumbnail-small-8.jpg" alt="thumbnail-small-1.jpg">
                                    <p><a href="#postlink">Read More</a></p>
                                </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                    </ul>

                </section> <!-- / #ccr-world-news -->




                <section class="bottom-border"></section>

                <section id="ccr-sports-gallery">
                    <div class="ccr-gallery-ttile">
                            <span></span> 
                            <p>Sports Gallery</p>
                    </div> <!-- .ccr-gallery-ttile -->

                    <section class="featured-sports-news">
                        <div class="featured-sports-newss-img"><img src="<?php echo get_template_directory_uri(); ?>/images/sports-thumb-1.jpg" alt="Thumb"></div>
                        <div class="featured-sports-news-post">
                        <h5>Featured Sports News Post Title</h5>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro, quod, nostrum, corrupti, maxime quis doloribus debitis id consectetur laudantium iure aperiam soluta consequuntur modi accusamus molestias. Ab veniam atque eius...
                            <div class="like-comment-readmore">
                                <i class="fa fa-thumbs-o-up"> 08</i>
                                <a href="#" class="comments"><i class="fa fa-comments-o"></i> 49</a>
                                <a class="read-more" href="#">Read More</a>
                            </div> <!-- /.like-comment-readmore -->
                        </div>
                    </section> <!-- /#featured-sports-news -->

                    <ul>
                        <li>
                            
                            <div class="ccr-thumbnail">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/sports-thumb-2.jpg" alt="thumbnail-small-1.jpg">
                                <p><a href="#postlink">Read More</a></p>
                            </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                            <div class="ccr-thumbnail">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/sports-thumb-3.jpg" alt="thumbnail-small-1.jpg">
                                <p><a href="#postlink">Read More</a></p>
                            </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                            <div class="ccr-thumbnail">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/sports-thumb-4.jpg" alt="thumbnail-small-1.jpg">
                                <p><a href="#postlink">Read More</a></p>
                            </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                            <div class="ccr-thumbnail">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/sports-thumb-5.jpg" alt="thumbnail-small-1.jpg">
                                <p><a href="#postlink">Read More</a></p>
                            </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                            <div class="ccr-thumbnail">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/sports-thumb-6.jpg" alt="thumbnail-small-1.jpg">
                                <p><a href="#postlink">Read More</a></p>
                            </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                            <div class="ccr-thumbnail">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/sports-thumb-7.jpg" alt="thumbnail-small-1.jpg">
                                <p><a href="#postlink">Read More</a></p>
                            </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                            <div class="ccr-thumbnail">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/sports-thumb-8.jpg" alt="thumbnail-small-1.jpg">
                                <p><a href="#postlink">Read More</a></p>
                            </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                            <div class="ccr-thumbnail">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/sports-thumb-9.jpg" alt="thumbnail-small-1.jpg">
                                <p><a href="#postlink">Read More</a></p>
                            </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                            <div class="ccr-thumbnail">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/sports-thumb-10.jpg" alt="thumbnail-small-1.jpg">
                                <p><a href="#postlink">Read More</a></p>
                            </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                        <li>
                            
                            <div class="ccr-thumbnail">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/sports-thumb-11.jpg" alt="thumbnail-small-1.jpg">
                                <p><a href="#postlink">Read More</a></p>
                            </div>
                            <h5><a href="#">Lorem ipsum is simply dummy text...</a></h5>
                        </li>
                    </ul>                    
                
                </section> <!-- /#ccr-sports-gallery -->

                <section class="bottom-border"></section>
