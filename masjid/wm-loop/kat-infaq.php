<div class="wm__looppost">
    <div class="wm__container">
    	<?php 
		    $kats = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$katslug = $kats->slug;
	    	$paged = ( get_query_var ('paged') ) ? get_query_var('paged') : 1 ;
            query_posts( array( 
	         	'post_type' => 'infaq', 
		    	'paged'     => $paged,
				'tax_query' => array(
			    	array(
				    	'taxonomy' => 'kat-infaq',
						'terms'    => $katslug,
						'field'    => 'slug'
					)
				)
	    	));
			
			if (have_posts()): 
			?>
			
		    <div class="wm__partition div__clear">
	    	<table class="library">
			    <thead>
		            <tr class="inhead">
				        <td><strong><?php echo __('Date', 'wp-masjid'); ?></strong></td>
						<td><strong><?php echo __('Desc', 'wp-masjid'); ?></strong></td>
						<td><strong><?php echo __('In', 'wp-masjid'); ?></strong></td>
						<td><strong><?php echo __('Out', 'wp-masjid'); ?></strong></td>
			    	</tr>
				<thead>
				<tbody>
			        <?php 
					    $kel = 0;
						$mas = 0;
				    	while (have_posts()): the_post();
						global $post; 
				    	$dns = get_post_meta($post->ID, '_status', true);
				    	if ( $dns == 'keluar' ) {
							$masuk = 0;
							$keluar = get_post_meta($post->ID, '_juminfaq', true);
						}
						if ( $dns == 'masuk' ) {
							$masuk = get_post_meta($post->ID, '_juminfaq', true);
							$keluar = 0;
						}
						$masu = str_replace(".","",$masuk);
						$kelu = str_replace(".","",$keluar);
						$kel += $kelu;
						$mas += $masu;
						$final = $mas-$kel;
						$tanginfaq = get_post_meta($post->ID, '_tanginfaq', true);
						
						?>
					
					    <tr>
							<td><?php echo date_i18n("j F Y", strtotime($tanginfaq)); ?></td>
							<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
							<td><?php 
						    	if ( $dns == 'masuk' ) { 
							    	echo '<span>'.__('Rp', 'wp-masjid').' ' .$masuk. '</span>'; 
								} 
							?></td>
					        <td><?php 
						    	if ( $dns == 'keluar' ) { 
							    	echo '<span class="infaq__out">'.__('Rp', 'wp-masjid').' ' .$keluar. '</span>'; 
								} 
							?></td>
						</tr>
						
				    	<?php 
						endwhile;
					?>
				</tbody>
			</table>
			</div>
	    	<?php 
	    	endif; 
			wp_reset_query();
		?>
	</div>
</div>
