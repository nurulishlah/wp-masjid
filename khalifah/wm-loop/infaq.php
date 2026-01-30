<div class="ka__archive">
    <div class="wm__container">
	    <div class="ka__postloop div__clear">
		    
			<div class="infaq__right">
					    <div class="saldo__in saldo__inlap">
					    	<div class="saldo__lap">
						        <?php
							    	// Prepare Filter Arguments
                                    $filter_tax_query = array('relation' => 'AND');
                                    $filter_meta_query = array('relation' => 'AND');
                                    
                                    // 1. Filter: Month (Bulan)
                                    if (isset($_GET['filter_bulan']) && $_GET['filter_bulan'] !== '') {
                                        $filter_tax_query[] = array(
                                            'taxonomy' => 'bulan',
                                            'field'    => 'term_id',
                                            'terms'    => intval($_GET['filter_bulan']),
                                        );
                                    }
                                    
                                    // 2. Filter: Year (Tahun)
                                    if (isset($_GET['filter_tahun']) && $_GET['filter_tahun'] !== '') {
                                        $filter_tax_query[] = array(
                                            'taxonomy' => 'tahun',
                                            'field'    => 'term_id',
                                            'terms'    => intval($_GET['filter_tahun']),
                                        );
                                    }
                                    
                                    // 3. Filter: Category (Kategori)
                                    if (isset($_GET['filter_kategori']) && $_GET['filter_kategori'] !== '') {
                                        $filter_tax_query[] = array(
                                            'taxonomy' => 'kat-infaq',
                                            'field'    => 'term_id',
                                            'terms'    => intval($_GET['filter_kategori']),
                                        );
                                    }
                                    
                                    // 4. Filter: Status (Masuk/Keluar)
                                    if (isset($_GET['filter_status']) && $_GET['filter_status'] !== '') {
                                        $filter_meta_query[] = array(
                                            'key'     => '_status',
                                            'value'   => sanitize_text_field($_GET['filter_status']),
                                            'compare' => '=',
                                        );
                                    } else {
                                        // Default: Just check if status exists (consistent with original)
                                        $filter_meta_query[] = array(
                                            'key'     => '_status',
                                            'compare' => 'EXISTS',
                                        );
                                    }

							    	$argu = array(
								    	'post_type'      => 'infaq',
										'meta_query'     => $filter_meta_query,
                                        'tax_query'      => $filter_tax_query,
										'posts_per_page' => -1,
									);
									
									$query = new WP_Query($argu);
									
									$total_keluar = 0;
									$total_masuk = 0;
									
									if ($query->have_posts()) :
								    	while ($query->have_posts()) : $query->the_post();
										$status = get_post_meta(get_the_ID(), '_status', true);
										$jumlah_infaq = intval(str_replace(".", "", get_post_meta(get_the_ID(), '_juminfaq', true)));
										if ($status === 'keluar') {
											$total_keluar += $jumlah_infaq;
										} elseif ($status === 'masuk') {
											$total_masuk += $jumlah_infaq;
										}
										endwhile;
									endif;
									
									$saldo_akhir = $total_masuk - $total_keluar;
									
									wp_reset_postdata();
								?>
								<div class="saldo__title">
							    	<?php echo __('Infaq Report', 'wp-masjid'); ?>
								</div>
								<div class="saldo__real" style="margin-bottom: 10px; border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 10px;">
							    	<span style="font-size: 11px; opacity: 0.7;"><?php echo __('RECEIVED', 'wp-masjid'); ?></span>
									<div class="saldo__show saldo__masuk-val"><?php echo __('Rp', 'wp-masjid'); ?> <?php echo esc_html(number_format($total_masuk, 0, '.', '.')); ?>,-</div>
								</div>
                                <div class="saldo__real" style="margin-bottom: 15px; border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 10px;">
							    	<span style="font-size: 11px; opacity: 0.7;"><?php echo __('DISBURSED', 'wp-masjid'); ?></span>
									<div class="saldo__show saldo__keluar-val"><?php echo __('Rp', 'wp-masjid'); ?> <?php echo esc_html(number_format($total_keluar, 0, '.', '.')); ?>,-</div>
								</div>
                                <div class="saldo__real">
							    	<span><?php echo __('BALANCE', 'wp-masjid'); ?></span>
									<div class="saldo__show"><?php echo __('Rp', 'wp-masjid'); ?> <?php echo esc_html(number_format($saldo_akhir, 0, '.', '.')); ?>,-</div>
								</div>
							</div>
						</div>
						<div class="rek__in">
						    <div class="saldo__line">
								<?php echo __('Please give your infaq through the following account', 'wp-masjid'); ?>
							</div>
						    <?php
						    	$rek_args = array(
							    	'post_type'      => 'rek',
									'posts_per_page' => 20,
									'orderby'        => 'rand',
								);
								$rek_query = new WP_Query($rek_args);
								
								if ($rek_query->have_posts()) :
								
								echo '<div class="lap-infaq owl-carousel owl-theme">';

								    while ($rek_query->have_posts()) : $rek_query->the_post();
    								    $namarek  = esc_html(get_post_meta(get_the_ID(), '_namarek', true));
    								    $koderek  = esc_html(get_post_meta(get_the_ID(), '_koderek', true));
    								    $nomerrek = esc_html(get_post_meta(get_the_ID(), '_nomerrek', true));
    								    $akunrek  = esc_html(get_post_meta(get_the_ID(), '_akunrek', true));
    								    ?>
    								        <div class="item">
        								        <div class="karek__img">
                								    <?php 
                								        if (has_post_thumbnail()) {
            								                echo get_the_post_thumbnail(get_the_ID(), 'thumbnail');
            								            }
    								                ?>
        								        </div>
        								        <div class="karek__list">
    								                <div class="namarek"><?php echo $namarek; ?></div>
													<?php if ( $koderek != "" ) { ?> 
    								                    <div class="koderek"><?php echo esc_html_e('Code', 'wp-masjid'); ?> : <?php echo $koderek; ?></div>
													<?php } ?>
    								                <div class="nomerrek"><?php echo $nomerrek; ?></div>
    								                <div class="akunrek"><?php echo $akunrek; ?></div>
    								            </div>
    								        </div>
    								    <?php
    								endwhile;

    							echo '</div>';
						     	endif;
								
								wp_reset_postdata();
							?>
                            <script>
                                jQuery(document).ready(function($) {
                                    var owl = $('.lap-infaq');
                                    owl.owlCarousel({
                                        loop: true,
                                        nav: false,
	                    				dots: false,
                                        lazyLoad: true,
	                    		    	autoplay: true,
	                    				smartSpeed: 1000,
                                        autoplayTimeout: 4000,
                                        autoplayHoverPause: true,
	                    				margin: 15,
	                    				items:1,
                                    });
                                });
	                    	</script>
							
						</div>
			</div>
		    <div class="infaq__loop">
	            <div class="tabel__infaq">
                    
                    <div class="wm-infaq-filter" style="margin-bottom: 20px; background: #fff; padding: 15px; border-radius: 8px; border: 1px solid #eee;">
                        <form method="get" action="" style="display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end;">
                            
                            <!-- Filter: Month -->
                            <div class="filter-group">
                                <label style="display: block; font-size: 11px; margin-bottom: 4px; color: #666;"><?php _e('Month', 'wp-masjid'); ?></label>
                                <select name="filter_bulan" style="padding: 5px; border: 1px solid #ddd; border-radius: 4px; min-width: 120px;">
                                    <option value=""><?php _e('- All Months -', 'wp-masjid'); ?></option>
                                    <?php 
                                        $terms_bulan = get_terms(array('taxonomy' => 'bulan', 'hide_empty' => true));
                                        foreach($terms_bulan as $term) {
                                            echo '<option value="'.$term->term_id.'" '.selected(isset($_GET['filter_bulan']) ? $_GET['filter_bulan'] : '', $term->term_id, false).'>'.$term->name.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <!-- Filter: Year -->
                            <div class="filter-group">
                                <label style="display: block; font-size: 11px; margin-bottom: 4px; color: #666;"><?php _e('Year', 'wp-masjid'); ?></label>
                                <select name="filter_tahun" style="padding: 5px; border: 1px solid #ddd; border-radius: 4px; min-width: 80px;">
                                    <option value=""><?php _e('- All Years -', 'wp-masjid'); ?></option>
                                    <?php 
                                        $terms_tahun = get_terms(array('taxonomy' => 'tahun', 'hide_empty' => true, 'orderby' => 'name', 'order' => 'DESC'));
                                        foreach($terms_tahun as $term) {
                                            echo '<option value="'.$term->term_id.'" '.selected(isset($_GET['filter_tahun']) ? $_GET['filter_tahun'] : '', $term->term_id, false).'>'.$term->name.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <!-- Filter: Category -->
                            <div class="filter-group">
                                <label style="display: block; font-size: 11px; margin-bottom: 4px; color: #666;"><?php _e('Category', 'wp-masjid'); ?></label>
                                <select name="filter_kategori" style="padding: 5px; border: 1px solid #ddd; border-radius: 4px; min-width: 130px;">
                                    <option value=""><?php _e('- All Categories -', 'wp-masjid'); ?></option>
                                    <?php 
                                        $terms_kat = get_terms(array('taxonomy' => 'kat-infaq', 'hide_empty' => true));
                                        foreach($terms_kat as $term) {
                                            echo '<option value="'.$term->term_id.'" '.selected(isset($_GET['filter_kategori']) ? $_GET['filter_kategori'] : '', $term->term_id, false).'>'.$term->name.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <!-- Filter: Status -->
                            <div class="filter-group">
                                <label style="display: block; font-size: 11px; margin-bottom: 4px; color: #666;"><?php _e('Type', 'wp-masjid'); ?></label>
                                <select name="filter_status" style="padding: 5px; border: 1px solid #ddd; border-radius: 4px; min-width: 100px;">
                                    <option value=""><?php _e('- All -', 'wp-masjid'); ?></option>
                                    <option value="masuk" <?php selected(isset($_GET['filter_status']) ? $_GET['filter_status'] : '', 'masuk'); ?>><?php _e('Received', 'wp-masjid'); ?></option>
                                    <option value="keluar" <?php selected(isset($_GET['filter_status']) ? $_GET['filter_status'] : '', 'keluar'); ?>><?php _e('Disbursed', 'wp-masjid'); ?></option>
                                </select>
                            </div>
                            
                            <div class="filter-actions">
                                <button type="submit" class="button" style="padding: 6px 15px; cursor: pointer; background: #333; color: #fff; border: none; border-radius: 4px;"><?php _e('Filter', 'wp-masjid'); ?></button>
                                <?php if(isset($_GET['filter_bulan']) || isset($_GET['filter_tahun']) || isset($_GET['filter_kategori']) || isset($_GET['filter_status'])): ?>
                                    <a href="<?php echo remove_query_arg(array('filter_bulan', 'filter_tahun', 'filter_kategori', 'filter_status')); ?>" style="margin-left: 5px; font-size: 12px; color: #666; text-decoration: none;"><?php _e('Reset', 'wp-masjid'); ?></a>
                                <?php endif; ?>
                            </div>

                        </form>
                    </div>
                	<div class="before__table">
				    	<?php 
			    	    	$paged = ( get_query_var ('paged') ) ? get_query_var('paged') : 1 ;
    		    	        $query_args = array( 
			    	         	'post_type' => 'infaq', 
			    		    	'paged'     => $paged,
                                'tax_query' => $filter_tax_query, // Use same filters
                                'meta_query' => $filter_meta_query // Use same filters
			    	    	);
                            
                            query_posts($query_args);
			
			    			if (have_posts()): 
			    			?>
			
				    	        <table class="dana__infaq">
				    		        <?php 
				    			    	while (have_posts()): the_post();
				    					global $post; 
				    			    	$status    = get_post_meta($post->ID, '_status', true);
				    					$juminfaq  = get_post_meta($post->ID, '_juminfaq', true);
				    					$tanginfaq = get_post_meta($post->ID, '_tanginfaq', true);
				    					?>
					
				    				    <tr>
				    						<td><div class="dana__desc"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div></td>
				    						<td class="dana__categori" style="width: 20%; text-align: right;">
												<?php
													$terms = get_the_terms($post->ID, 'kat-infaq');
													if ($terms && !is_wp_error($terms)) {
														foreach ($terms as $term) {
															echo '<a href="' . esc_url(get_term_link($term)) . '" class="infaq-category-pill">' . esc_html($term->name) . '</a> ';
														}
													}
												?>
											</td>
											<td class="dana__right">
				    							<?php if ($status === 'keluar') { ?>
				    								<div class="dana__jum status__out">- <?php echo __('Rp', 'wp-masjid'); ?> <?php echo $juminfaq; ?></div>
				    								<div class="dana__date"><?php echo date_i18n("d M Y", strtotime($tanginfaq)); ?></div>
				    							<?php } else if ($status === 'masuk') { ?>
				    								<div class="dana__jum status__in">+ <?php echo __('Rp', 'wp-masjid'); ?> <?php echo $juminfaq; ?></div>
				    								<div class="dana__date"><?php echo date_i18n("d M Y", strtotime($tanginfaq)); ?></div>
				    							<?php } ?>
				    						</td>
											
				    					</tr>
						
				    			    	<?php 
				    					endwhile;
				    				?>
				    			</table>
				
	    		    		<?php 
	    		    		endif; 
				    		wp_reset_query();
							get_template_part('khalifah/wm-loop/pagination');
				    	?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
