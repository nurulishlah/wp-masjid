<div class="ka__incontent div__clear">
    <?php 
		echo '<h1 class="ka__heading">';
			echo __('Infaq Report', 'wp-masjid');
		echo '</h1>';
		get_template_part('khalifah/wm-loop/infaq');
		get_template_part('khalifah/wm-loop/pagination');
	?>
</div>