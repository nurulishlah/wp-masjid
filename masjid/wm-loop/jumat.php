<div class="wm__looppost">
    <div class="wm__container">
    	<?php if (have_posts()): ?>
		    <div class="wm__partition div__clear">
	    	<table class="library">
			    <thead>
		            <tr class="inhead">
				        <td><strong><?php echo __('Date', 'wp-masjid'); ?></strong></td>
	      		    	<td><strong><?php echo __('Imam', 'wp-masjid'); ?></strong></td>
	    			    <td><strong><?php echo __('Khatib', 'wp-masjid'); ?></strong></td>
	    			    <td><strong><?php echo __('Muadzin', 'wp-masjid'); ?></strong></td>
	    				<td><strong><?php echo __('Bilal', 'wp-masjid'); ?></strong></td>
			    	</tr>
				<thead>
				<tbody>
			        <?php 
				    	while (have_posts()): the_post();
						global $post; 
				    	$jimam = get_post_meta($post->ID, '_jimam', true);
						$jkhatib = get_post_meta($post->ID, '_jkhatib', true);
						$jmuadzin = get_post_meta($post->ID, '_jmuadzin', true);
						$jbilal = get_post_meta($post->ID, '_jbilal', true);
						?>
					
					    <tr>
							<td><?php the_title(); ?></td>
							<td><?php echo $jimam; ?></td>
							<td><?php echo $jkhatib; ?></td>
					        <td><?php echo $jmuadzin; ?></td>
							<td><?php echo $jbilal; ?></td>
						</tr>
						
				    	<?php 
						endwhile;
					?>
				</tbody>
			</table>
			</div>
		<?php endif; ?>
	</div>
</div>
