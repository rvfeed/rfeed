<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
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
    if ( is_front_page() ) {
        // Include the featured content template.
        get_template_part( 'featured-content' );
    }
?>   
         </section>
       <?php get_sidebar(  ); ?>
         </div><!-- /.container -->
     </section><!-- #main-content -->  
   

 


	


<?php
//get_sidebar();
get_footer();
