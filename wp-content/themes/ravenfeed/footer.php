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


                <?php wp_nav_menu( array( 'menu' => 'footermenu' ) ); ?>


        <div class="copyright">
             &copy; 2015, Copyrights. All Rights Reserved
         </div> <!-- /.copyright -->


    </div> <!-- /.container -->
</footer>  <!-- /#ccr-footer -->
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        var offset = 20;
        var stopLoad = false;
        $("#top-search").click(function(){
            $("#search-box").focus();
        });
        $("#srch-btn").click(function(){
            $("#search-box").css('style', "border:1px solid #f00;");
        });
  $(window).bind('scroll', function() {

    var navHeight = 180; // custom nav height
      var current_page    =   1;
      var loading         =   false;
      var oldscroll       =   0;
    ($(window).scrollTop() > navHeight) ? $('#ccr-nav-main').addClass('goToTop').slideDown() : $('#ccr-nav-main').removeClass('goToTop');
     ($(window).scrollTop() > navHeight) ? $('.et_social_sidebar_networks').show(500) : $('.et_social_sidebar_networks').hide(500);
      <?php  //echo urlencode(wp_get_shortlink());?>
    //  alert($(window).scrollTop() );
      if( $(window).scrollTop() > oldscroll ){
        //  alert("k")//if we are scrolling down
          if( ($(window).scrollTop() + $(window).height() >= $(document).height()  )  ) {
              if( ! loading  && ! stopLoad){
                  loading = true;
                  $('.loading').show();
                  $.post(ajax_object.ajaxurl, {
                      action: 'ajax_action',
                      offset: offset,
                      ex: $('#noid').val()
                  }, function(data) {
                      if(data.trim() == "0"){
                          $('.loading').hide();
                          stopLoad = true;
                      }else{
                          $('#main-feed').append(data); // alerts 'ajax submitted'
                          offset += 10;
                          ///alert(offset);
                          $('.loading').hide("")
                          loading = false;
                      }

                  });
              }
          }
      }

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
/*    var offset = 10;
    $('.target').click(function () {
        $.post(ajax_object.ajaxurl, {
            action: 'ajax_action',
            offset: offset
        }, function(data) {
            $('#main-feed').append(data); // alerts 'ajax submitted'
            offset += 10;
        });
    });*/
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
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	<?php wp_footer(); ?>
</body>
</html>