<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
    <div class="container" style="margin-top:20px">
    <section id="ccr-left-section" class="col-md-8 search-feed" >
	<section id="primary" class="content-area">
		<div id="content" class="site-content tag-feed" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<h2 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'twentyfourteen' ), single_tag_title( '', false ) ); ?></h2>

				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .archive-header -->
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
						get_template_part( 'content', 'tag' );

					endwhile;?>
                </ul>
    <?php
					// Previous/next page navigation.
					twentyfourteen_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
		</div><!-- #content -->
	</section><!-- #primary -->
    </section><!-- #main-content -->
        <?php get_sidebar(  ); ?>
    </div><!-- /.container -->


<?php
/*get_sidebar( 'content' );
get_sidebar();*/
get_footer();
