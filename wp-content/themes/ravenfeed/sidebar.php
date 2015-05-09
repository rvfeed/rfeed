<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php
/**
 * The template for displaying posts in the Aside post format
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
   
  <aside id="ccr-right-section" class="col-md-4 ccr-home">

      <div class="sidebar-add-place">
          336x280 px
      </div>
      <aside class="connect-widget">
          <div class="sh-side">
              <a href="<?php echo site_url(); ?>/user-submitted-posts ">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/pen.png"  />
                  Write an Article
              </a>
          </div>
        <div class="fb-side">
            <a target="_blank" href="http://www.facebook.com/ravenfeed" target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png"  />
              Like Us On Facebook
          </a>
        </div>

          <div class="tt-side">
          <a href="http://www.twitter.com/ravnfeed" target="_blank">
<img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" />
              Follow Us On Twitter
          </a>
               </div>
      </aside>

      <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
   
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
   
    <?php endif; ?>



