<?php
function wm_event_expired($post_ID) {
	global $post;
    $post_event_date = get_post_meta($post_ID, '_tevent', true);
	$end = get_post_meta($post_ID, '_tevent', true).' '.get_post_meta($post_ID, '_jam', true);
	$exp = strtotime(date_i18n($end));
	$dday = strtotime(date_i18n('d-m-Y H:i'));
	$sisa = $exp-$dday;
	$event_date = date("d F Y", strtotime($post_event_date));
    if ($post_event_date != "" ) {
        echo $event_date;
		if ( $sisa < 0 ) { 
			echo '<br/><strong class="expired">'.__( 'Expired Event', 'wp-masjid' ) .'</strong>'; 
		} else {
			echo '<br/><strong class="next">'.__( 'Upcoming Event', 'wp-masjid' ) .'</strong>';
		}
    }
}

function wm_event_columns($defaults) {
    $defaults['wm_expired'] = __( 'Event Date', 'wp-masjid' );
    return $defaults;
}
	
function event_columns_content($column_name, $post_ID) {
    if ($column_name == 'wm_expired') {
		global $post;
        $post_expired_event = wm_event_expired($post_ID);
		$end = get_post_meta($post_ID, '_tevent', true).' '.get_post_meta($post_ID, '_jam', true);
	    $exp = strtotime(date_i18n($end));
	    $dday = strtotime(date_i18n('d-m-Y H:i'));
	    $sisa = $exp-$dday;
		if ($post_expired_event != "" ) {
            echo $post_expired_event;
			if ( $sisa < 0 ) { echo '<br/><strong>'.__( 'Expired Event', 'wp-masjid' ) .'</strong>'; }
        }
    }
}
	
add_filter('manage_event_posts_columns', 'wm_event_columns', 10);
add_action('manage_event_posts_custom_column', 'event_columns_content', 10, 2);