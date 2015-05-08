<?php
/**
 * Created by PhpStorm.
 * User: raj
 * Date: 21/4/15
 * Time: 6:40 PM
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
        <h3><a href=" <?php the_permalink(); ?> "><?=the_title()?></a></h3>
        <?php the_excerpt()?>
    </div>
</li>