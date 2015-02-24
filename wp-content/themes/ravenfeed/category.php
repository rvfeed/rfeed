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
      <div class="current-page">

            <span class="cat-links">  <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa fa-home"></i> <i class="fa fa-angle-double-right"></i></a><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) ); ?></span>

            </div>
    <section id="ccr-category-1">

                    
 
                         <div class="ccr-category-featured">       
                            <?php if ( have_posts() ) : ?>

                <?php
                    // Start the Loop.
                    while ( have_posts() ) : the_post();
                    ?>
                            
                                      <div class="ccr-thumbnail">
                                      <?php echo get_the_post_thumbnail(); ?> 
                                      </div>
                        <?php
                    /*
                     * Include the post format-specific template for the content. If you want to
                     * use this in a child theme, then include a file called called content-___.php
                     * (where ___ is the post format) and that will be used instead.
                     */
                    get_template_part( 'content', get_post_format() );
                          ?> <div style="clear:both"></div><?php 
                    endwhile;
                    // Previous/next page navigation.
                    twentyfourteen_paging_nav();

                else :
                    // If no content, include the "No posts found" template.
                    get_template_part( 'content', 'none' );

                endif;
            ?>

                    </div> <!-- /#ccr-category-featured -->
            
   
                </section>
		
              </section>
       <?php get_sidebar(); ?>
         </div><!-- /.container -->
     </section><!-- #main-content -->  
<?php
get_footer();
