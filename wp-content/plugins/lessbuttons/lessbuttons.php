<?php
/*
Plugin Name: LessButtons
Plugin URI: https://lessbuttons.com/plugins/wordpress/
Description: Social media share buttons with integrated analytics. Automatically display buttons for those social networks, where visitor registered.
Version: 1.5.1
Author: Chris Clark
Author URI: https://lessbuttons.com/
Text Domain: lessbuttons
*/
$lessbuttons_version = '1.5.1'; // url-safe version string
$lessbuttons_date = '2014-10-6'; // date this version was released, beats a version #

/*
Copyright 2014 Chris Clark (support@lessbuttons.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

$lessbuttons_files = Array(
	'lessbuttons.php',
);

add_action( 'plugins_loaded', 'lessbuttons_load_textdomain' );
function lessbuttons_load_textdomain() {
  load_plugin_textdomain( 'lessbuttons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}

add_action( 'wp_footer', 'lessbuttons_outside_html' );
function lessbuttons_outside_html() {
	
	if (!lessbuttons_testConditionals ()) return;
	
	if (!(is_single() || is_page()) || get_option('lessbuttons_placement_inside') =="inline_other") {
		
		if (get_option('lessbuttons_placement_outside') == "left") $position = "left";
		if (get_option('lessbuttons_placement_outside') == "right") $position = "right";
		if (get_option('lessbuttons_placement_outside') == "bottom") $position = "bottom";

		$c = "<div id=\"lessbuttons_holder\"></div>"
				."<script async src=\"https://lessbuttons.com/script.js"
				."?position=" . urlencode ($position)
				.lessbuttons_onmobileParameter ()
				.lessbuttons_listUrlButtons ()
				.lessbuttons_zindexParameter ()
				."\"></script>";
				
		echo $c;
	}
}

function lessbuttons_inside_html ($html) {
	
	if (!lessbuttons_testConditionals ()) return $html;
	
	global $lessbuttons_version;

	// Load the post's data
	$blogname = urlencode(get_bloginfo('wpurl'));
	global $wp_query; 
	$post = $wp_query->post;
	$permalink = get_permalink($post->ID);
	$title = $post->post_title;
	
	$placement = get_option('lessbuttons_placement_inside');
	
	$position = "inline";
		
	$c = "<div id=\"lessbuttons_holder\"></div>"
."<script async src=\"https://lessbuttons.com/script.js"
."?position=" . urlencode ($position)
.lessbuttons_onmobileParameter ()
.lessbuttons_listUrlButtons ()
.lessbuttons_zindexParameter ()
."\"></script>";
	
	if ($placement == "inline_before") $html = $c . "\n" . $html;
	if ($placement == "inline_after") $html =  $html . "\n" . $c;

	return $html;
}

// Hook the_content to output html if we should display on any page
$lessbuttons_contitionals = get_option('lessbuttons_placement_inside');
if ($lessbuttons_contitionals == "inline_before" || $lessbuttons_contitionals == "inline_after") {
	add_filter('the_content', 'lessbuttons_display_hook');
	add_filter('the_excerpt', 'lessbuttons_display_hook');	
}

function lessbuttons_display_hook($content='') {
	$conditionals = get_option('lessbuttons_placement_inside');
	if (	(is_single()) or
		(is_page()) or
		0)
		$content = lessbuttons_inside_html($content);
	
	return $content;
}

function lessbuttons_listUrlButtons () {
	$a = array ();
	$b = get_option('lessbuttons_placement_custom_buttons');
	if (is_array ($b)) {
		foreach ($b as $k => $v) {
			if ($v == "1") {
				$a []= "&" . urlencode ($k) . "=1";
			}
			if ($v == "auto") {
				$a []= "&" . urlencode ($k) . "=auto";
			}
		}
	}
	return join ("", $a);
}

function lessbuttons_onmobileParameter () {
	$m = get_option('lessbuttons_placement_onmobile');
	$mob = "bottom";
	if ($m == "rest") $mob = "other";
	if ($m == "hide") $mob = "hide";
	return "&onmobile=" . urlencode ($mob);
}

function lessbuttons_zindexParameter () {
	$zIndex = get_option('lessbuttons_zindex');
	if (preg_match ("|(\-?\d+)|", $zIndex, $ar)) {
		$zIndex = (int) $ar [1];
		return "&zindex=" . urlencode ($zIndex);
	}
	return "";
}
	
function lessbuttons_getConditionals () {
	$conditionals = get_option('lessbuttons_conditionals');
	
	if (!is_array ($conditionals)) {
		$conditionals = array (
			'is_home' => True,
			'is_single' => True,
			'is_page' => True,
			'is_category' => True,
			'is_date' => True,
			'is_search' => True,
			);
		update_option('lessbuttons_conditionals', $conditionals);
	}
	return $conditionals;
}

function lessbuttons_testConditionals () {
	
	$conditionals = lessbuttons_getConditionals ();

	if ((is_home()     and $conditionals['is_home']) or
		(is_single()   and $conditionals['is_single']) or
		(is_page()     and $conditionals['is_page']) or
		(is_category() and $conditionals['is_category']) or
		(is_date()     and $conditionals['is_date']) or
		(is_search()   and $conditionals['is_search']) or
		0) {
			return true;
	}
	
	return false;
}

add_filter( 'plugin_action_links_' . plugin_basename (__FILE__), 'lessbuttons_add_action_links');
function lessbuttons_add_action_links ( $links ) {
	$mylinks = array(
		'<a href="' . admin_url( 'options-general.php?page=LessButtons' ) . '">'. __("Settings", 'lessbuttons') . '</a>',
	);
	return array_merge($mylinks,  $links);
}

// Plugin config/data setup
if (function_exists('register_activation_hook')) {
	// for WP 2
	register_activation_hook(__FILE__, 'lessbuttons_activation_hook');
}
function lessbuttons_activation_hook() {
	return lessbuttons_restore_config(false);
}

// restore built-in defaults, optionally overwriting existing values
function lessbuttons_restore_config($force=false) {

	if ($force || !get_option('lessbuttons_placement_outside')) update_option('lessbuttons_placement_outside', 'left');
	if ($force || !get_option('lessbuttons_placement_inside')) update_option('lessbuttons_placement_inside', 'inline_other');
	if ($force || !get_option('lessbuttons_placement_onmobile')) update_option('lessbuttons_placement_onmobile', 'bottom');
	if ($force || !get_option('lessbuttons_zindex')) update_option('lessbuttons_zindex', '100501');
	if ($force || !get_option('lessbuttons_placement_custom_buttons')) {
		$def = array ("facebook" => "1", "twitter" => "1", "googleplus" => "1", "linkedin" => "1",
			      "pinterest" => "1", /*"reddit" => "auto", "vkontakte" => "auto", "odnoklassniki" => "auto", */);
		update_option('lessbuttons_placement_custom_buttons', $def);
	}
	if ($force || !get_option('lessbuttons_conditionals')) {
		$conditionals = array (
			'is_home' => true,
			'is_single' => true,
			'is_page' => true,
			'is_category' => true,
			'is_date' => true,
			'is_search' => true,
		);
		update_option('lessbuttons_conditionals', $conditionals);
	}

	// last-updated date defaults to 0000-00-00
	// this is to trigger the update check on first run
	if ($force or !get_option('lessbuttons_updated'))
		update_option('lessbuttons_updated', '0000-00-00');
}

// Hook the admin_menu display to add admin page
add_action('admin_menu', 'lessbuttons_admin_menu');
function lessbuttons_admin_menu() {
	add_submenu_page('options-general.php', 'LessButtons', 'LessButtons', 8, 'LessButtons', 'lessbuttons_submenu');
}

function lessbuttons_message($message) {
	echo "<div id=\"message\" class=\"updated fade\"><p>$message</p></div>\n";
}

// Sanity check the upload worked
function lessbuttons_upload_errors() {
	global $lessbuttons_files;

	$cwd = getcwd(); // store current dir for restoration
	if (!@chdir('../wp-content/plugins'))
		return __("Couldn't find wp-content/plugins folder. Please make sure WordPress is installed correctly.", 'lessbuttons');
	if (!is_dir('lessbuttons'))
		return __("Can't find lessbuttons folder.", 'lessbuttons');
	chdir('lessbuttons');

	foreach($lessbuttons_files as $file) {
		if (substr($file, -1) == '/') {
			if (!is_dir(substr($file, 0, strlen($file) - 1)))
				return __("Can't find folder:", 'lessbuttons') . " <kbd>$file</kbd>";
		} else if (!is_file($file))
		return __("Can't find file:", 'lessbuttons') . " <kbd>$file</kbd>";
	}

	chdir($cwd); // restore cwd

	return false;
}

// The admin page
function lessbuttons_submenu() {
	global $lessbuttons_date, $lessbuttons_files;

	// update options in db if requested
	if ($_REQUEST['restore']) {
		lessbuttons_restore_config(True);
		lessbuttons_message(__("Restored all settings to defaults.", 'lessbuttons'));
		
	} else if ($_REQUEST['save']) {
		// update langset displays
		
		if (array_key_exists ("placement_outside", $_REQUEST)) {
			$a = array ("left", "right", "bottom");
			if (in_array ($_REQUEST['placement_outside'], $a)) {
				update_option('lessbuttons_placement_outside', $_REQUEST['placement_outside']);
			} else {
				update_option('lessbuttons_placement_outside', "left");
			}
		}
		
		if (array_key_exists ("placement_inside", $_REQUEST)) {
			$a = array ("inline_other", "inline_before", "inline_after");
			if (in_array ($_REQUEST['placement_inside'], $a)) {
				update_option('lessbuttons_placement_inside', $_REQUEST['placement_inside']);
			} else {
				update_option('lessbuttons_placement_inside', "inline_other");
			}
		}
		
		if (array_key_exists ("placement_onmobile", $_REQUEST)) {
			$a = array ("rest", "bottom", "hide");
			if (in_array ($_REQUEST['placement_onmobile'], $a)) {
				update_option('lessbuttons_placement_onmobile', $_REQUEST['placement_onmobile']);
			} else {
				update_option('lessbuttons_placement_onmobile', "bottom");
			}
		}
		
		if (array_key_exists ("zindex", $_REQUEST)) {
			update_option('lessbuttons_zindex', (int)$_REQUEST['zindex']);
		}
		
		if (array_key_exists ("custom_buttons", $_REQUEST) && is_array ($_REQUEST ["custom_buttons"]) && count ($_REQUEST ["custom_buttons"]) > 0) {
			update_option('lessbuttons_placement_custom_buttons', $_REQUEST ["custom_buttons"]);
		} else {
			update_option('lessbuttons_placement_custom_buttons', array ());
		}
		
		if (array_key_exists ("conditionals", $_REQUEST) && is_array ($_REQUEST ["conditionals"])) {
			update_option('lessbuttons_conditionals', $_REQUEST ["conditionals"]);
		} else {
			update_option('lessbuttons_conditionals', array ());
		}
		
		lessbuttons_message(__("Saved changes.", 'lessbuttons'));
	}

	if ($str = lessbuttons_upload_errors())
		lessbuttons_message("$str</p><p>" . __("In your plugins/lessbuttons folder, you must have these files:", 'lessbuttons') . ' <pre>' . implode("\n", $lessbuttons_files) ); 
	
	$placementOutside = get_option('lessbuttons_placement_outside');
	$placementInside = get_option('lessbuttons_placement_inside');
	$placementOnmobile = get_option('lessbuttons_placement_onmobile');
	$custButtons = get_option('lessbuttons_placement_custom_buttons');
	$conditionals = lessbuttons_getConditionals ();
	$zIndex = get_option('lessbuttons_zindex');
	if (preg_match ("|(\-?\d+)|", $zIndex, $ar)) $zIndex = (int) $ar [1];
	else $zIndex = 100501;
	$updated = get_option('lessbuttons_updated');
	
	$socTitles = array ("facebook" => array ("title" => "Facebook"), "twitter" => array ("title" => "Twitter"), "googleplus" => array ("title" => "Google+"), "linkedin" => array ("title" => "LinkedIn"), "pinterest" => array ("title" => "Pinterest"), "reddit" => array ("title" => "Reddit"), "vkontakte" => array ("title" => "VKontakte"), "odnoklassniki" => array ("title" => "Odnoklassniki"), "email" => array ("title" => "Email"), "printfriendly" => array ("title" => "Printfriendly"), "googlebookmarks" => array ("title" => "Google"), "gmail" => array ("title" => "Gmail"), "outlook" => array ("title" => "Outlook"), "yahoomail" => array ("title" => "Yahoo mail"), "aolmail" => array ("title" => "AOL mail"), "mailru" => array ("title" => "MoiMir"), "baidu" => array ("title" => "Baidu"), "tumblr" => array ("title" => "Tumblr"), "blogger" => array ("title" => "Blogger"), "livejournal" => array ("title" => "Livejournal"), "stumbleupon" => array ("title" => "StumbleUpon"), "rediff" => array ("title" => "Rediff"), "taringa" => array ("title" => "Taringa"), "douban" => array ("title" => "Douban"), "xing" => array ("title" => "Xing"), "evernote" => array ("title" => "Evernote"), "digg" => array ("title" => "Digg"), "typepad" => array ("title" => "Typepad"), "scoopit" => array ("title" => "Scoop.it"), "bufferapp" => array ("title" => "Bufferapp"), "myspace" => array ("title" => "Myspace"), "mixi" => array ("title" => "Mixi"), "delicious" => array ("title" => "Delicious"), "skyrock" => array ("title" => "Skyrock"), "friendfeed" => array ("title" => "Friendfeed"), "diigo" => array ("title" => "Diigo"), "meneame" => array ("title" => "Meneame"), "dzone" => array ("title" => "Dzone"), "fark" => array ("title" => "Fark"), "folkd" => array ("title" => "Folkd"), "netlog" => array ("title" => "Netlog"), "bitly" => array ("title" => "Bit.ly"), "care2" => array ("title" => "Care2"), "n4g" => array ("title" => "N4g"), "kaixin001" => array ("title" => "Kaixin001"), "wanelo" => array ("title" => "Wanelo"), "myvidster" => array ("title" => "Myvidster"), "draugiem" => array ("title" => "Draugiem"), "newsvine" => array ("title" => "Newsvine"), "jappy" => array ("title" => "Jappy"), "pdfonline" => array ("title" => "PDF Online"), "orkut" => array ("title" => "Orkut"), "surfingbird" => array ("title" => "Surfingbird"), "tuenti" => array ("title" => "Tuenti"), "sulia" => array ("title" => "Sulia"), "bizsugar" => array ("title" => "Bizsugar"), "blinklist" => array ("title" => "Blinklist"), "nujij" => array ("title" => "Nujij"), "youmob" => array ("title" => "Youmob"), "vkrugudruzei" => array ("title" => "vKruguDruzei"), "moikrug" => array ("title" => "MoiKrug"), "sodahead" => array ("title" => "SodaHead"), "sonico" => array ("title" => "Sonico"), "instapaper" => array ("title" => "Instapaper"), "taaza" => array ("title" => "Taaza"), "newsmeback" => array ("title" => "Newsmeback"), "citeulike" => array ("title" => "Citeulike"), "tapiture" => array ("title" => "Tapiture"), "buddymarks" => array ("title" => "Buddymarks"), "safelinking" => array ("title" => "Safelinking"), "diggita" => array ("title" => "Diggita"), "dudu" => array ("title" => "Dudu"), "fwisp" => array ("title" => "Fwisp"), "efactor" => array ("title" => "Efactor"), "gg" => array ("title" => "Gg"), "kaboodle" => array ("title" => "Kaboodle"), "startaid" => array ("title" => "Startaid"), "svejo" => array ("title" => "Svejo"), "plaxo" => array ("title" => "Plaxo"), "blurpalicious" => array ("title" => "Blurpalicious"), "misterwong" => array ("title" => "Mister wong"), "jumptags" => array ("title" => "Jumptags"), "fashiolista" => array ("title" => "Fashiolista"), "informazione" => array ("title" => "Informazione"), "bobrdobr" => array ("title" => "Bobrdobr"), "ziczac" => array ("title" => "Ziczac"), "thisnext" => array ("title" => "Thisnext"), "webnews" => array ("title" => "Webnews"), "mendeley" => array ("title" => "Mendeley"), "netvouz" => array ("title" => "Netvouz"), "origo" => array ("title" => "Origo"), "box" => array ("title" => "Box"), "blogmarks" => array ("title" => "Blogmarks"), "govn" => array ("title" => "Go.vn"), "tvinx" => array ("title" => "Tvinx"), "bookmerken" => array ("title" => "Bookmerken"), "balltribe" => array ("title" => "Balltribe"), "upnews" => array ("title" => "Upnews"), "stuffpit" => array ("title" => "Stuffpit"), "wirefan" => array ("title" => "Wirefan"), "ihavegot" => array ("title" => "Ihavegot"), "moemesto" => array ("title" => "Moemesto"), "me2day" => array ("title" => "Me2day"), "transferr" => array ("title" => "Transferr"), "beat100" => array ("title" => "Beat100"), "mashbord" => array ("title" => "Mashbord"), "domelhor" => array ("title" => "Domelhor"), "thrillon" => array ("title" => "Thrillon"), "100zakladok" => array ("title" => "100zakladok"), "posteezy" => array ("title" => "Posteezy"), "arto" => array ("title" => "Arto"), "ekudos" => array ("title" => "Ekudos"), "blogkeen" => array ("title" => "Blogkeen"), "identi" => array ("title" => "Identi"), "favoritus" => array ("title" => "Favoritus"), "linkshares" => array ("title" => "Linkshares"), "extraplay" => array ("title" => "Extraplay"), "iorbix" => array ("title" => "Iorbix"), "goodnoows" => array ("title" => "Goodnoows"), "scoopat" => array ("title" => "Scoop.at"));
	
	if (is_array ($custButtons) && count ($custButtons) > 0) {
		$shows = $custButtons;
	} else {
		$shows = array ("facebook" => "1", "twitter" => "1", "googleplus" => "1", "linkedin" => "1",
			      "pinterest" => "1", /*"reddit" => "auto", "vkontakte" => "auto", "odnoklassniki" => "auto", */);
	}

	// display options
?>
<style>
	/* Micro clearfix (http://nicolasgallagher.com/micro-clearfix-hack/) */
.cf:before,.cf:after{content:"";display:table}.cf:after{clear:both}.cf{zoom:1}

/* = Function = */

.less-button {
    float: left;
}
.less-button input {
    display: none;
}
.less-button label {
    background: #ccc;
    border: 1px solid #888;
    color: #666;
    padding: 5px 10px;
}
.less-button label:hover {
    background-color: #ddd;
}
.less-button label:active,
.less-button input:focus + label {
    background-color: #aaa;
}
.less-button input:checked + label {
    background-color: #b4b4b4;
}

/* = Fancy (Twitter Bootstrap) = */

form {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    margin: 80px;
}

.less-button label {
    background-color: #f5f5f5;
    background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
    background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
    background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
    background-image: -ms-linear-gradient(top, #ffffff, #e6e6e6);
    background-image: linear-gradient(top, #ffffff, #e6e6e6);
    background-repeat: repeat-x;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#e6e6e6', GradientType=0);
    border-color: #e6e6e6 #e6e6e6 #bfbfbf;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
    border: 1px solid #cccccc;
    border-bottom-color: #b3b3b3;
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
    -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
    color: #333333;
    cursor: pointer;
    display: inline-block;
    margin-bottom: 0;
    margin-left: -1px;
    padding: 4px 10px;
    font-size: 13px;
    line-height: 18px;
    text-align: center;
    text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
    vertical-align: middle;
}
.less-button label:hover {
    background-color: #e6e6e6;
    background-position: 0 -15px;
    color: #333333;
    text-decoration: none;
    -webkit-transition: background-position 0.1s linear;
    -moz-transition: background-position 0.1s linear;
    -ms-transition: background-position 0.1s linear;
    -o-transition: background-position 0.1s linear;
    transition: background-position 0.1s linear;
}
.less-button label:active,
.less-button input:focus + label {
    background-color: #d9d9d9;
    background-image: none;
    -webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
    -moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
    outline: 0;
}

.less-button input:checked + label {
    background: #f5f5f5;
    -webkit-box-shadow: inset 0 1px 6px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
    -moz-box-shadow: inset 0 1px 6px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
    box-shadow: inset 0 1px 6px rgba(0, 0, 0, 0.15), 0 1px 2px  rgba(0, 0, 0, 0.05);
}
.less-button:first-child label {
  -webkit-border-top-left-radius: 4px;
  -moz-border-radius-topleft: 4px;
  border-top-left-radius: 4px;
  -webkit-border-bottom-left-radius: 4px;
  -moz-border-radius-bottomleft: 4px;
  border-bottom-left-radius: 4px;
  margin-left: 0;
}
.less-button:last-child label {
  -webkit-border-top-right-radius: 4px;
  -moz-border-radius-topright: 4px;
  border-top-right-radius: 4px;
  -webkit-border-bottom-right-radius: 4px;
  -moz-border-radius-bottomright: 4px;
  border-bottom-right-radius: 4px;
}

.less-button-on input:checked + label  {
	background-color: #80ff80;
}
.less-button-off input:checked + label  {
	background-color: #c0c0c0;
}
.less-button-auto input:checked + label  {
	background-color: #60a0ff;
	color: white;
	text-shadow: 0 1px 1px rgba(0, 0, 0, 0.75);
}
.lessbutton-socimg {
    display: inline-block;
    background-image: url('<?php echo get_bloginfo('wpurl');?>/wp-content/plugins/lessbuttons/images/sprite.64.all-fs8.png');
    background-size: 32px 10000px;
    background-repeat: no-repeat;
    width: 32px;
    height: 32px;
}

.lessbuttons-button {
  display : inline-block;
  cursor : pointer;
  
  border-style : solid;
  border-width : 1px;
  border-radius : 50px;
  padding : 10px 18px;
  box-shadow : 0 1px 4px rgba(0,0,0,.6);
  font-size : 9.5pt;
  font-weight : bold;
  color : #fff;
  text-shadow : 0 1px 3px rgba(0,0,0,.4);
  font-family : sans-serif;
  text-decoration : none;
}

.lessbuttons-button-blue {
  border-color : #2989d8;
  background: #2989d8;
  background: -moz-linear-gradient(top, #2989d8 0%, #1e5799 100%);
  background: -webkit-gradient(linear, left top, left bottom, 
    color-stop(0%,#2989d8), color-stop(100%,#1e5799));
  background: -webkit-linear-gradient(top, #2989d8 0%,#1e5799 100%);
  background: -o-linear-gradient(top, #2989d8 0%,#1e5799 100%);
  background: -ms-linear-gradient(top, #2989d8 0%,#1e5799 100%);
  background: linear-gradient(top, #2989d8 0%,#1e5799 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( 
    startColorstr='#2989d8', endColorstr='#1e5799',GradientType=0 );
}

.lessbuttons-button-green {
  border-color: #8fc800;
  background: #8fc800;
  background: -moz-linear-gradient(top, #8fc800 0%, #438c00 100%);
  background: -webkit-gradient(linear, left top, left bottom, 
    color-stop(0%,#8fc800), color-stop(100%,#438c00));
  background: -webkit-linear-gradient(top, #8fc800 0%,#438c00 100%);
  background: -o-linear-gradient(top, #8fc800 0%,#438c00 100%);
  background: -ms-linear-gradient(top, #8fc800 0%,#438c00 100%);
  background: linear-gradient(top, #8fc800 0%,#438c00 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( 
    startColorstr='#8fc800', endColorstr='#438c00',GradientType=0 );
}

.lessbuttons-button-red {
  border-color: #c88f00;
  background: #c88f00;
  background: -moz-linear-gradient(top, #c88f00 0%, #8c4300 100%);
  background: -webkit-gradient(linear, left top, left bottom, 
    color-stop(0%,#c88f00), color-stop(100%,#8c4300));
  background: -webkit-linear-gradient(top, #c88f00 0%,#8c4300 100%);
  background: -o-linear-gradient(top, #c88f00 0%,#8c4300 100%);
  background: -ms-linear-gradient(top, #c88f00 0%,#8c4300 100%);
  background: linear-gradient(top, #c88f00 0%,#8c4300 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( 
    startColorstr='#c88f00', endColorstr='#8c4300',GradientType=0 );
}

.lessbuttons-scaled-frame {
    zoom: 0.5;
    -moz-transform: scale(0.5);
    -moz-transform-origin: 0 0;
    -o-transform: scale(0.5);
    -o-transform-origin: 0 0;
    -webkit-transform: scale(0.5);
    -webkit-transform-origin: 0 0;
}
</style>

<script>
    function lessbuttons_gCode() {
	
	var opts = [];
	var auto8 = 0;
	var onb8 = 0;
	<?php $lbCnt = 0; foreach ($socTitles as $id => $socCode) { ?>
	<?php if ($lbCnt < 8) { ?>
	if (document.getElementById ("button<?php echo $lbCnt?>_3").checked) {
	    auto8++;
	    opts.push ("<?php echo $id?>=auto");
	}
	<?php } else { ?>
	    if (document.getElementById ("button<?php echo $lbCnt?>_2").checked) onb8++;
	<?php } ?>
	if (document.getElementById ("button<?php echo $lbCnt?>_2").checked) opts.push ("<?php echo $id?>=1");
	<?php $lbCnt ++; } ?>
	
	if (auto8 == 8 && onb8 == 0) {
	    opts = [];
	}
	
	if (document.getElementById ("placement_outside_right").checked) opts.push ("position=right");
	if (document.getElementById ("placement_outside_bottom").checked) opts.push ("position=bottom");
	
	var c = "https://lessbuttons.com/script.js";
	if (opts.length) {
	    c += "?" + opts.join ("&");
	}

var ic = '<div style="padding-left: 50px; padding-right: 50px;">'
+'<h1>Preview</h1>'
+'<div id="lessbuttons_holder"></div><script async src="'+c+'"></'+'script>'
+'<p>'
+'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
+'</p>'
+'<p>'
+'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.'
+'</p>'
+'</div>';
	
	document.getElementById('lessbuttons_code_iframe').src = "data:text/html;charset=utf-8," + escape(ic);
	
	return true;
    }
    
    var lessbuttons_oldonload = window.onload;
      if (typeof window.onload != 'function') {
        window.onload = lessbuttons_gCode;
      } else {
        window.onload = function() {
          if (lessbuttons_oldonload) {
            lessbuttons_oldonload();
          }
          lessbuttons_gCode();
        }
      }
</script>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

<div class="wrap" id="lessbuttons_options">



<div style="clear: left; display: none;"><br/></div>

<table width="100%">
<tr><td valign="top">

<h3><?php _e("LessButtons Options", 'lessbuttons'); ?></h3>

<fieldset id="lessbuttons_placement_outside">
	<?php _e("Placement on website", 'lessbuttons'); ?>:
<div style="height: 32px;">
<div style="display: inline-block; ">
<div class="less-button less-button-auto">
	<input type="radio" name="placement_outside" id="placement_outside_left" value="left" <?php if ($placementOutside == "left") echo "checked"; ?>  onClick="lessbuttons_gCode();"/>
	<label for="placement_outside_left" unselectable><?php _e("Left", 'lessbuttons'); ?></label>
</div>
<div class="less-button less-button-auto">
	<input type="radio" name="placement_outside" id="placement_outside_bottom" value="bottom" <?php if ($placementOutside == "bottom") echo "checked"; ?>  onClick="lessbuttons_gCode();"/>
	<label for="placement_outside_bottom" unselectable><?php _e("Bottom", 'lessbuttons'); ?></label>
</div>
<div class="less-button less-button-auto">
	<input type="radio" name="placement_outside" id="placement_outside_right" value="right" <?php if ($placementOutside == "right") echo "checked"; ?>  onClick="lessbuttons_gCode();"/>
	<label for="placement_outside_right" unselectable><?php _e("Right", 'lessbuttons'); ?></label>
</div>
</div>
</div>
</fieldset>
<br/>
<fieldset id="lessbuttons_placement_inside">
	<?php _e("Inside individual posts and pages", 'lessbuttons'); ?>:
<div style="height: 32px;">
<div style="display: inline-block; ">
<div class="less-button less-button-auto">
	<input type="radio" name="placement_inside" id="placement_inside_left" value="inline_other" <?php if ($placementInside == "inline_other") echo "checked"; ?> />
	<label for="placement_inside_left" unselectable><?php _e("As rest", 'lessbuttons'); ?></label>
</div>
<div class="less-button less-button-auto">
	<input type="radio" name="placement_inside" id="placement_inside_right" value="inline_before" <?php if ($placementInside == "inline_before") echo "checked"; ?> />
	<label for="placement_inside_right" unselectable><?php _e("Before text", 'lessbuttons'); ?></label>
</div>
<div class="less-button less-button-auto">
	<input type="radio" name="placement_inside" id="placement_inside_bottom" value="inline_after" <?php if ($placementInside == "inline_after") echo "checked"; ?> />
	<label for="placement_inside_bottom" unselectable><?php _e("After text", 'lessbuttons'); ?></label>
</div>
</div>
</div>	
</fieldset>
<br/>
<fieldset id="lessbuttons_placement_outside">
<?php _e("On mobile devices", 'lessbuttons'); ?>:
<div style="height: 32px;">
<div style="display: inline-block; ">
<div class="less-button less-button-auto">
	<input type="radio" name="placement_onmobile" id="placement_onmobile_left" value="rest" <?php if ($placementOnmobile == "rest") echo "checked"; ?> />
	<label for="placement_onmobile_left" unselectable><?php _e("As rest", 'lessbuttons'); ?></label>
</div>
<div class="less-button less-button-auto">
	<input type="radio" name="placement_onmobile" id="placement_onmobile_right" value="bottom" <?php if ($placementOnmobile == "bottom") echo "checked"; ?> />
	<label for="placement_onmobile_right" unselectable><?php _e("Bottom", 'lessbuttons'); ?></label>
</div>
<div class="less-button less-button-auto">
	<input type="radio" name="placement_onmobile" id="placement_onmobile_bottom" value="hide" <?php if ($placementOnmobile == "hide") echo "checked"; ?> />
	<label for="placement_onmobile_bottom" unselectable><?php _e("Hide", 'lessbuttons'); ?></label>
</div>
</div>
</div>	
</fieldset>

<br/>
<fieldset id="lessbuttons_zindex">
Z-index <small>(<?php _e("above or below other content", 'lessbuttons');?>)</small>:<br/>
<input type="text" name="zindex" value="<?php echo $zIndex;?>" /> 
</fieldset>

<p class="submit"><input class="lessbuttons-button lessbuttons-button-green" name="save" id="save" tabindex="3" value="<?php _e("Apply and Save", 'lessbuttons'); ?>" type="submit" /></p>





</td><td valign="top">

<div style="width: 330px; height: 220px; margin-top: 30px;">
<iframe class="lessbuttons-scaled-frame" id="lessbuttons_code_iframe" width="200%" height="200%" style="padding: 0px; margin: 0px; border: 1px solid black;" src=""></iframe>
</div>
    

<br/>
<fieldset id="lessbuttons_conditionals">
<?php _e("Display on:", 'lessbuttons'); ?>
<br/>
<input type="checkbox" name="conditionals[is_home]"<?php echo ($conditionals['is_home']) ? ' checked="checked"' : ''; ?> /> <?php _e("Front page of the blog", 'lessbuttons'); ?>
<br/>
<input type="checkbox" name="conditionals[is_single]"<?php echo ($conditionals['is_single']) ? ' checked="checked"' : ''; ?> /> <?php _e("Individual blog posts", 'lessbuttons'); ?>
<br/>
<input type="checkbox" name="conditionals[is_page]"<?php echo ($conditionals['is_page']) ? ' checked="checked"' : ''; ?> /> <?php _e('Individual WordPress "Pages"', 'lessbuttons'); ?>
<br/>
<input type="checkbox" name="conditionals[is_category]"<?php echo ($conditionals['is_category']) ? ' checked="checked"' : ''; ?> /> <?php _e("Category archives", 'lessbuttons'); ?>
<br/>
<input type="checkbox" name="conditionals[is_date]"<?php echo ($conditionals['is_date']) ? ' checked="checked"' : ''; ?> /> <?php _e("Date-based archives", 'lessbuttons'); ?>
<br/>
<input type="checkbox" name="conditionals[is_search]"<?php echo ($conditionals['is_search']) ? ' checked="checked"' : ''; ?> /> <?php _e("Search results", 'lessbuttons'); ?>

</fieldset>


</td></tr>
</table>


<h4><?php _e("Display Buttons for Services", 'lessbuttons'); ?>:</h4>

<?php  $lbCnt = 0; foreach ($socTitles as $id => $socInfo) {
	if (is_array ($shows) && array_key_exists ($id, $shows) && $shows [$id] == "1") $ch = "on";
	else if (is_array ($shows) && array_key_exists ($id, $shows) && $shows [$id] == "auto") $ch = "auto";
	else $ch = "off";
	?>

<div style="height: 32px;">
    <div class="lessbutton-socimg" style="background-position: 0 -<?php echo $lbCnt*32;?>px;"></div>
    <div style="display: inline-block; margin-top: -10px; vertical-align: text-top; width: 100px;">
	<?php _e($socInfo ["title"], 'lessbuttons');?>
    </div>
    <div style="display: inline-block; ">
	<div class="less-button less-button-off">
	    <input type="radio" name="custom_buttons[<?php echo $id?>]" value="0" id="button<?php echo $lbCnt?>_1" <?php if ($ch == "off") echo "checked"; ?> onClick="lessbuttons_gCode();">
	    <label for="button<?php echo $lbCnt?>_1" unselectable><?php _e("Off", 'lessbuttons'); ?></label>
	</div>
	<div class="less-button less-button-on">
	    <input type="radio" name="custom_buttons[<?php echo $id?>]" value="1" id="button<?php echo $lbCnt?>_2" <?php if ($ch == "on") echo "checked"; ?> onClick="lessbuttons_gCode();">
	    <label for="button<?php echo $lbCnt?>_2" unselectable><?php _e("On", 'lessbuttons'); ?></label>
	</div>
	<?php if ($lbCnt < 8) { ?>
	<div class="less-button less-button-auto">
	    <input type="radio" name="custom_buttons[<?php echo $id?>]" value="auto" id="button<?php echo $lbCnt?>_3" <?php if ($ch == "auto") echo "checked"; ?> onClick="lessbuttons_gCode();">
	    <label for="button<?php echo $lbCnt?>_3" unselectable><?php _e("Auto", 'lessbuttons'); ?> </label> <?php _e("for logged into", 'lessbuttons');?> <?php _e($socInfo ["title"], 'lessbuttons');?>
	</div>
	<?php } ?>
    </div>
</div>

<?php $lbCnt ++;}  ?>

</div>

<p class="submit"><input class="lessbuttons-button lessbuttons-button-green" name="save" id="save" tabindex="3" value="<?php _e("Apply and Save", 'lessbuttons'); ?>" type="submit" /></p>
<p class="submit"><input class="lessbuttons-button lessbuttons-button-red" name="restore" id="restore" tabindex="3" value="<?php _e("Restore Built-in Defaults", 'lessbuttons'); ?>" type="submit" onclick="return confirm('<?php _e("Are you shure want to restore built-in defaults?", 'lessbuttons'); ?>');" /></p>

</form>

<div class="wrap">
<p>
<?php echo '<a href="https://lessbuttons.com/plugins/wordpress/">LessButtons</a> ' . __('is copyright 2014 by LessButtons, released under the GNU GPL version 2 or later.', 'lessbuttons'); ?>
</p>
</div>

<?php
}

?>