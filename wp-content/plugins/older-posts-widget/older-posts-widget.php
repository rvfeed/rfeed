<?php
/*
Plugin Name: Older Posts Widget
Plugin URI: http://techallica.com
Description: A widget to show specific number of older posts.
Author: Techallica
Author URI: http://techallica.com/wordpress-older-posts-widget/
Version: 2.0
*/

/* ======= Custom extension of the Recent Posts Widget ======== */
class GHGPostWidget extends WP_Widget {
  function GHGPostWidget()
  {
    parent::WP_Widget(false, 'Older Posts Widget ');
  }
  function form($instance)
  {
    /* Set up some default widget settings. */
    $defaults = array( 'title' => 'Older Posts', 'posts_start' => '10', 'num_posts' => '15');
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
   
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
      <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" style="width:100%"/>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('posts_start'); ?>">Start from post #:</label>
      <input id="<?php echo $this->get_field_id('posts_start'); ?>" name="<?php echo $this->get_field_name('posts_start'); ?>" value="<?php echo $instance['posts_start']; ?>" style="width:40px;" /> <br/><b>Tip:</b> If you want the widget to start displaying from the 10th oldest post, then enter 10
    </p>
	<p>
      <label for="<?php echo $this->get_field_id('num_posts'); ?>">Number of posts to show:</label>
      <input id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" value="<?php echo $instance['num_posts']; ?>" style="width:40px;" />
    </p>
<?php

  }
  function update($new_instance, $old_instance)
  {
    return $new_instance;
  }
  function widget($args, $instance)
  {
    extract( $args );

    /* User-selected settings. */
    $title = apply_filters('widget_title', $instance['title'] );
    $posts_start = $instance['posts_start'];
	$num_posts = $instance['num_posts'];

    /* Before widget (defined by themes). */
    echo $before_widget;

    /* Title of widget (before and after defined by themes). */
    if ( $title )  {
        ?>
              <section id="sidebar-older-post">
                <div class="ccr-gallery-ttile">
                    <span></span> 
                    <p><strong><?=$title?></strong></p>
                </div> <!-- .ccr-gallery-ttile -->
              
        <?php
    }
  

    GHGPostWidget::getOlderPosts($posts_start,$num_posts);
	
    /* After widget (defined by themes). */
    echo $after_widget;

  }
  function getOlderPosts($posts_start,$num_posts)
  {
    global $wpdb;
	$posts_start = $posts_start - 1;
    $sql = "select * from ".$wpdb->posts." where post_status='publish' and post_type='post' order by post_date desc limit ".$posts_start.",".$num_posts;
    $posts = $wpdb->get_results($sql);
    if (count($posts) >= 1 )
    {
      $postArray = array();
      foreach ($posts as $post)
      {
        wp_cache_add($post->ID, $post, 'posts');
        $postArray[] = array('title' => stripslashes($post->post_title), 'url' => get_permalink($post->ID));
      }
         ?>       
                   
    <?php  echo '<ul>';
      foreach ($postArray as $post)
      { ?>
                <li>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/sports-thumb-10.jpg" alt="Avatar">
                        <a href="#"><?php
                                                 echo '<a href="'.$post['url'].'" title="'.$post['title'].'">'.$post['title'].'</a>';
                                        ?></a>
                            </li>
  
    <?php  }
      echo '</ul>';  ?>
      </section>
      <?php
    }
  }
}

function ghg_register_widget()
{
    register_widget('GHGPostWidget');
}

function ghg_load_plugin()
{
    add_action( 'widgets_init', 'ghg_register_widget' );
}

add_action( 'plugins_loaded', 'ghg_load_plugin' );
?>
