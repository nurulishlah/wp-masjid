<div class="wm__looppost">
    <div class="wm__container">
    	<?php if (have_posts()): ?>
		    <div class="wm__partition div__clear">
	    	<table class="library">
			    <thead>
		            <tr class="inhead">
				        <td class="book__title"><strong><?php echo __('Title', 'wp-masjid'); ?></strong></td>
						<td><strong><?php echo __('Author', 'wp-masjid'); ?></strong></td>
						<td><strong><?php echo __('Publisher', 'wp-masjid'); ?></strong></td>
						<td><strong><?php echo __('Count', 'wp-masjid'); ?></strong></td>
			    	</tr>
				<thead>
				<tbody>
			        <?php 
				    	while (have_posts()): the_post();
						global $post; 
				    	$penulis = get_post_meta($post->ID, '_penulis', true);
						$penerbit = get_post_meta($post->ID, '_penerbit', true);
						$halaman = get_post_meta($post->ID, '_halaman', true);
						$jumlahbuku = get_post_meta($post->ID, '_jumlahbuku', true);
						?>
					
					    <tr>
							<td class="book__title"><strong><?php the_title(); ?></strong> (<?php echo $halaman; ?> <?php echo __('Page', 'wp-masjid'); ?>)</td>
							<td><?php echo $penulis; ?></td>
							<td><?php echo $penerbit; ?></td>
							<td><?php echo $jumlahbuku; ?></td>
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
