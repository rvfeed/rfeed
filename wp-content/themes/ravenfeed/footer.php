<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

		</div><!-- #main -->

<footer id="ccr-footer">
    <div class="container">
         <div class="copyright">
             &copy; 2014, Copyrights <a href="http://codexcoder.com">CodexCoder</a> Theme. All Rights Reserved
         </div> <!-- /.copyright -->

         <div class="footer-social-icons">
             <ul>
                 <li>
                     <a href="#"  class="google-plus"><i class="fa fa-google-plus"></i></a>
                 </li>
                 <li >
                     <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                 </li>
                 <li >
                     <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                 </li>
                 <li >
                     <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                 </li>
             </ul>
             
         </div><!--  /.cocial-icons -->

    </div> <!-- /.container -->
</footer>  <!-- /#ccr-footer -->
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>
	<?php wp_footer(); ?>
</body>
</html>