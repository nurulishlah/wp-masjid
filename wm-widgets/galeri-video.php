<?php
class Galeri_Video extends WP_Widget {
	function __construct() {
		parent::__construct(
			'galeri_video',
			esc_html__( 'WM : Video Gallery', 'wp-masjid' ),
			array( 'description' => esc_html__( 'Widget display Video Gallery', 'wp-masjid' ), 'customize_selective_refresh' => true, )
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Video Gallery', 'wp-masjid' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		
		echo $args['before_widget'];
		if ( get_theme_mod('wm_mode') == "khalifah" ) {
		?>
		    <div class="widget__video">
			    <?php if ( $title ) { echo '<span class="kavid__title">' . esc_html( $title ) . '</span>'; }
				?>
		    	<div class="box__video div__clear">
				    <?php
				    	$layanan_arg = array( 
					    	'post_type' => 'video',
							'posts_per_page' => 3,
						);
						$layanan = get_posts($layanan_arg);
						echo '<div class="' . esc_attr( $args['widget_id'] ) . '">';
						
						global $post;
						foreach ($layanan as $post) {
							$vid_embed = get_post_meta($post->ID, '_embed', true);
							$video_embed = get_post_meta($post->ID, 'video_embed', true);
							setup_postdata($post);
							?>
							
							<div class="kavid__loop">
						    	<div class="kavid__inn">
								    <?php 
									    if ($video_embed == !'') {
							                echo wp_oembed_get( $video_embed );
						                } else if ( $vid_embed !="" ) { 
										?>
								        	<iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $vid_embed ); ?>" frameborder="0" allowfullscreen></iframe>
						            	<?php 
										} 
									?>
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
		} else {
		?>
		
	    	<div class="widget__video">
			    <?php
					if ( $title ) {
						echo '<span class="vid__title">' . esc_html( $title ) . '</span>';
					}
				?>
		    	<div class="box__video div__clear">
				    <?php
				    	$layanan_arg = array( 
					    	'post_type' => 'video',
							'showposts' => 3,
						);
						$layanan = get_posts($layanan_arg);
						echo '<div class="' .$args['widget_id']. '">';
						
						global $post;
						foreach ($layanan as $post) {
							$vid_embed = get_post_meta($post->ID, '_embed', true);
							$video_embed = get_post_meta($post->ID, 'video_embed', true);
							setup_postdata($post);
							?>
							
							<div class="loop__video">
						    	<div class="inner__video">
								    <?php 
									    if ($video_embed == !'') {
							                echo wp_oembed_get( $video_embed );
						                } else if ( $vid_embed !="" ) { 
										?>
								        	<iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $vid_embed ); ?>" frameborder="0" allowfullscreen></iframe>
						            	<?php 
										} 
									?>
								</div>
							</div>
							
							
							<?php 
						}
						
						echo '</div>';
						wp_reset_query();
					?>
				</div>
			</div>
		
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
		$title       = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'Video Gallery', 'wp-masjid' );
		?>
		
		<div class="wm__inwidget">
	    	<?php echo esc_html__( 'Widget display Video Gallery', 'wp-masjid' ); ?>
		</div>
		<div class="wm__inwidget">
	    	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title', 'wp-masjid' ); ?></label>
	    	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</div>
		
    <?php
	}
}