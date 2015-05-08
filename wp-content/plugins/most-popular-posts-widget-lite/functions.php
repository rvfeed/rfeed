<?php

//zbieranie danych
function add_views($postID) {
	global $wpdb;
	$popular_posts_statistics_table = $wpdb->prefix . 'popular_posts_statistics';
	if (!$wpdb->query($wpdb->prepare("SELECT hit_count FROM $popular_posts_statistics_table WHERE post_id = %d", $postID)) && !preg_match('/bot|spider|crawler|slurp|curl|^$/i', $_SERVER['HTTP_USER_AGENT'])) { //jeśli nie istnieje rekord hit_count z podanym ID oraz ID nie jest równe 1 oraz odwiedzający nie jest botem
		$wpdb->query($wpdb->prepare("INSERT INTO $popular_posts_statistics_table (post_id, hit_count, date) VALUES (%d, 1, NOW())", $postID)); //dodaje do tablicy id postu, date oraz hit
	}elseif (!preg_match('/bot|spider|crawler|slurp|curl|^$/i', $_SERVER['HTTP_USER_AGENT'])) { //w innym przypadku...
		$hitsnumber = $wpdb->get_results($wpdb->prepare("SELECT hit_count FROM $popular_posts_statistics_table WHERE post_id = %d", $postID), ARRAY_A);
		$hitsnumber = $hitsnumber[0]['hit_count'];
		$wpdb->query($wpdb->prepare("UPDATE $popular_posts_statistics_table SET hit_count = %d + 1, date =  NOW() WHERE post_id = %d", $hitsnumber, $postID));
	}
}


//wyświetlanie wyników
function show_views($postID, $posnumber, $numberofdays, $ignoredpages) {
	global $wpdb;
	$popular_posts_statistics_table = $wpdb->prefix . 'popular_posts_statistics';
	$posts_table = $wpdb->prefix . 'posts';
	if ($wpdb->query("SELECT hit_count FROM $popular_posts_statistics_table")) {
		$result = $wpdb->get_results($wpdb->prepare("SELECT hit_count FROM $popular_posts_statistics_table WHERE date >= NOW() - INTERVAL %d DAY ORDER BY hit_count DESC", $numberofdays), ARRAY_A);
		$post_id_number = $wpdb->get_results($wpdb->prepare("SELECT post_id FROM $popular_posts_statistics_table as st INNER JOIN rvn_posts as rp ON rp.ID = st.post_id WHERE date >= NOW() - INTERVAL %d DAY AND rp.post_type = 'post' ORDER BY hit_count DESC LIMIT %d", $numberofdays, $posnumber), ARRAY_A);
		echo "<ul>";
		for ($i = 0; $i < count($post_id_number); ++$i) {
			$post_number = $post_id_number[$i]['post_id'];
			$post_link = get_permalink($post_number); //zdobywanie permalinka
			$countbeginning = "<br /><span id=\"pp-count\">";
			$countending = "</span></span><br />";
			$post_name_by_id = $wpdb->get_results($wpdb->prepare("SELECT post_title, post_author FROM $posts_table WHERE ID = %d", $post_number), ARRAY_A);
			if (!$post_name_by_id){ //sprawdza, czy post o danym ID istnieje, jeśli nie - kasuje rekord i przerywa skrypt (który by wyświetlał błąd w pierwszej linii)
				$wpdb->query($wpdb->prepare("DELETE FROM $popular_posts_statistics_table WHERE post_id = %d", $post_number));
				break;
			}
			if (in_array($post_number, $ignoredpages)) { //sprawdza, czy postu nie ma na liście banów
				$cat_or_post_check = TRUE;
			}else {
				$cat_or_post_check = FALSE;
			}
			if ($cat_or_post_check == FALSE) {
				static $x = 0; //static powoduje, że wartość x po skońćzeniu pętli nie jest zerowana
               // print_r( $post_name_by_id[0]);exit;
                $author_id = $post_name_by_id[0]['post_author'];
                 $author_name = get_userdata($author_id)->display_name;
				echo '<li id="pp-' . $x++ . '-title">'
                    .'<div class="pop_title"><a href="' . $post_link . '">'
                    .get_the_post_thumbnail( $post_number, 'side-thumb' )
                    . $post_name_by_id[0]['post_title'] . '</a>
                               </div>
                               <div class="author-time" style>
                               <span id="time-img" class="ok"></span>
                               <span class="ok"> '
                    .human_time_diff( get_the_time("U", $post_number), current_time("timestamp") ) . ' ago</span>'
                  //  .'<span id="auth-img" class="ok"></span>'
                   // .'<a class="ok" href="'.get_author_posts_url( get_the_author_meta($post_number ) ).'">'
                    //.$author_name.' </a>'
                    .'</div>'
                    .'</li>';
                              /* <span class="author-time">'
                                .human_time_diff( get_the_time("U", $post_number), current_time("timestamp") ) . ' ago by '
                                .get_the_author()
                        .'</span>*/

				//echo $countbeginning . $result[$i]['hit_count'] . " visit(s)" . $countending;
			}
		}
        echo "</ul>";
	}
}

?>