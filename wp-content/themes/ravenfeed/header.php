<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
    <meta property="fb:app_id" content="406535182857298"/>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
    <?php wp_head(); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-theme.min.css">
     <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Muli">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
   <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" />
    <!-- Place this tag in your head or just before your close body tag. -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <!-- Place this tag where you want the +1 button to render. -->

</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = 'ravenfeed';

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=406535182857298&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!--<div id="page" class="hfeed site">
	<?php if ( get_header_image() ) : ?>
	<div id="site-header">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		</a>
	</div>
	<?php endif; ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="header-main">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

			<div class="search-toggle">
				<a href="#search-container" class="screen-reader-text"><?php _e( 'Search', 'twentyfourteen' ); ?></a>
			</div>

			<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
				<button class="menu-toggle"><?php _e( 'Primary Menu', 'twentyfourteen' ); ?></button>
				<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'twentyfourteen' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			</nav>
		</div>

		<div id="search-container" class="search-box-wrapper hide">
			<div class="search-box">
				<?php get_search_form(); ?>
			</div>
		</div>
	</header><!-- #masthead -->
<header id="ccr-header">
   <section id="ccr-nav-top"  class="fullwidth" style="display:none;">
        <div class="">
            <div class="container">
                <nav class="top-menu">
                    <ul class="left-top-menu">
                       <!-- <li><a href="<?php /*echo site_url(); */?>">Home</a></li>
                        <li><a href="#">Site Map</a></li>-->
                        <li><a href="<?php echo site_url(); ?>/contact-us">Contact</a></li>
                    </ul><!-- /.left-top-menu -->

                        <ul class="footer-social-icons">
                            <li>
                                <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>

     <ul class="right-top-menu pull-right">
                           <form role="search" method="get" class="search-form" action="<?php echo site_url(); ?>">
                                <input type="search" name="s" placeholder="Search here..." required>
                                  <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </li>
                    </ul> <!--  /.right-top-menu -->
         </nav> <!-- /.top-menu -->
      </div>
    </div>
</section> <!--  /#ccr-nav-top  -->


    
    <section id="ccr-site-title">
        <div class="container">
            <div class="site-logo">
                <a href="<?php echo site_url(); ?>" class="navbar-brand1">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" style = "width:250px" alt="Raven Feed Logo" />
                   </a>
            </div> <!-- / .navbar-header -->
            <div class="pageHead1">
                <p class="pageHeadText"></p>
                <a id="googlePlus" class="smallSocialIcon" href="https://plus.google.com/u/0/b/113567368876177697816/113567368876177697816/posts" target="_blank"></a>
                <a id="twitter" class="smallSocialIcon" href="https://twitter.com/ravnfeed" target="_blank"></a>
                <a id="facebook" class="smallSocialIcon" href="https://www.facebook.com/ravenfeed" target="_blank"></a>
               <!-- <div id="searchDiv">
                    <form method="get" action="<?php /*echo esc_url( home_url( '/' ) ); */?>">
                        <input id="search" name="s" placeholder="SEARCH" type="text">
                        <input value="" class="searchIcon" type="submit"> </form>
                </div>-->
            </div>
          <div class="add-space">
                728 x 90 px Banner
            </div><!-- / .adspace -->

        </div>    <!-- /.container -->
    </section> <!-- / #ccr-site-title -->



    <section id="ccr-nav-main">
        <nav class="main-menu">
            <div class="container">

                <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".ccr-nav-main">
                            <i class="fa fa-bars"></i>
                          </button> <!-- /.navbar-toggle -->
                </div> <!-- / .navbar-header -->

                <div class="collapse navbar-collapse ccr-nav-main">
                <?php wp_nav_menu( array( 'menu' => 'ravenwp', 'menu_class' => 'nav navbar-nav' ) ); ?>
                    <!--<ul class="nav navbar-nav">
                        <li><a class="active" href="index.html">Home</a></li>
                        <li class="dropdown">
                            <a href="#">Blog <i class="fa fa-caret-down"></i></a>
                            <ul class="sub-menu">
                                  <li><a href="blog.html">Blog 1</a></li>
                                  <li><a href="blog-2.html">Blog 2</a></li>
                                  <li><a href="blog-3.html">Blog 3</a></li>
                            </ul><!-- /.sub-menu -->
                        </li><!-- /.dropdown -->
                        <!--<li><a href="single.html">Single</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li class="dropdown"><a href="#">Category <i class="fa fa-caret-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="category-1.html">Category 1</a></li>
                                <li><a href="category-2.html">Category 2</a></li>
                                <li><a href="#">More <i class="fa fa-caret-right"></i></a>
                                    <ul class="sub-menu-2">
                                        <li><a href="#">Demo Link 1</a></li>
                                        <li><a href="#">Demo Link 2</a></li>
                                        
                                        <li><a href="#">More <i class="fa fa-caret-right"></i></a>
                                            <ul class="sub-menu-3">
                                                <li><a href="#">Demo Link 1</a></li>
                                                <li><a href="#">Demo Link 2</a></li>
                                                <li><a href="#">Demo Link 3</a></li>
                                            </ul><!-- /.sub-menu-3 -->
                                   <!--     </li>
                                        <li><a href="#">Demo Link 3</a></li>
                                    </ul><!-- /.sub-menu-2 -->
                               <!-- </li>
                            </ul><!-- /.sub-menu -->
                   <!--     </li><!--  /.dropdown -->
                     <!--   <li><a href="404.html">404</a></li>
                    </ul>--> <!-- /  .nav -->
                </div><!-- /  .collapse .navbar-collapse  -->
<div class="social-bar" style="margin-top: 12px">
                <div class="fb-like topfblike" data-href="http://www.facebook.com/ravenFeed" data-layout="button_count"
                     data-layout="button_count" data-width="48" data-height="20"  data-action="like" data-show-faces="true"
                     class="fb-like fb_iframe_widget" data-send="false" fb-xfbml-state="rendered"></div>
                <a href="https://twitter.com/ravnfeed" class="twitter-follow-button" data-show-count="true" data-show-screen-name="false">Follow @ravnfeed</a>
                <div class="g-plusone" data-size="medium" data-href="https://plus.google.com/113567368876177697816/posts"></div>

</div>
                <!--<div id="currentTime" class="pull-right current-time">+ Send a Raven-->
                 <!--   <i class="fa fa-clock-o"></i>-->


                </div><!-- / #currentTime -->

            </div>    <!-- /.container -->
        </nav> <!-- /.main-menu -->
    </section> <!-- / #ccr-nav-main -->





</header> <!-- /#ccr-header -->



<section id="ccr-main-section">
