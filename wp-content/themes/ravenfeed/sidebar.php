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
            <section id="social-buttons">
                 <ul>
                     <li>
                         <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>

                        <p><span class="bubble"></span><span class="count">202</span> Like</p>
                     </li>
                     <li>
                         <a href="#"  class="linkedin"><i class="fa fa-linkedin"></i></a>
                        <p><span class="bubble"></span><span class="count">202</span> Like</p>
                     </li>
                     <li>
                         <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                        <p><span class="bubble"></span><span class="count">202</span> Follow</p>
                     </li>
                     <li>
                         <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                        <p><span class="bubble"></span><span class="count">202</span> Like</p>
                     </li>
                 </ul>
                    
            </section>  <!-- /#social-buttons -->
                           <section id="ccr-sidebar-add-place">
                <div class="sidebar-add-place">
                    336x280 px
                </div> 
            </section>
   
                   <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
   
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
   
    <?php endif; ?>
   
     
          
            <section id="sidebar-entertainment-post">
                <div class="ccr-gallery-ttile">
                    <span></span> 
                    <p><strong>Entertainment</strong></p>
                </div> <!-- .ccr-gallery-ttile -->

                <div class="sidebar-entertainment">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/entertainment.jpg" alt="entertainment">
                    <a href="#">Miss Joly loves you to share her tell. Are you ready?</a>
                </div>
                <div class="date-like-comment">
                    <a href="#" class="like"><i class="fa fa-thumbs-o-up"></i> 08</a>
                    <a href="#" class="comments"><i class="fa fa-comments-o"></i> 49</a>
                </div>
            </section>  <!-- /#sidebar-entertainment-post -->


 <!-- /#ccr-sidebar-add-place -->


            <section id="ccr-sidebar-newslater">
                
                <div class="ccr-gallery-ttile">
                    <span></span> 
                    <p><label for="sb-newslater"><strong>Newslater</strong></label></p>
                </div> <!-- .ccr-gallery-ttile -->
                
                <div class="sidebar-newslater-form">
                    <form class="ccr-gallery-ttile" action="#">
                        <input type="email" id="sb-newslater" name="sb-newslater" placeholder="Enter your email address" required>
                        <button type="submit">Subscribe</button>

                    </form>
                </div> <!-- /.sidebar-newslater-form -->
                
            </section> <!-- /#ccr-sidebar-newslater -->

            <section id="ccr-find-on-fb">
                <div class="find-fb-title">
                    <span><i class="fa fa-facebook"></i></span> Find us on Facebook
                </div> <!-- /.find-fb-title -->
                <div class="find-on-fb-body">

                    <div class="fb-like-box" data-href="https://www.facebook.com/ravenfeed/" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>

                </div> <!-- /.find-on-fb-body -->
            </section> <!-- /#ccr-find-on-fb -->


        </aside><!-- / .col-md-4  / #ccr-right-section -->
