<div class="ka__incontent div__clear">
    <?php 
		echo '<h1 class="ka__heading">';
			if (is_category()) {
				printf(__('Cat : %s', 'wp-masjid'), single_cat_title('', false)); 
			} elseif (is_tag()) {
				printf(__('Tag : %s', 'wp-masjid'), single_tag_title('', false));
			} elseif (is_day()) {
				printf(__('Archive : %s', 'wp-masjid'), get_the_time('j M Y'));
			} elseif (is_month()) {
				printf(__('Archive : %s', 'wp-masjid'), get_the_time('F Y'));
			} elseif (is_year()) {
			    printf(__('Archive : %s', 'wp-masjid'), get_the_time('Y'));
			} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
			    echo __('Post Archive', 'wp-masjid'); 
		    }
		echo '</h1>';
		get_template_part('khalifah/wm-loop/post');
		get_template_part('khalifah/wm-loop/pagination');
	?>
</div>