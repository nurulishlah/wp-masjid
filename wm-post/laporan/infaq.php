<?php 
	if ( get_theme_mod('opsi_editor') != "false" ) {
	    $showinrest = true;
	} else {
	    $showinrest = false;
    }
	register_post_type( 'infaq',		
	array(			
	    'menu_icon' => 'dashicons-book-alt',
		'labels' => array(				
	        'name'               => __( 'Infaq Report', 'wp-masjid' ),
			'singular_name'      => __( 'Infaq Report', 'wp-masjid' ),			
	    ),		                	
		'public'               => true,           					            
		'has_archive'          => true,        			            
		'supports'             => array( 'title', 'thumbnail'),        			            
		'exclude_from_search'  => false,
		'show_in_rest'         => $showinrest,
	)	
    );
	
	add_action('admin_init', 'lap_infaq', 1);
	function lap_infaq() {
	    add_meta_box('masjid_infaq', __( 'Infaq Report', 'wp-masjid' ), 'masjid_infaq', 'infaq', 'normal', 'default');
	}

	function masjid_infaq() {
	    global $post;
	    echo '<input type="hidden" name="infaqmeta_noncename" id="infaqmeta_noncename" value="' .
	    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
        $status    = get_post_meta($post->ID, '_status', true);
	    $tanginfaq = get_post_meta($post->ID, '_tanginfaq', true);
	    $juminfaq  = get_post_meta($post->ID, '_juminfaq', true);
		$asalinfaq = get_post_meta($post->ID, '_asalinfaq', true);
		$ketinfaq  = get_post_meta($post->ID, '_ketinfaq', true);
		?>
		
		<div class="wm_metaabox">
			<p><?php echo __('Complete the latest donation (infaq) report data below. The most recent infaq report will be displayed on the Homepage', 'wp-masjid'); ?><br/></p>
			<div class="div__clear">
		    	<input type="radio" name="_status" <?php checked($status, 'masuk') ?> value="masuk"/><span class="stt" style="margin: 0 50px 0 0;"><?php _e('Funds Received', 'wp-masjid'); ?></span>
				<input type="radio" name="_status" <?php checked($status, 'keluar'); ?> value="keluar"/><span class="stt"><?php _e('Funds Disbursed', 'wp-masjid'); ?></span>
			</div>
			<p><?php echo __('Date', 'wp-masjid'); ?></p>
	        <input type="date" name="_tanginfaq" value="<?php echo esc_attr( $tanginfaq ); ?>" class="tanggal widefat" />
	        <p><?php echo __('Amount (example : 1.000.000)', 'wp-masjid'); ?></p>
	        <input type="text" name="_juminfaq" value="<?php echo esc_attr( $juminfaq ); ?>" class="widefat" />
			<p><?php echo __('From (example : Jakarta)', 'wp-masjid'); ?></p>
	        <input type="text" name="_asalinfaq" value="<?php echo esc_attr( $asalinfaq ); ?>" class="widefat" />
			<p><?php echo __('Description', 'wp-masjid'); ?> (<span style="color: #dd2222;"><?php echo __('to be filled if funds are disbursed', 'wp-masjid'); ?></span>)</p>
	        <input type="text" name="_ketinfaq" value="<?php echo esc_attr( $ketinfaq ); ?>" class="widefat" />
		</div>
		
		<?php	
	}

	function masjid_infaq_meta($post_id, $post) {
	    if ( !isset( $_POST['infaqmeta_noncename'] ) || !wp_verify_nonce( $_POST['infaqmeta_noncename'], plugin_basename(__FILE__) )) {
			return $post->ID;
		}

	    if ( !current_user_can( 'edit_post', $post->ID ))
	        return $post->ID;

	    $events_meta['_status']    = $_POST['_status'];
		$events_meta['_tanginfaq'] = $_POST['_tanginfaq'];
		$events_meta['_juminfaq']  = $_POST['_juminfaq'];
		$events_meta['_asalinfaq'] = $_POST['_asalinfaq'];
		$events_meta['_ketinfaq']  = $_POST['_ketinfaq'];

	    foreach ($events_meta as $key => $value) {         
		    if( $post->post_type == 'revision' ) return; 
	        $value = implode(',', (array)$value); 
	        if(get_post_meta($post->ID, $key, FALSE)) { 
	            update_post_meta($post->ID, $key, $value);
	        } else { 
	            add_post_meta($post->ID, $key, $value);
	        }
	        if(!$value) delete_post_meta($post->ID, $key); 
	    }
	}

	add_action('save_post', 'masjid_infaq_meta', 1, 2); 
	
// Tambahkan menu di admin untuk halaman ekspor
add_action('admin_menu', 'add_export_page');

function add_export_page() {
    add_submenu_page(
        'edit.php?post_type=infaq',
        __('Export Report (CSV)', 'wp-masjid'),
        __('Export Report (CSV)', 'wp-masjid'),
        'manage_options',
        'export-posts',
        'export_infaq_page'
    );
}

// Fungsi untuk menampilkan halaman ekspor
function export_infaq_page() {
    ?>
    <div class="wrap">
        <h2><?php echo __('Export Report (CSV)', 'wp-masjid'); ?></h2>
        <form method="post">
            <input type="hidden" name="export_infaq" value="true" />
            <?php submit_button('Export'); ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', 'export_infaq');

function export_infaq() {
    if (isset($_POST['export_infaq']) && $_POST['export_infaq'] == 'true') {
        global $wpdb;

        $posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'infaq' AND post_status = 'publish'");

        if ($posts) {
			$fields = ['ID', 'Title', 'Publish', 'Status', 'Date', 'Amount', 'City', 'Desc', 'Month', 'Year'];
			$csv_output = implode(',', array_map(function($field) {
				return in_array($field, ['Date', 'Amount', 'City', 'Desc', 'Month', 'Year']) 
				? __($field, 'wp-masjid') 
				: $field;
			}, $fields)) . "\n";

            foreach ($posts as $post) {
                $post_id = $post->ID;
                $post_title = $post->post_title;
                $post_date = $post->post_date;

                // Ambil data custom field
                $status    = get_post_meta($post->ID, '_status', true);
				$tanginfaq = get_post_meta($post->ID, '_tanginfaq', true);
				$juminfaq  = get_post_meta($post->ID, '_juminfaq', true);
				$asalinfaq = get_post_meta($post->ID, '_asalinfaq', true);
				$ketinfaq  = get_post_meta($post->ID, '_ketinfaq', true);

                // Ambil custom taxonomy "bulan"
                $bulan_terms = wp_get_post_terms($post_id, 'bulan');
                $bulan = !empty($bulan_terms) ? $bulan_terms[0]->name : '';

                // Ambil custom taxonomy "tahun"
                $tahun_terms = wp_get_post_terms($post_id, 'tahun');
                $tahun = !empty($tahun_terms) ? $tahun_terms[0]->name : '';

                // Format baris CSV
                $csv_output .= "$post_id,\"$post_title\",\"$post_date\",\"$status\",\"$tanginfaq\",\"$juminfaq\",\"$asalinfaq\",\"$ketinfaq\",\"$bulan\",\"$tahun\"\n";
            }

            // Header untuk men-download file CSV
			$dates = date('D-m-Y-His');
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=laporan-infaq-wp-masjid-$dates.csv");
            header("Pragma: no-cache");
            header("Expires: 0");

            // Keluarkan data CSV
            echo $csv_output;
            exit;
        }
    }
}






// Tambahkan menu di admin untuk halaman impor
add_action('admin_menu', 'add_import_page');

function add_import_page() {
    add_submenu_page(
        'edit.php?post_type=infaq',
        __('Import Report (CSV)', 'wp-masjid'),
        __('Import Report (CSV)', 'wp-masjid'),
        'manage_options',
        'import-posts',
        'import_infaq_page'
    );
}

// Fungsi untuk menampilkan halaman impor
function import_infaq_page() {
    ?>
    <div class="wrap">
        <h2><?php echo __('Import Report (CSV)', 'wp-masjid'); ?></h2>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="csv_file" accept=".csv" />
            <br />
            <?php submit_button('Import'); ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', 'import_infaq');

function import_infaq() {
    if (isset($_FILES['csv_file'])) {
        if ($_FILES['csv_file']['error'] == 0) {
            $csv_file = $_FILES['csv_file']['tmp_name'];
            $csv_data = array_map('str_getcsv', file($csv_file));

            $success_count = 0;
            $failure_count = 0;

            foreach ($csv_data as $key => $row) {
                if ($key == 0) continue; // Skip header row

                // Extract data from CSV row
                $post_title   = $row[1];
                $post_date    = $row[2];
                $status       = $row[3];
                $tanginfaq    = $row[4];
                $juminfaq     = $row[5];
                $asalinfaq    = $row[6];
                $ketinfaq     = $row[7];
                $bulan        = $row[8];
                $tahun        = $row[9];

                // Prepare post data
                $post_data = array(
                    'post_title'   => $post_title,
                    'post_content' => '', // You may customize this based on your CSV structure
                    'post_status'  => 'publish',
                    'post_type'    => 'infaq',
                    'post_date'    => $post_date,
                );

                // Insert post
                $post_id = wp_insert_post($post_data);

                if ($post_id) {
                    // Set custom fields
                    update_post_meta($post_id, '_status', $status);
                    update_post_meta($post_id, '_tanginfaq', $tanginfaq);
                    update_post_meta($post_id, '_juminfaq', $juminfaq);
                    update_post_meta($post_id, '_asalinfaq', $asalinfaq);
                    update_post_meta($post_id, '_ketinfaq', $ketinfaq);

                    // Set taxonomy 'bulan'
                    if (!empty($bulan)) {
                        $bulan_id = wp_create_term($bulan, 'bulan');
                        if (!is_wp_error($bulan_id) && isset($bulan_id['term_id'])) {
                            wp_set_post_terms($post_id, $bulan_id['term_id'], 'bulan');
                        }
                    }

                    // Set taxonomy 'tahun'
                    if (!empty($tahun)) {
                        $tahun_id = wp_create_term($tahun, 'tahun');
                        if (!is_wp_error($tahun_id) && isset($tahun_id['term_id'])) {
                            wp_set_post_terms($post_id, $tahun_id['term_id'], 'tahun');
                        }
                    }

                    $success_count++;
                } else {
                    $failure_count++;
                }
            }

            // Show message after import
            echo sprintf(
			'<div class="updated"><p>%s</p></div>',
		    	sprintf(
		    	_n(
			    	'Successfully imported %1$d report. Failed to import %2$d report.',  // Singular
                    'Successfully imported %1$d reports. Failed to import %2$d reports.', // Plural
                    $success_count,
                    'wp-masjid'
				),
				$success_count,
				$failure_count
		    	)
			);
        } else {
            echo sprintf(
			'<div class="error"><p>%s</p></div>',
		    	esc_html__('Error uploading CSV file.', 'wp-masjid')
			);
        }
    }
}

// --- Custom Columns & Spreadsheet View for Infaq ---

add_filter('manage_infaq_posts_columns', 'set_custom_edit_infaq_columns');
function set_custom_edit_infaq_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['infaq_status'] = __('Status', 'wp-masjid');
    $new_columns['infaq_date'] = __('Date', 'wp-masjid');
    $new_columns['infaq_amount'] = __('Amount', 'wp-masjid');
    $new_columns['infaq_from'] = __('From', 'wp-masjid');
    $new_columns['infaq_desc'] = __('Description', 'wp-masjid');
    $new_columns['date'] = $columns['date']; 
    
    return $new_columns;
}

add_action('manage_infaq_posts_custom_column', 'custom_infaq_column', 10, 2);
function custom_infaq_column($column, $post_id) {
    switch ($column) {
        case 'infaq_status':
            $status = get_post_meta($post_id, '_status', true);
            ?>
            <select class="infaq-cell-input widefat" data-field="_status">
                <option value="masuk" <?php selected($status, 'masuk'); ?>><?php _e('Received', 'wp-masjid'); ?></option>
                <option value="keluar" <?php selected($status, 'keluar'); ?>><?php _e('Disbursed', 'wp-masjid'); ?></option>
            </select>
            <?php
            break;
        case 'infaq_date':
            $date = get_post_meta($post_id, '_tanginfaq', true);
            ?>
            <input type="date" class="infaq-cell-input widefat" data-field="_tanginfaq" value="<?php echo esc_attr($date); ?>" />
            <?php
            break;
        case 'infaq_amount':
            $amount = get_post_meta($post_id, '_juminfaq', true);
            ?>
            <input type="text" class="infaq-cell-input widefat" data-field="_juminfaq" value="<?php echo esc_attr($amount); ?>" />
            <?php
            break;
        case 'infaq_from':
            $from = get_post_meta($post_id, '_asalinfaq', true);
            ?>
            <input type="text" class="infaq-cell-input widefat" data-field="_asalinfaq" value="<?php echo esc_attr($from); ?>" />
            <?php
            break;
        case 'infaq_desc':
            $desc = get_post_meta($post_id, '_ketinfaq', true);
            ?>
            <input type="text" class="infaq-cell-input widefat" data-field="_ketinfaq" value="<?php echo esc_attr($desc); ?>" />
            <?php
            break;
    }
}

add_action('admin_enqueue_scripts', 'enqueue_infaq_quick_edit_script');
function enqueue_infaq_quick_edit_script($hook) {
    global $post_type;
    if ($hook == 'edit.php' && $post_type == 'infaq') {
        wp_enqueue_script('admin-infaq-quick-edit', get_template_directory_uri() . '/wm-script/admin-infaq-quick-edit.js', array('jquery'), false, true);
        wp_localize_script('admin-infaq-quick-edit', 'wm_infaq_vars', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('wm_infaq_nonce')
        ));
        // Add some basic CSS for the inputs
        wp_add_inline_style('admin-infaq-quick-edit', '
            .infaq-cell-input { 
                border: 1px solid #ccc; 
                box-shadow: none; 
                background: transparent;
                min_width: 100px;
            }
            .infaq-cell-input:focus {
                border-color: #007cba;
                background: #fff;
                box-shadow: 0 0 0 1px #007cba;
            }
        ');
    }
}

add_action('wp_ajax_wm_save_infaq_cell', 'wm_save_infaq_cell');
function wm_save_infaq_cell() {
    check_ajax_referer('wm_infaq_nonce', 'nonce');
    
    if (!current_user_can('edit_infaq', $_POST['post_id']) && !current_user_can('edit_posts')) {
        wp_send_json_error('Permission denied');
    }
    
    $post_id = intval($_POST['post_id']);
    $field   = sanitize_text_field($_POST['field']);
    $value   = sanitize_text_field($_POST['value']);
    
    // Allowed fields
    $allowed_fields = array('_status', '_tanginfaq', '_juminfaq', '_asalinfaq', '_ketinfaq');
    if (!in_array($field, $allowed_fields)) {
        wp_send_json_error('Invalid field');
    }
    
    update_post_meta($post_id, $field, $value);
    
    // Invalidate cache if exists (from functions.php)
    if (function_exists('wm_invalidate_infaq_cache')) {
        wm_invalidate_infaq_cache($post_id);
    }
    
    wp_send_json_success();
}
