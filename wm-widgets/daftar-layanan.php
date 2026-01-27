<?php
class Layanan_Masjid extends WP_Widget {
	function __construct() {
		parent::__construct(
			'layanan_masjid',
			esc_html__( 'WM : Mosque Services', 'wp-masjid' ),
			array( 'description' => esc_html__( 'Widget display Mosque Services', 'wp-masjid' ), 'customize_selective_refresh' => true, )
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Mosque Services', 'wp-masjid' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		
		echo $args['before_widget'];
		if ( get_theme_mod('wm_mode') == "khalifah" ) {
		?>
		
	    	<div class="widget__layanan">
			    <?php
					if ( $title ) {
						echo '<span class="kalay__title">' . esc_html( $title ) . '</span>';
					}
				?>
		    	<div class="box__layanan div__clear">
				    <?php
				    	$layanan_arg = array( 
					    	'post_type' => 'layanan',
							'posts_per_page' => 30,
							'orderby'   => 'rand',
						);
						$layanan = get_posts($layanan_arg);
						echo '<div class="' . esc_attr( $args['widget_id'] ) . ' owl-carousel owl-theme">';
						
						global $post;
						foreach ($layanan as $post) {
							$hubungi = get_post_meta($post->ID, '_hubungi', true);
							$informasi = get_post_meta($post->ID, '_informasi', true);
							setup_postdata($post);
							?>
							
							<div class="item kalay__block">
						    	<div class="service__post">
									<?php 
										if (has_post_thumbnail()) {
											the_post_thumbnail('medthumb');
										}
									?>
								</div>
								<div class="kalay__data">
									<div class="kalay__link">
								    	<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
									</div>
									<div class="kalay__contact div__clear">
								    	<div class="kalay__people"><?php echo esc_html( $hubungi ); ?></div>
										<div class="kalay__phone"><?php echo esc_html( $informasi ); ?></div>
										<a class="kalay__call" href="tel:<?php echo esc_attr( $informasi ); ?>"><i class="icon-wm-phone"></i></a>
									</div>
								</div>
							</div>
							
							
							<?php 
						}
						
						echo '</div>';
						wp_reset_postdata();
					?>
				</div>
			</div>
			<?php
			wm_enqueue_carousel_script( $args['widget_id'], array(
				'margin' => 20,
				'items'  => 4,
			) );
			?>
		
		<?php
		} else {
		?>
		
			<div class="widget__layanan">
			    <?php
					if ( $title ) {
						echo '<span class="lay__title">' . esc_html( $title ) . '</span>';
					}
				?>
		    	<div class="box__layanan div__clear">
				    <?php
				    	$layanan_arg = array( 
					    	'post_type' => 'layanan',
							'showposts' => 30,
							'orderby'   => 'rand',
						);
						$layanan = get_posts($layanan_arg);
						echo '<div class="' .$args['widget_id']. ' owl-carousel owl-theme">';
						
						global $post;
						foreach ($layanan as $post) {
							$hubungi = get_post_meta($post->ID, '_hubungi', true);
							$informasi = get_post_meta($post->ID, '_informasi', true);
							setup_postdata($post);
							?>
							
							<div class="item">
							    <a href="<?php the_permalink() ?>">
						    	<div class="service__post">
									<?php 
										if (has_post_thumbnail()) {
											the_post_thumbnail('medthumb');
										}
									?>
								</div>
								<div class="service__meta">
									<div class="service__title"><?php the_title(); ?></div>
									<div class="service__contact div__clear">
								    	<div class="service__people"><?php echo esc_html( $hubungi ); ?></div>
										<div class="service__call"><?php echo esc_html( $informasi ); ?></div>
									</div>
								</div>
								</a>
							</div>
							
							
							<?php 
						}
						
						echo '</div>';
						wp_reset_query();
					?>
				</div>
			</div>
			<?php
			wm_enqueue_carousel_script( $args['widget_id'], array(
				'margin'     => 20,
				'responsive' => array(
					0   => array( 'items' => 2, 'margin' => 10 ),
					720 => array( 'items' => 2 ),
					800 => array( 'items' => 3 ),
					982 => array( 'items' => 4 ),
				),
			) );
			?>
		
		<?php		
		}
	    echo $args['after_widget'];
		
    }
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}
	
	public function form( $instance ) {
		$title       = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'Mosque Services', 'wp-masjid' );
		?>
		
		<div class="wm__inwidget">
	    	<?php echo esc_html__( 'Widget display Mosque Services', 'wp-masjid' ); ?>
		</div>
		<div class="wm__inwidget">
	    	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title', 'wp-masjid' ); ?></label>
	    	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</div>
		
        <?php
	}
}