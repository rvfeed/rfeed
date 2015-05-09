<?php
/**
 * Created by PhpStorm.
 * User: raj
 * Date: 21/4/15
 * Time: 5:17 PM
 */
?>
<li>
    <div class="imgleft">
        <a href=" <?php the_permalink(); ?> >">
            <?php echo the_post_thumbnail( 'front-side-thumb');?>
        </a>
        <!--<p><a href="<?php /*echo get_permalink( $post_health->ID); */?>">Read More</a></p>-->
    </div>
    <div class="textright">
        <h4><a href=" <?php the_permalink(); ?> "><?=the_title()?></a></h4>
        <?php the_excerpt(); ?>
    </div>
</li>