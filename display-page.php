<?php 

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<?php 
		    wm_head_meta_property();
			wp_head();
		?>
	
	<!-- Tema WP Masjid dari Ciuss Creative -->

	</head>
	
	<body id="display" <?php body_class(); ?>>
		    <div class="sholat_display">
			
			</div>
			<div class="display_left">
			    <h2><span><i class="icon-wm-calendar"></i></span> Agenda Masjid</h2>
				<div class="agenda_out">
		        	<?php get_template_part('display/agenda'); ?>
					
					<h3><span><i class="icofont-business-man-alt-1"></i></span> Pengurus Masjid</h3>
					<?php get_template_part('display/pengurus'); ?>
				</div>
			</div>
			
			<div class="display_right">
			    <h2><span><i class="icon-wm-calendar"></i></span> Agenda Masjid</h2>
				<div class="agenda_out">
		        	<?php get_template_part('display/agenda'); ?>
					
					<h3><span><i class="icofont-business-man-alt-1"></i></span> Pengurus Masjid</h3>
					<?php get_template_part('display/pengurus'); ?>
				</div>
			</div>
			
			<div class="display_center">
			<ul class="display__news">
				<?php get_template_part('display/newsticker'); ?>
			</ul>
			
						<?php get_template_part('khalifah/wm-header/city-prayer'); ?>
						</div>
			
						<div style="display: none;"><?php text_footer(); ?></div>
		<?php 
		    wpm_idsprayer();
			wp_footer();  
			?>
	</body>
</html>