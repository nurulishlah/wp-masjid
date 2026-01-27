                                <?php 
									if ( get_theme_mod('run_text') != "" ) {
										$stringWithoutHTMLAndShortcode = preg_replace('/\[.*?\]/', '', strip_tags(get_theme_mod('run_text')));
							        	$wordCount = str_word_count($stringWithoutHTMLAndShortcode);
										?>
										<div class="runscroll">
								    	    <div class="scroll">
										        <?php
											        $iterations = 0;
											        if ( $wordCount < 2 ) {
											            $iterations = 45;
											        } elseif ( $wordCount < 3 ) {
											            $iterations = 30;
											        } elseif ( $wordCount < 4 ) {
											            $iterations = 22;
											        } elseif ( $wordCount < 5 ) {
											            $iterations = 18;
											        } elseif ( $wordCount < 6 ) {
											            $iterations = 15;
											        } elseif ( $wordCount < 7 ) {
											            $iterations = 12;
											        } elseif ( $wordCount < 8 ) {
											            $iterations = 11;
											        } elseif ( $wordCount < 9 ) {
											            $iterations = 10;
											        } elseif ( $wordCount < 10 ) {
											            $iterations = 9;
											        } elseif ( $wordCount < 11 ) {
											            $iterations = 8;
											        } elseif ( $wordCount < 13 ) {
											            $iterations = 7;
											        } elseif ( $wordCount < 15 ) {
											            $iterations = 6;
											        } elseif ( $wordCount < 19 ) {
											            $iterations = 5;
											        } elseif ( $wordCount < 24 ) {
											            $iterations = 4;
											        } elseif ( $wordCount < 35 ) {
											            $iterations = 3;
											        } elseif ( $wordCount < 52 ) {
											            $iterations = 2;
											        } elseif ( $wordCount < 65 ) {
											            $iterations = 1;
											        }

											        for ( $i = 0; $i < $iterations; $i++ ) {
											            echo '<div class="scrollin">'. get_theme_mod( 'run_text' ) .' <span>'. get_theme_mod( 'run_text' ) .'</span></div>';
											        	echo '<div class="scrollin">'. get_theme_mod( 'run_text' ) .' <span>'. get_theme_mod( 'run_text' ) .'</span></div>';
											        }
											    ?>
											</div>
								    	</div>
									<?php } ?>