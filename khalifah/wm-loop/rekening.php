<div class="ka__archive">
    <div class="wm__container">
    	<?php 
	    	if (have_posts()) {
				$loop = 0;
				echo '<div class="ka__postloop div__clear">';
				while (have_posts()): the_post(); 
				global $post;
				$namarek  = get_post_meta($post->ID, '_namarek', true);
				$koderek  = get_post_meta($post->ID, '_koderek', true);
				$nomerrek = get_post_meta($post->ID, '_nomerrek', true);
				$akunrek  = get_post_meta($post->ID, '_akunrek', true);
				$loop++;
				?>
			    	<div class="ka__looppost ka__jumat">
				    	<div class="ka__loopinn">
							<div class="ka__loopmeta">
							    <?php if (has_post_thumbnail()) { ?>
								    <div class="ka__banklogo">
									<?php the_post_thumbnail('thumbnail', array(
							    	    'alt' => trim(strip_tags($post->post_title)),
										'title' => trim(strip_tags($post->post_title)),
									)); ?>
									</div>
						    	<?php } ?>
								<h4 class="ka__looptitle"><?php the_title(); ?></h4>
								<div class="ka__loopjumat">
							    	<span><?php echo __('Bank / Wallet', 'wp-masjid'); ?></span>
									<div><?php echo esc_html( $namarek ); ?></div>
								</div>
								<?php if ( $koderek != "" ) { ?>
							    	<div class="ka__loopjumat">
							    	    <span><?php echo __('Code', 'wp-masjid'); ?></span>
							    		<div><?php echo esc_html( $koderek ); ?></div>
							    	</div>
								<?php } ?>
								<?php if ( $nomerrek != "" ) { ?>
							    	<div class="ka__loopjumat">
							    	    <span><?php echo __('Number', 'wp-masjid'); ?></span>
							    		<div><?php echo esc_html( $nomerrek ); ?></div>
							    	</div>
								<?php } ?>
								<?php if ( $akunrek != "" ) { ?>
							    	<div class="ka__loopjumat">
								        <span><?php echo __('Account Name', 'wp-masjid'); ?></span>
								    	<div><?php echo esc_html( $akunrek ); ?></div>
							    	</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="kaloop-<?php echo esc_attr($loop); ?> div__clear"></div>
				<?php 
				endwhile;echo '</div>';
			} else {
				echo '<div class="ka__postloop div__clear">';
				echo '<div class="ka__looppost"><div class="ka__loopinn">';
				echo __('Posts not found', 'wp-masjid');
				echo '</div></div>';
				echo '</div>';
			}
		?>
	</div>
</div>