<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	    <div class="container">
         <section id="ccr-left-section" class="col-md-8 search-feed" >
			<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyfourteen' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->
                <br/>
<ul>
				<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
                        echo get_post_format();
						get_template_part( 'search', "results" );

					endwhile;?>
                </ul>
                <?php
					// Previous/next post navigation.
					twentyfourteen_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
 </section><!-- #main-content -->
                <?php get_sidebar(  ); ?>
         </div><!-- /.container -->


<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
