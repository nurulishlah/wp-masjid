    <div class="display__pengurus">
		<div class="outer__dkm div__clear">
				<?php 
				    query_posts('post_type=takmir&showposts=50');
				    if (have_posts()) {
						echo '<div class="display__dkm owl-carousel owl-theme">';
						while (have_posts()): the_post(); 
						$jabat = get_post_meta($post->ID, '_jabat', true);
						?>
			    	    	<div class="item">
				    	    	<div class="div__clear">
								    <div class="dkm__img">
				    			    	<?php 
								    	    if (has_post_thumbnail()) {
								    			the_post_thumbnail('thumbnail', array(
								            		'alt' => trim(strip_tags($post->post_title)),
								    		    	'title' => trim(strip_tags($post->post_title)),
								    		    ));
								    		} 
								    	?>
									</div>										
			    					<div class="dkm__bio">
				    			        <div class="dkm__jabat">
									    	<?php 
										    	if ( $jabat != "" ) {
													echo $jabat;
												} 
											?>
										</div>
			    				    	<div class="dkm__nama"><?php the_title() ?></div>
			    				    </div>
								</div>
				    		</div>
					   	<?php
						endwhile;
						echo '</div>';
						?>
						<script>
    			            jQuery(document).ready(function($) {
    			                var owl = $('.display__dkm');
    			                owl.owlCarousel({
    			                    loop: true,
    			                    nav: false,
						    		dots: false,
									animateIn : 'fadeIn',
									animateOut : 'fadeOut',
                			        lazyLoad: true,
    						    	autoplay: true,
				    				smartSpeed: 1000,
    			                    autoplayTimeout: 4000,
    			                    autoplayHoverPause: true,
    						    	items:1,
									margin: 20,									
    			                });
    			            });
					    </script>
						<?php
					}
					wp_reset_query();
				?>
		</div>
	</div>
			
			