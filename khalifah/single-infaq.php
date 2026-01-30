<div class="ka__postshow div__clear">
	<div class="ka__singpost">
	    <div class="ka__singin">
	        <?php
				if (have_posts()):
		        	while (have_posts()): the_post();
					$status    = get_post_meta($post->ID, '_status', true);
					$tanginfaq = get_post_meta($post->ID, '_tanginfaq', true);
					$juminfaq  = get_post_meta($post->ID, '_juminfaq', true);
					$asalinfaq = get_post_meta($post->ID, '_asalinfaq', true);
					$ketinfaq  = get_post_meta($post->ID, '_ketinfaq', true);
			     	?>
					    <div class="sing__date"><?php echo __('Infaq Report', 'wp-masjid'); ?></div>
				    	<h1 class="sing__heading"><?php the_title(); ?></h1>
						<?php 
						    if ( has_post_thumbnail() ) {
								echo '<div class="sing__thumb">';
								    the_post_thumbnail('full', array(
							    	    'alt' => trim(strip_tags($post->post_title)),
										'title' => trim(strip_tags($post->post_title)),
									)); 
								echo '</div>';
							}
						?>
						<div class="sing__share">
							<a href="https://facebook.com/share.php?u=<?php the_permalink() ?>&amp;t=<?php the_title() ?>" target="_blank" title="<?php echo esc_html_e('Share to Facebook', 'wp-masjid'); ?>"><i class="icon-wm-facebook"></i></a>
							<a href="https://twitter.com/home?status=<?php the_title() ?> <?php the_permalink() ?>" target="_blank" title="<?php echo esc_html_e('Share to Twitter', 'wp-masjid'); ?>"><i class="icon-wm-twitter"></i></a>
							<a target="_blank" href="https://wa.me/?text=<?php the_title() ?> <?php the_permalink() ?>" title="<?php echo esc_html_e('Share to WhatsApp', 'wp-masjid'); ?>"><i class="icon-wm-whatsapp"></i></a>
							<a href="https://t.me/share/url?url=<?php the_permalink() ?>&text=<?php the_title() ?>" target="_blank" title="<?php echo esc_html_e('Share to Telegram', 'wp-masjid'); ?>"><i class="icon-wm-telegram"></i></a>
						</div>
						
						<div class="sing__content sing__nopost"> 
						    <table class="sing__notable">
								<tr>
						    		<td><strong><?php echo esc_html_e('Date', 'wp-masjid'); ?></strong></td>
						    		<td><?php echo date_i18n("d F Y", strtotime($tanginfaq)); ?></td>
					    		</tr>
								<tr>
						    		<td><strong><?php echo esc_html_e('Fund', 'wp-masjid'); ?></strong></td>
						    		<td><?php echo esc_html( $status ); ?></td>
					    		</tr>
                                <tr>
						    		<td><strong><?php echo esc_html_e('Category', 'wp-masjid'); ?></strong></td>
						    		<td>
                                        <?php
                                            $terms = get_the_terms($post->ID, 'kat-infaq');
                                            if ($terms && !is_wp_error($terms)) {
                                                foreach ($terms as $term) {
                                                    echo '<a href="' . esc_url(get_term_link($term)) . '" class="infaq-category-pill">' . esc_html($term->name) . '</a> ';
                                                }
                                            }
                                        ?>
                                    </td>
					    		</tr>
				                <tr>
						        	<td><strong><?php echo esc_html_e('Name', 'wp-masjid'); ?></strong></td>
					           	     <td><?php the_title(); ?></td>
						    	</tr>
						        <tr>
							    	<td><strong><?php echo esc_html_e('From', 'wp-masjid'); ?></strong></td>
						    		<td><?php echo esc_html( $asalinfaq ); ?></td>
						    	</tr>
						    	<tr>
						    		<td><strong><?php echo esc_html_e('Amount', 'wp-masjid'); ?></strong></td>
						    		<td><?php echo esc_html_e('Rp', 'wp-masjid'); ?> <?php echo esc_html( $juminfaq ); ?></td>
					    		</tr>
								<tr>
						    		<td><strong><?php echo esc_html_e('Desc', 'wp-masjid'); ?></strong></td>
						    		<td><?php echo esc_html( $ketinfaq ); ?></td>
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