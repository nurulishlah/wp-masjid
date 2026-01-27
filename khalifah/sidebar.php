<div id="sidebar">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
    	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php } else { ?>
	
	<div id="wm_nowidgets" class="widget_block widget">
        <label>
		<?php echo __('Please add widget to this area. Login and go to Appearance > Customizer > Widget', 'wp-masjid'); ?>
		</label>
	</div>
	
	<?php } ?>
</div>
