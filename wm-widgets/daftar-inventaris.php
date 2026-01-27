<?php
class Inventaris_Masjid extends WP_Widget {
	function __construct() {
		parent::__construct(
			'inventaris_masjid',
			esc_html__( 'WM : Mosque Inventory', 'wp-masjid' ),
			array( 'description' => esc_html__( 'Widget displays Mosque Inventory', 'wp-masjid' ), 'customize_selective_refresh' => true, )
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Mosque Inventory', 'wp-masjid' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		
		echo $args['before_widget'];
		if ( get_theme_mod('wm_mode') == "khalifah" ) {
		?>
		
	    	<div class="widget__inventaris">
			    <?php if ( $title ) { echo '<span class="kainv__title">' . esc_html( $title ) . '</span>'; }
				?>
		    	<div class="kainv__block div__clear">
				    <?php
				    	$layanan_arg = array( 
					    	'post_type' => 'inventaris',
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
							
							<div class="item">
							    <a href="<?php the_permalink() ?>">
						        	<div class="kainv__post">
	    								<?php 
		    								if (has_post_thumbnail()) {
			    								the_post_thumbnail('medthumb');
				    						}
					    				?>
						    		</div>
							    	<div class="kainv__cat"><?php the_title(); ?></div>
								</a>
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
				'mouseDrag'  => false,
				'touchDrag'  => false,
				'responsive' => array(
					0   => array( 'items' => 2 ),
					720 => array( 'items' => 3 ),
					800 => array( 'items' => 4 ),
					982 => array( 'items' => 5 ),
				),
			) );
			?>
		
		<?php
		} else {
		?>
		
		
	    	<div class="widget__inventaris">
			    <?php
					if ( $title ) {
						echo '<span class="inv__title">' . esc_html( $title ) . '</span>';
					}
				?>
		    	<div class="box__inventaris div__clear">
				    <?php
				    	$layanan_arg = array( 
					    	'post_type' => 'inventaris',
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
						    	<div class="inv__post">
									<?php 
										if (has_post_thumbnail()) {
											the_post_thumbnail('medthumb');
										}
									?>
								</div>
								<div class="inv__meta">
									<div class="inv__cat"><?php the_title(); ?></div>
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
				'margin'     => 5,
				'responsive' => array(
					0   => array( 'items' => 2 ),
					720 => array( 'items' => 3 ),
					800 => array( 'items' => 4 ),
					982 => array( 'items' => 5 ),
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
		$title       = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'Mosque Inventory', 'wp-masjid' );
		?>
		
		<div class="wm__inwidget">
			<?php echo esc_html__( 'Widget displays Mosque Inventory', 'wp-masjid' ); ?>
		</div>
		<div class="wm__inwidget">
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title', 'wp-masjid' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</div>
		
        <?php
	}
}