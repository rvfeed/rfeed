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
<!-- child of the body tag -->
<span id="top-link-block" class="hidden">
    <a href="#top" class="well-sm" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
     <img src="<?php echo get_template_directory_uri(); ?>/images/gototop.png" sixe="30" alt=""/>
    </a>
</span><!-- /top-link-block -->
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
    <script type="text/javascript">
    $(document).ready(function(){

  $(window).bind('scroll', function() {

    var navHeight = 180; // custom nav height

    ($(window).scrollTop() > navHeight) ? $('#ccr-nav-main').addClass('goToTop').slideDown() : $('#ccr-nav-main').removeClass('goToTop');
     ($(window).scrollTop() > navHeight) ? $('.et_social_sidebar_networks').show(500) : $('.et_social_sidebar_networks').hide(500);
      <?php  //echo urlencode(wp_get_shortlink());?>

  });
        var l = $(".et_social_inline li.et_social_twitter a").attr("href");

       // var matches = l.replace(/[\&url\=.*\&]/g, "url=<?php echo urlencode(wp_get_shortlink());?>&via");
        var newText = l.replace(/(url=).*?(&)/,'$1' + "<?php echo urlencode(wp_get_shortlink());?>" + '$2');
        $(".et_social_inline li.et_social_twitter a").attr("href", newText);
        $(".et_social_sidebar_networks li.et_social_twitter a").attr("href", newText);
        $("<li class='share-toggle'><div>+</div></li>").insertBefore(".et_social_inline li:nth-child(3)");
        $("<li class='share-toggle-minus'><div>-</div></li>").insertAfter(".et_social_inline li:last-child");
        $(".share-toggle").click(function(){
            $(".et_social_inline  li:nth-child(n+4)").show();
            $(".share-toggle").hide();
            //$(".share-toggle-minus").show(100);
        });
        $(".share-toggle-minus").click(function(){
            $(".et_social_inline  li:nth-child(n+4)").hide();
            $(".share-toggle").show();
            //$(".share-toggle-minus").show(100);
        });

});

// Only enable if the document has a long scroll bar
// Note the window height + offset
if ( ($(window).height() + 100) < $(document).height() ) {
    $('#top-link-block').removeClass('hidden').affix({
        // how far to scroll down before link "slides" into view
        offset: {top:100}
    });
}


  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60761080-1', 'auto');
  ga('send', 'pageview');

</script>

	<?php wp_footer(); ?>
</body>
</html>