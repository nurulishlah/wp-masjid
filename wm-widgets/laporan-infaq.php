<?php
class Laporan_infaq extends WP_Widget {
	function __construct() {
		parent::__construct(
			'laporan_infaq',
			esc_html__( 'WM : Infaq Report', 'wp-masjid' ),
			array( 'description' => esc_html__( 'Widget display Infaq Report', 'wp-masjid' ), 'customize_selective_refresh' => true, )
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Infaq Report', 'wp-masjid' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$mari  = ( ! empty( $instance['mari'] ) ) ? $instance['mari'] : __( 'Lets Give Infaq', 'wp-masjid' );
		
		echo $args['before_widget'];
		if ( get_theme_mod('wm_mode') == "khalifah" ) {
		?>
		
	    	<div class="widget__laporaninfaq">
		    	<div class="kalap__block div__clear">
				    <div class="kalap__saldo">
					    <div class="saldo__in">
					    	<div class="saldo__lap">
						        <?php
							    	$argu = array(
								    	'post_type'      => 'infaq',
										'meta_query'     => array(
									    	array(
										    	'key'     => '_status',
												'compare' => 'EXISTS',
											),
										),
										'posts_per_page' => 500,
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
							    	<?php echo esc_html__('Infaq Report', 'wp-masjid'); ?>
								</div>
								<div class="saldo__real">
							    	<span><?php echo esc_html__('BALANCE', 'wp-masjid'); ?></span>
									<div class="saldo__show"><?php echo esc_html__('Rp', 'wp-masjid'); ?> <?php echo esc_html(number_format($saldo_akhir, 0, '.', '.')); ?><?php echo esc_html__(',-', 'wp-masjid'); ?></div>
								</div>
								<a class="rek__link" href="<?php echo esc_url( get_post_type_archive_link( 'infaq' ) ); ?>">
							        <?php echo esc_html__('Report', 'wp-masjid'); ?>
							    </a>
							</div>
						</div>
					</div>
						
				    <div class="kalap__table">
				    <?php
				    	global $post;
						$infaq_argument = array( 
					    	'post_type' => 'infaq',
							'posts_per_page' => 4,
							'meta_key'       => '_tanginfaq',
							'orderby'        => 'meta_value',
							'order'          => 'DESC',
							'meta_type'      => 'DATE'
						);
						$loop_infaq = get_posts($infaq_argument);
						?>
						
						<div class="tabel__infaq">
							<div class="before__table">
						    	<table class="dana__infaq">
									
									<?php
								    	foreach ($loop_infaq as $post) {
											$status    = get_post_meta($post->ID, '_status', true);
											$juminfaq  = get_post_meta($post->ID, '_juminfaq', true);
											$tanginfaq = get_post_meta($post->ID, '_tanginfaq', true);
											setup_postdata($post);
											?>
											<tr>
												<td><div class="dana__desc"><?php the_title(); ?></div></td>
										    	<td class="dana__right">
												    <?php if ($status === 'keluar') { ?>
												        <div class="dana__jum status__out">- <?php echo esc_html__('Rp', 'wp-masjid'); ?> <?php echo esc_html( $juminfaq ); ?></div>
											        	<div class="dana__date"><?php echo esc_html( date_i18n("d M Y", strtotime($tanginfaq)) ); ?></div>
													<?php } else if ($status === 'masuk') { ?>
													    <div class="dana__jum status__in">+ <?php echo esc_html__('Rp', 'wp-masjid'); ?> <?php echo esc_html( $juminfaq ); ?></div>
											        	<div class="dana__date"><?php echo esc_html( date_i18n("d M Y", strtotime($tanginfaq)) ); ?></div>
													<?php } ?>
												</div>
											</tr>
											<?php 
										}
									?>
								</table>
							</div>
						</div><!-- end table -->
						<?php
				    	wp_reset_postdata();
			    	?>
					</div>
					
			     	<div class="kalap__rek">
						<div class="rek__in">
						    <?php if ( $mari ) { echo '<span class="karek__title">' . esc_html( $mari ) . '</span>'; } ?>
						    <div class="saldo__line">
								<?php echo esc_html__('Please give your infaq through the following account', 'wp-masjid'); ?>
							</div>
						    <?php
						    	$rek_args = array(
							    	'post_type'      => 'rek',
									'posts_per_page' => 20,
									'orderby'        => 'rand',
								);
								$rek_query = new WP_Query($rek_args);
								
								if ($rek_query->have_posts()) :
								
								echo '<div class="' . esc_attr($args['widget_id']) . ' owl-carousel owl-theme">';

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
    								                    <div class="koderek"><?php echo esc_html__('Code', 'wp-masjid'); ?> : <?php echo $koderek; ?></div>
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

							
						</div>
					</div>
					
				
				</div>
			</div>
			<script>
            jQuery(document).ready(function($) {
                var owl = $('.<?php echo esc_js( $args['widget_id'] ); ?>');
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
		
		<?php
		} else {
		?>
		
		    <div class="widget__laporaninfaq">
		    	<div class="box__infaq div__clear">
				    <?php
				    	global $post;
						$infaq_argument = array( 
					    	'post_type' => 'infaq',
							'meta_key' => '_status',
							'posts_per_page' => 7,
							'meta_query' => array(
						    	array(
							    	'key' => '_status',
									'value' => 'masuk',
								)
							)
						);
						$loop_infaq = get_posts($infaq_argument);
						?>
						
						<div class="tabel__infaq">
					    	<?php
						    	if ( $title ) {
									echo '<span class="lap__title">' . esc_html( $title ) . '</span>';
								}
							?>
							<div class="before__table">
						    	<table class="dana__infaq">
							    	<tr>
								    	<td class="aksen"><strong><?php echo esc_html__('Amount', 'wp-masjid'); ?></strong></td>
										<td class="tglnol"><strong><?php echo esc_html__('Date', 'wp-masjid'); ?></strong></td>
										<td><strong><?php echo esc_html__('From', 'wp-masjid'); ?></strong></td>
									</tr>
									
									<?php
								    	foreach ($loop_infaq as $post) {
											$juminfaq = get_post_meta($post->ID, '_juminfaq', true);
											$tanginfaq = get_post_meta($post->ID, '_tanginfaq', true);
											setup_postdata($post);
											?>
											<tr>
										    	<td class="aksen"><strong><?php echo esc_html__('Rp', 'wp-masjid'); ?> <?php echo esc_html( $juminfaq ); ?></strong></td>
												<td class="tglnol"><?php echo esc_html( date_i18n("d-m-Y", strtotime($tanginfaq)) ); ?></td>
												<td><?php the_title(); ?></td>
											</tr>
											<?php 
										}
									?>
								</table>
							</div>
						</div><!-- end table -->
						<?php
				    	wp_reset_postdata();
			    	?>
					
			     	<div class="saldo__infaq">
					    <?php
					    	if ( $mari ) {
								echo '<span class="lap__title">' . esc_html( $mari ) . '</span>';
							}
						?>
						<div class="wm__saldo">
						    <?php
						    	$total_argument = array( 
							    	'post_type' => 'infaq',
									'meta_key' => '_status',
									'posts_per_page' => 500,
								);
								$count_infaq = get_posts($total_argument);
								$kel = 0;
								$mas = 0;
								foreach ( $count_infaq as $post ) {
									$status = get_post_meta($post->ID, '_status', true);
									if ( $status == 'keluar' ) {
										$masuk = 0;
										$keluar = get_post_meta($post->ID, '_juminfaq', true);
									}
									if ( $status == 'masuk' ) {
										$masuk = get_post_meta($post->ID, '_juminfaq', true);
										$keluar = 0;
									}
									$masu = str_replace(".","",$masuk);
									$kelu = str_replace(".","",$keluar);
									$kel += $kelu;
									$mas += $masu;
									$final = $mas-$kel;
									
									setup_postdata($post);
								}
							?>
							
							<div class="wm__saldotitle">
						    	<?php echo esc_html__('INFAQ FUND BALANCE REPORT', 'wp-masjid'); ?>
							</div>
							<div class="wm__realsaldo"><?php echo esc_html__('BALANCE', 'wp-masjid'); ?> : <span><?php echo esc_html__('Rp', 'wp-masjid'); ?> <?php echo esc_html( isset( $final ) ? number_format($final,0,'.','.') : 0 ); ?>,-</span></div>
							<div class="wm__infaqline">
						    	<?php echo esc_html__('Please give your infaq through the following account', 'wp-masjid'); ?>
							</div>
							
							<?php
							wp_reset_postdata();
					    	?>
							
							<div class="rek__infaq">
							    <?php
								    $rek_argument = array( 
								    	'post_type' => 'rek',
										'posts_per_page' => 20,
										'orderby'   => 'rand',
									);
									$rek_infaq = get_posts($rek_argument);
									
									echo '<div class="' . esc_attr( $args['widget_id'] ) . ' owl-carousel owl-theme">';
									
									foreach ($rek_infaq as $post) {
											$namarek  = get_post_meta($post->ID, '_namarek', true);
											$koderek  = get_post_meta($post->ID, '_koderek', true);
											$nomerrek = get_post_meta($post->ID, '_nomerrek', true);
											$akunrek  = get_post_meta($post->ID, '_akunrek', true);
											setup_postdata($post);
											?>
											<div class="item">
										        <div class="rek__img">
											    	<?php 
											        	if (has_post_thumbnail()) {
													    	the_post_thumbnail('thumbnail');
												    	}
											    	?>
												</div>
												<div class="rek__list">
											    	<div class="namarek"><?php echo esc_html( $namarek ); ?></div>
													<div class="koderek"><?php echo esc_html__('Code', 'wp-masjid'); ?> : <?php echo esc_html( $koderek ); ?></div>
													<div class="nomerrek"><?php echo esc_html( $nomerrek ); ?></div>
													<div class="akunrek"><?php echo esc_html( $akunrek ); ?></div>
												</div>
											</div>
											<?php 
									}
									echo '</div>';
									wp_reset_postdata();
								?>
							</div>
							<div class="wm__linksaldo">
						    	<a href="<?php echo esc_url( get_post_type_archive_link( 'infaq' ) ); ?>">
							     	<?php echo esc_html__('See Report', 'wp-masjid'); ?>
								</a>
							</div>
						</div>
					</div><!-- end saldo -->
					
				</div>
			</div>
			<script>
            jQuery(document).ready(function($) {
                var owl = $('.<?php echo esc_js( $args['widget_id'] ); ?>');
                owl.owlCarousel({
                    loop: true,
                    nav: false,
					dots: false,
                    lazyLoad: true,
			    	autoplay: true,
					smartSpeed: 1000,
                    autoplayTimeout: 4000,
                    autoplayHoverPause: true,
					margin: 0,
					items:1,
                });
            });
		    </script>
		
		<?php
		}
	    echo $args['after_widget'];
		
    }
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['mari'] = sanitize_text_field( $new_instance['mari'] );
		return $instance;
	}
	
	public function form( $instance ) {
		$title       = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'Infaq Report', 'wp-masjid' );
		$mari        = isset( $instance['mari'] ) ? esc_attr( $instance['mari'] ) : __( 'Lets Give Infaq', 'wp-masjid' );
		?>
		
		<div class="wm__inwidget">
	    	<?php echo esc_html__( 'Widget display Infaq Report', 'wp-masjid' ); ?>
		</div>
		<div class="wm__inwidget">
	    	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Left Title', 'wp-masjid' ); ?></label>
	    	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	    	<label for="<?php echo esc_attr( $this->get_field_id( 'mari' ) ); ?>"><?php echo esc_html__( 'Right Title', 'wp-masjid' ); ?></label>
	    	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'mari' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'mari' ) ); ?>" type="text" value="<?php echo esc_attr( $mari ); ?>" />
		</div>
		
        <?php
	}
}