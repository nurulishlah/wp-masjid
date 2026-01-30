	<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e( 'Skip to content', 'wp-masjid' ); ?></a>
	<div class="wrapper khalifah" id="main-content" role="main">
		<div class="ka__container">
		    <div class="ka__header div__clear">
				<div class="ka__logo">
				    <span class="ka__menu-toggle" onclick="kalimenu()" role="button" tabindex="0" aria-label="<?php esc_attr_e( 'Toggle menu', 'wp-masjid' ); ?>" aria-expanded="false"></span>
					<?php wm_custom_logo(); ?>
				</div>
				<div class="ka__menu">
			    	<?php 
			    		if (has_nav_menu('navigation')) {
							wp_nav_menu(array(
								'theme_location' => 'navigation', 
								'container' => 'div', 
								'container_class' => 'kalmenu', 
								'menu_class' => 'accord', 
								'menu_id' => 'kal_accord', 
								'fallback_cb' => false
							));
						}
					?>
					<div class="ka__call">
		    			<div class="wm__hotnumber"><?php wm_telp_masjid(); ?></div>
					</div>
				</div>
			</div>
			
			<?php 
	        	if ( is_front_page() && !is_paged() ) {
		        	wm_big_slider_home();
	         	}
         	?>
			
			<div class="ka__sholattime div__clear">
   				<div class="wm__headspan"><span><?php echo esc_html( date_i18n('l, j F Y') ); ?> / <?php echo esc_html( wm_get_hijri_date() ); ?></span></div>
				<div class="wm__sholatwidget"><?php wm_city_prayer(); ?></div>
			</div>