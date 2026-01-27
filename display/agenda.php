	    	<div class="display_agenda">
		    	<div class="">
				    <div class="">
				    	<?php
					    	$offset = get_option('gmt_offset');
							$today = strtotime('now') + ($offset * HOUR_IN_SECONDS);
							$args_upcoming = array(
			    				'post_type'           => 'event',
								'posts_per_page'      => 3,
								'ignore_sticky_posts' => true,
								'meta_key'            => '_minus',
								'orderby'             => 'meta_value',
								'order'               => 'ASC',
								'meta_query'          => array(
							    	array(
				    					'key'     => '_minus',
										'value'   => $today,
										'compare' => '>=',
										'type'    => 'NUMERIC'
									)
								)
							);
							
							$query_upcoming = new WP_Query($args_upcoming);
							if ($query_upcoming->have_posts()):
						    	while ($query_upcoming->have_posts()): $query_upcoming->the_post();
								$tevent = get_post_meta(get_the_ID(), '_tevent', true);
								?>
			    					<div class="agenda_d_block div__clear">
									    <?php 
									    	if (has_post_thumbnail()) {
												echo '<div class="agenda_d_img">';
												the_post_thumbnail('thumbnail');
												echo '</div>';
											} else {
												echo '<div class="agenda_d_img">';
												echo '</div>';
											}
										?>
        				    	        <div class="agenda_d_right">
        				    	            <div class="agenda_d_green"><?php echo esc_html(date_i18n('d M y', strtotime($tevent))); ?></div>
    				    	                <div class="agenda_d_title"><?php the_title(); ?></div>
    				    	            </div>
    				    	        </div>
    					        <?php
    					    	endwhile;
					    	endif;

					    	wp_reset_postdata();
							
							$args_past = array(
    					    	'post_type'           => 'event',
    					    	'posts_per_page'      => 3 - $query_upcoming->post_count,
    					    	'ignore_sticky_posts' => true,
    					    	'meta_key'            => '_minus',
    					    	'orderby'             => 'meta_value',
    					    	'order'               => 'DESC',
    					    	'meta_query'          => array(
    					    	    array(
    					    	        'key'     => '_minus',
    					    	        'value'   => $today,
    					    	        'compare' => '<',
    					    	        'type'    => 'NUMERIC'
    					    	    )
    					    	)
					    	);

					    	$query_past = new WP_Query($args_past);

					    	if ($query_past->have_posts()):
					    	    while ($query_past->have_posts()): $query_past->the_post();
    					    	$tevent = get_post_meta(get_the_ID(), '_tevent', true);
    					    	?>
    					    	    <div class="agenda_d_block div__clear">
									    <?php 
									    	if (has_post_thumbnail()) {
												echo '<div class="agenda_d_img">';
												the_post_thumbnail('thumbnail');
												echo '</div>';
											} else {
												echo '<div class="agenda_d_img">';
												echo '</div>';
											}
										?>
        				    	        <div class="agenda_d_right">
        				    	            <div class="agenda_d_red"><?php echo esc_html(date_i18n('d M y', strtotime($tevent))); ?></div>
    				    	                <div class="agenda_d_title"><?php the_title(); ?></div>
    				    	            </div>
    				    	        </div>
    				    	    <?php
    				    	    endwhile;
				    	    endif;

				    	    wp_reset_postdata();
				    	?>

					</div>
				</div>
			</div>