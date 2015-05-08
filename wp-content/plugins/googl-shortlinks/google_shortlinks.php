<?php
/**
 * @package Goo.gl_Shortlinks
 * @version 0.1
 */
/*
Plugin Name: Goo.gl Shortlinks
Plugin URI: http://christophercochran.me/googl-shortlinks
Description: Allows automatic url shortening of post links using goo.gl Services using the API recently provided by Google. Changes the output of <?php the_shortlink(); ?> as a goo.gl short URL.
Author: Christopher Cochran
Version: 1.0
Author URI: http://christophercochran.me
*/

add_action('admin_menu', 'cc_googl_short_it_settings');
function cc_googl_short_it_settings() {
   add_submenu_page('options-general.php', 'Goo.gl Shortlinks', 'Goo.gl Shortlinks Settings', 8, 'gslsettings', 'cc_googl_short_it_settings_p');
}

add_action('admin_init', 'cc_googl_short_it_settings_init' );
function cc_googl_short_it_settings_init(){
	register_setting( 'cc_googl_short_it_options', 'gurl_api_key', 'cc_googl_short_it_options_validate' );
}

function cc_googl_short_it_options_validate($input) {
	$input['key_txt'] =  wp_filter_nohtml_kses($input['key_txt']);
	return $input;
}
function cc_googl_short_it_settings_p() { ?>
	<div id="message" class="updated fade">
	  <p><strong> <?php _e('Options saved.', 'cc_gsl' ); ?> </strong></p>
	</div>
	<div class="wrap">
		<h2><?php _e( 'Goo.gl Shortlinks Settings', 'cc_gsl' ); ?></h2>
		<form method="post" action="options.php">
			<?php settings_fields('cc_googl_short_it_options'); ?>
			<?php $settings = get_option('gurl_api_key'); ?>

			<lable>API Key: </lable><input type="text" size="45" name="gurl_api_key[key_txt]" value="<?php echo $settings['key_txt']; ?>" />
			<p class="description"> Enter your <a href="https://code.google.com/apis/console/">Google API Key</a> above for the URL Shortener API. </p>
			<p class="submit">
            	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>

		</form>
	</div>
<?php }

function cc_googl_get_data($args = array(), $api_key = '' ) {
	if ( !class_exists("Services_JSON")) {
		require_once(ABSPATH . '/wp-includes/class-json.php');
	}
	$wp_json = new Services_JSON();
	$options = get_option('gurl_api_key');
	if ( $api_key ) {
		$api_key = '?key='.$api_key; 
	}
	$url = 'https://www.googleapis.com/urlshortener/v1/url'. $api_key;
	$body = $wp_json->encodeUnsafe($args);
	$options = array('method' => 'POST', 'timeout' => 3, 'body' => $body);
			$options['headers'] = array(
					'Content-Type' => 'application/json',
					'Content-Length' => strlen($body),
					'User-Agent' => 'WordPress/' . get_bloginfo("version"),
					'Referer' => get_bloginfo("url")
			);
	$result = wp_remote_retrieve_body(wp_remote_request( $url, $options ));	
	$googdata = json_decode( $result );
	$shortlink = $googdata->id;
	return $googdata->id; 
} //end cc_googl_get_data

add_filter('get_shortlink','cc_get_googl_short_it');
function cc_get_googl_short_it() {	
	$settings = get_option('gurl_api_key'); 
	$shortlink = '';
	$post = get_post($id);
	$post_id = $post->ID;
	$post_url = get_permalink( $post_id );
	
	$args = array(
		'longUrl' => $post_url
	);
	
	//Retrieve cached short URL
	$shortlink = get_post_meta( $post->ID, '_google_short_url', true );
	if ( $shortlink ) {
		return $shortlink;
	} else {
		$shortlink = cc_googl_get_data($args, $settings['key_txt']);
		update_post_meta( $post_id, '_google_short_url', $shortlink );	
	}
}
add_action('save_post', 'cc_googl_post_save');
function  cc_googl_post_save( $post_id ) {
		//Retrieve the post object - If a revision, get the original post ID
		$revision = wp_is_post_revision( $post_id );
		if ( $revision )	
			$post_id = $revision;
		$post = get_post( $post_id );
		
		$args = array(
			'longUrl' => get_permalink( $post->ID )
		);
		$settings = get_option('gurl_api_key');
		$goog_url = cc_googl_get_data($args, $settings['key_txt']);
		update_post_meta( $post_id, '_google_short_url', $goog_url );
	} //end post_save
?>