<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php 
		    wm_head_meta_property();
			wp_head();
		?>
	
	<!-- Tema WP Masjid dari Ciuss Creative -->

	</head>
	
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e( 'Skip to content', 'wp-masjid' ); ?></a>
	
	    <div class="wrapper" id="main-content" role="main">
		
		    <div class="wm__header">
			
		    	<div class="wm__ticker">
			    	<ul class="newsticker_post newstickers">
				    	<?php wm_running_text(); ?>
					</ul>
				</div>
				
				<div class="wm__mainheader">
				    <div class="wm__container">
				    	<div class="div__clear">
					    	<div class="wm__logo">
						    	<?php wm_custom_logo(); ?>
							</div>
							<button class="wm__openmenu" aria-label="<?php esc_attr_e( 'Open menu', 'wp-masjid' ); ?>" aria-expanded="false">
								<i class="icon-wm-menu" aria-hidden="true"></i>
							</button>
							<div class="wm__sholat">
						        <div class="wm__headspan"><span><?php echo esc_html( date_i18n('l, j F Y') ); ?></span></div>
							    <div class="wm__sholatwidget"><?php wm_city_prayer(); ?></div>
				     		</div>
						</div>
					</div>
				</div>
				<div class="header_masjid_menu">
			    	<div class="wm__container">
				    	<div class="wm__sectionmenu div__clear">
   						    <div class="wm__menu">
					    	<?php 
								if (has_nav_menu('navigation')) {
									wp_nav_menu(array(
										'theme_location' => 'navigation', 
										'container' => 'div', 
										'container_class' => 'navmenu', 
										'menu_class' => 'dd desktop deskmenu', 
										'menu_id' => 'dd', 
										'fallback_cb' => false
									));
								}
							?>
							</div>
							<?php get_search_form(); ?>
						</div>
			        </div>
				</div>
			</div>
			
			<?php 
	        	if ( is_front_page() && !is_paged() ) {
		        	wm_big_slider_home();
					get_template_part('masjid/wm-header/wm-contact');
	         	}
				wm_breadcrumbs();
         	?>
			