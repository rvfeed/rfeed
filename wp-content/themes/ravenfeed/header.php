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
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
   <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" />
	<?php //wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=158618337568274&version=v2.0";
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
    <section id="ccr-nav-top" class="fullwidth">
        <div class="">
            <div class="container">
                <nav class="top-menu">
                    <ul class="left-top-menu">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#">Site Map</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul><!-- /.left-top-menu -->

                    <ul class="right-top-menu pull-right">
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Register</a></li>
                        <li><a href="#">Subscribe</a></li>
                        <li>
                            <form class="form-inline" role="form" action="#">
                                <input type="search" placeholder="Search here..." required>
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
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand1">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" style = "width:250px" alt="Raven Feed Logo" />
                   </a>
            </div> <!-- / .navbar-header -->

            <div class="add-space">
                728 x 90 px Banner
            </div> <!-- / .adspace -->

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
                <?php wp_nav_menu( array( 'menu_class' => 'nav navbar-nav' ) ); ?>
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

                <div id="currentTime" class="pull-right current-time">
                    <i class="fa fa-clock-o"></i> 12:10 pm


                </div><!-- / #currentTime -->

            </div>    <!-- /.container -->
        </nav> <!-- /.main-menu -->
    </section> <!-- / #ccr-nav-main -->





</header> <!-- /#ccr-header -->


<section id="ccr-main-section">
    
