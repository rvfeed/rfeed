<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<article id="ccr-article" <?php post_class(); ?>>
  
	<header class="entry-header">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && twentyfourteen_categorized_blog() ) : ?>

		<?php
			endif;

			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>

		<div class="entry-meta">
			<?php
				if ( 'post' == get_post_type() )
					twentyfourteen_posted_on();

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'ravenfewd' ), __( '1 Comment', 'twentyfourteen' ), __( '% Comments', 'twentyfourteen' ) ); ?></span>
			<?php
				endif;

				edit_post_link( __( 'Edit', 'ravenfeed' ), '<span class="edit-link">', '</span>' );
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : ?>
        <li>
            <div class="imgleft">
                <?php echo get_the_post_thumbnail($post_health->ID , 'feature-thumb');?>
            </div>
            <div class="textright">
                <a href="<?php echo get_permalink(); ?>"><?php the_title()?></a>
                <br/>
                <?php the_excerpt(); ?>
            </div> <span class="author-time">
                                <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago by '; ?>
                <?php the_author_posts_link() ?>
                <a href="<?php the_permalink(); ?>#disqus_thread">
                    <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?>. </a>
                        </span>
        </li>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">      
        <br style="clear:both"/>
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

/*			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );*/
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', ' ', '</span></footer>' ); ?>
</article><!-- #post-## -->
