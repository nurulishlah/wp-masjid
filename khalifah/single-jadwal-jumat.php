<div class="ka__postshow div__clear">
	<div class="ka__singpost">
	    <div class="ka__singin">
	        <?php
				if (have_posts()):
		        	while (have_posts()): the_post();
					global $post;
					$jimam    = get_post_meta($post->ID, '_jimam', true);
					$jkhatib  = get_post_meta($post->ID, '_jkhatib', true);
					$jmuadzin = get_post_meta($post->ID, '_jmuadzin', true);
					$jbilal   = get_post_meta($post->ID, '_jbilal', true);
			     	?>
					    <div class="sing__date"><?php echo __('Friday Officer', 'wp-masjid'); ?></div>
				    	<h1 class="sing__heading"><?php the_title(); ?></h1>
						<div class="sing__meta">
					        
				        </div>
						<div class="sing__share">
							<a href="https://facebook.com/share.php?u=<?php the_permalink() ?>&amp;t=<?php the_title() ?>" target="_blank" title="<?php echo esc_html_e('Share to Facebook', 'wp-masjid'); ?>"><i class="icon-wm-facebook"></i></a>
							<a href="https://twitter.com/home?status=<?php the_title() ?> <?php the_permalink() ?>" target="_blank" title="<?php echo esc_html_e('Share to Twitter', 'wp-masjid'); ?>"><i class="icon-wm-twitter"></i></a>
							<a target="_blank" href="https://wa.me/?text=<?php the_title() ?> <?php the_permalink() ?>" title="<?php echo esc_html_e('Share to WhatsApp', 'wp-masjid'); ?>"><i class="icon-wm-whatsapp"></i></a>
							<a href="https://t.me/share/url?url=<?php the_permalink() ?>&text=<?php the_title() ?>" target="_blank" title="<?php echo esc_html_e('Share to Telegram', 'wp-masjid'); ?>"><i class="icon-wm-telegram"></i></a>
						</div>
						
						<div class="sing__content sing__nopost"> 
						    <table class="sing__notable">
								<tr>
						    		<td><strong><?php echo __( 'Imam', 'wp-masjid' ); ?></strong></td>
						    		<td><?php echo esc_html( $jimam ); ?></td>
					    		</tr>
								<tr>
						    		<td><strong><?php echo __( 'Khatib', 'wp-masjid' ); ?></strong></td>
						    		<td><?php echo esc_html( $jkhatib ); ?></td>
					    		</tr>
				                <tr>
						        	<td><strong><?php echo __( 'Muadzin', 'wp-masjid' ); ?></strong></td>
					           	     <td><?php echo esc_html( $jmuadzin ); ?></td>
						    	</tr>
						        <tr>
							    	<td><strong><?php echo __( 'Bilal', 'wp-masjid' ); ?></strong></td>
						    		<td><?php echo esc_html( $jbilal ); ?></td>
						    	</tr>
					    	</table>
							
							<div class="sing__nav div__clear">
							    <?php
							    	$prev_post = get_adjacent_post(false, '', true);
									$next_post = get_adjacent_post(false, '', false);
									if ($prev_post): 
								    	$prev_post_url = get_permalink($prev_post->ID); 
										$prev_post_title = $prev_post->post_title; 
										
										echo '<a class="sing__prev" href="' . $prev_post_url . '"><i class="icon-wm-left"></i><span>' .$prev_post_title. '</span>';
										echo '</a>';
										
									endif;
									if ($next_post): 
								    	$next_post_url = get_permalink($next_post->ID); 
										$next_post_title = $next_post->post_title;
										
										echo '<a class="sing__next" href="' .$next_post_url. '"><i class="icon-wm-right-1"></i><span>' .$next_post_title. '</span>';
										echo '</a>';
									endif;
								?>
							</div>
					    </div>
					
		        	<?php 
		        	endwhile;
		    	endif; 
			?>
			
		</div>
	</div>
	<div class="ka__sidebar">
	    <?php get_sidebar(); ?>
	</div>
</div>