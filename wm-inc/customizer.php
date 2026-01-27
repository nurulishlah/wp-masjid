<?php
/**
 * Customizer WP wm
 * Setting tema dari menu Customizer
 */

function wm_customize_register( $wp_customize ) {
include("google-font.php");
$wp_customize->add_panel('wm_profile',array(
    'title'       => __('WP Masjid : Setting', 'wp-masjid'),
    'description' => __('Setting WP Masjid theme', 'wp-masjid'),
    'priority'    => 40,
));

$wp_customize->add_section('mw_profilmasjid',array(
    'title'       => __('Mosque Profile', 'wp-masjid'),
    'description' => __('Complete mosque profile', 'wp-masjid'),
    'priority'    => 10,
    'panel'       => 'wm_profile',
));
// 1. Nama Masjid
$wp_customize->add_setting('nama_masjid',array(
    'default'           => __('Masjid At-Taqwa', 'wp-masjid'),
	'transport'         => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('nama_masjid',array(
    'label'        => __('Mosque Name', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'mw_profilmasjid',
    'settings'     => 'nama_masjid',
));
// 2. Luas Tanah
$wp_customize->add_setting('luas_tanah',array(
    'default'           => '',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('luas_tanah',array(
    'label'        => __('Land Area (m2)', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'mw_profilmasjid',
    'settings'     => 'luas_tanah',
));
// 3. Luas Bangunan
$wp_customize->add_setting('luas_bang',array(
    'default'           => '',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('luas_bang',array(
    'label'        => __('Building Area (m2)', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'mw_profilmasjid',
    'settings'     => 'luas_bang',
));
// 4. Status Tanah / Lokasi
$wp_customize->add_setting('status_tanah',array(
    'default'           => '',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('status_tanah',array(
    'label'        => __('Land / Location Status', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'mw_profilmasjid',
    'settings'     => 'status_tanah',
));
// 5. Tahun Berdiri
$wp_customize->add_setting('tahun_masjid',array(
    'default'           => '',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('tahun_masjid',array(
    'label'        => __('Year Established', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'mw_profilmasjid',
    'settings'     => 'tahun_masjid',
));
// 6. Alamat
$wp_customize->add_setting('alamat',array(
    'default'           => '',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('alamat',array(
    'label'        => __('Address', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'mw_profilmasjid',
    'settings'     => 'alamat',
));
function custom_wpkses_post_tags( $tags, $context ) {
	if ( 'post' === $context ) {
		$tags['iframe'] = array(
			'src'             => true,
			'height'          => true,
			'width'           => true,
			'frameborder'     => true,
			'allowfullscreen' => true,
		);
	}
	return $tags;
}

add_filter( 'wp_kses_allowed_html', 'custom_wpkses_post_tags', 10, 2 );
// 7. Embed Maps
$wp_customize->add_setting( 'masjid_maps', array(
	'default'           => '',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('masjid_maps',array(
    'label'        => __( 'Embed Maps', 'wp-masjid' ),
	'description'  => __( 'Get embed code form this <a target="_blank" href="https://ciuss.com/embed-maps/">Video</a>', 'wp-masjid' ),
    'type'         => 'textarea',
    'section'      => 'mw_profilmasjid',
    'settings'     => 'masjid_maps',
));
// 8. Nomer Telepon
$wp_customize->add_setting('masjid_telpon',array(
    'default'           => '',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('masjid_telpon',array(
    'label'        => __('Phone', 'wp-masjid' ),
    'type'         => 'text',
    'section'      => 'mw_profilmasjid',
    'settings'     => 'masjid_telpon',
	'input_attrs' => array(
        'placeholder' => __( '0856...', 'wp-masjid' ),
    )
));
// 9. Nomer WhatsApp
$wp_customize->add_setting('masjid_whatsapp',array(
    'default'           => '',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('masjid_whatsapp',array(
    'label'        => __('WhatsApp', 'wp-masjid' ),
    'type'         => 'text',
    'section'      => 'mw_profilmasjid',
    'settings'     => 'masjid_whatsapp',
	'input_attrs' => array(
        'placeholder' => __( '+62...', 'wp-masjid' ),
    )
));
// 10. Alamat Email
$wp_customize->add_setting('masjid_email',array(
    'default'           => '',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'sanitize_email'
));
$wp_customize->add_control('masjid_email',array(
    'label'        => __('Email', 'wp-masjid'),
    'type'         => 'email',
    'section'      => 'mw_profilmasjid',
    'settings'     => 'masjid_email',
	'input_attrs' => array(
        'placeholder' => __( 'email@domain.com...', 'wp-masjid' ),
    )
));
// 11. Facebook
$wp_customize->add_setting('masjid_facebook',array(
    'default'     => '',
	'transport'   => 'postMessage',
	'sanitize_callback' => 'esc_url_raw'
));
$wp_customize->add_control('masjid_facebook',array(
    'label'        => __('Facebook', 'wp-masjid'),
    'type'         => 'url',
    'section'      => 'mw_profilmasjid',
    'settings'     => 'masjid_facebook',
	'input_attrs' => array(
        'placeholder' => __( 'https://...', 'wp-masjid' ),
    )
));
// 12. Twitter
$wp_customize->add_setting('masjid_twitter',array(
    'default'     => '',
	'transport'   => 'postMessage',
	'sanitize_callback' => 'esc_url_raw'
));
$wp_customize->add_control('masjid_twitter',array(
    'label'        => __('Twitter', 'wp-masjid'),
    'type'         => 'url',
    'section'      => 'mw_profilmasjid',
    'settings'     => 'masjid_twitter',
	'input_attrs' => array(
        'placeholder' => __( 'https://...', 'wp-masjid' ),
    )
));
// 13. Instagram
$wp_customize->add_setting('masjid_instagram',array(
    'default'     => '',
	'transport'   => 'postMessage',
	'sanitize_callback' => 'esc_url_raw'
));
$wp_customize->add_control('masjid_instagram',array(
    'label'       => __('Instagram', 'wp-masjid'),
    'type'        => 'url',
    'section'     => 'mw_profilmasjid',
    'settings'    => 'masjid_instagram',
	'input_attrs' => array(
        'placeholder' => __( 'https://...', 'wp-masjid' ),
    )
));
// 14. Youtube
$wp_customize->add_setting('masjid_youtube',array(
    'default'     => '',
	'transport'   => 'postMessage',
	'sanitize_callback' => 'esc_url_raw'
));
$wp_customize->add_control('masjid_youtube',array(
    'label'       => __('Youtube', 'wp-masjid'),
    'type'        => 'url',
    'section'     => 'mw_profilmasjid',
    'settings'    => 'masjid_youtube',
	'input_attrs' => array(
        'placeholder' => __( 'https://...', 'wp-masjid' ),
    )
));



$wp_customize->add_section('wm_shalat',array(
    'title'       => __('Daily Officer', 'wp-masjid'),
    'priority'    => 30,
    'panel'       => 'wm_profile',
));
// Layout
$wp_customize->add_setting('js_mode',array(
    'default'     => 'idsholat',
	'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('js_mode',array(
    'label'        => __('Choose Source', 'wp-masjid'),
	'description'  => __('Choose Source for Prayer Time', 'wp-masjid'),
    'type'         => 'select',
	'choices'      => array(
		'idsholat'      => 'ID Sholat',
		'muslimpro'    => 'Muslimpro',
	),
    'section'      => 'wm_shalat',
    'settings'     => 'js_mode',
));
$wp_customize->add_setting('city_id',array(
    'default'           => '1637532',
	'transport'         => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('city_id',array(
    //'label'           => __('City ID', 'wp-masjid'),
	'description'     => __('Get city ID from <a href="https://muslimpro.com">muslimpro.com</a>', 'wp-masjid'),
	'type'            => 'text',
    'section'         => 'wm_shalat',
	'input_attrs'     => array(
        'placeholder'    => __( 'muslimpro id...', 'wp-masjid' ),
    ),
    'settings'        => 'city_id',
	'active_callback'   => 'active_muslimpro',
));
$wp_customize->add_setting('idsholat_id',array(
    'default'           => '8',
	'transport'         => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('idsholat_id',array(
    //'label'           => __('City ID', 'wp-masjid'),
	'description'     => __('Get city ID from <a href="https://idsholat.net">idsholat.net</a>', 'wp-masjid'),
    'type'            => 'text',
    'section'         => 'wm_shalat',
	'input_attrs'     => array(
        'placeholder'    => __( 'idsholat.net ID...', 'wp-masjid' ),
    ),
    'settings'        => 'idsholat_id',
	'active_callback'   => 'active_idsholat',
));

// Method
$wp_customize->add_setting('method_id',array(
    'default'     => 'KEMENAG',
	'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('method_id',array(
    'label'        => __('Choose Method', 'wp-masjid'),
	'description'  => __('Choose calculation method', 'wp-masjid'),
    'type'         => 'select',
	'choices'      => array(
		'KEMENAG'   => 'Sihat Kemenag',
		'MWL'       => 'Muslim World League',
		'ISNA'      => 'Islamic Society of North America',
		'Egypt'     => 'Egyptian General Authority of Survey',
		'Makkah'    => 'Umm Al-Qura University, Makkah',
		'Karachi'   => 'University of Islamic Sciences, Karachi',
		'Tehran'    => 'Institute of Geophysics, University of Tehran',
		'Jafari'    => 'Shia Ithna-Ashari, Leva Institute, Qum',
		'UOIF'      => 'Union des Organisations Islamiques de France',
		'MUIS'      => 'Majlis Ugama Islam Singapura',
		'Algerian'  => 'Ministère des Affaires Religieuses et des Wakfs',
		'Diyanet'   => 'Diyanet İşleri Başkanlığı, Turkey',
		'JAKIM'     => 'Jabatan Kemajuan Islam Malaysia',
	),
    'section'      => 'wm_shalat',
    'settings'     => 'method_id',
	'active_callback'   => 'active_idsholat',
));

$wp_customize->add_setting('subuh_imam',array(
    'default'           => '',
	'transport'         => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('subuh_imam',array(
    'label'        => __('Fajr', 'wp-masjid'),
	'description'  => __('Imam', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'wm_shalat',
    'settings'     => 'subuh_imam',
));
$wp_customize->add_setting('subuh_muadzin',array(
    'default'           => '',
	'transport'         => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('subuh_muadzin',array(
	'description'  => __('Muadzin', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'wm_shalat',
    'settings'     => 'subuh_muadzin',
));
// 2. DZUHUR
$wp_customize->add_setting('dzuhur_imam',array(
    'default'           => '',
	'transport'         => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('dzuhur_imam',array(
    'label'        => __('Dhuhr', 'wp-masjid'),
	'description'  => __('Imam', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'wm_shalat',
    'settings'     => 'dzuhur_imam',
));
$wp_customize->add_setting('dzuhur_muadzin',array(
    'default'           => '',
	'transport'         => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('dzuhur_muadzin',array(
	'description'  => __('Muadzin', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'wm_shalat',
    'settings'     => 'dzuhur_muadzin',
));
// 3. ASHAR
$wp_customize->add_setting('ashar_imam',array(
    'default'           => '',
	'transport'         => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('ashar_imam',array(
    'label'        => __('Asr', 'wp-masjid'),
	'description'  => __('Imam', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'wm_shalat',
    'settings'     => 'ashar_imam',
));
$wp_customize->add_setting('ashar_muadzin',array(
    'default'           => '',
	'transport'         => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('ashar_muadzin',array(
	'description'  => __('Muadzin', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'wm_shalat',
    'settings'     => 'ashar_muadzin',
));
// 4. MAGHRIB
$wp_customize->add_setting('maghrib_imam',array(
    'default'           => '',
	'transport'         => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('maghrib_imam',array(
    'label'        => __('Maghrib', 'wp-masjid'),
	'description'  => __('Imam', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'wm_shalat',
    'settings'     => 'maghrib_imam',
));
$wp_customize->add_setting('maghrib_muadzin',array(
    'default'           => '',
	'transport'         => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('maghrib_muadzin',array(
	'description'  => __('Muadzin', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'wm_shalat',
    'settings'     => 'maghrib_muadzin',
));
// 4. ISYA
$wp_customize->add_setting('isya_imam',array(
    'default'           => '',
	'transport'         => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('isya_imam',array(
    'label'        => __('Isha', 'wp-masjid'),
	'description'  => __('Imam', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'wm_shalat',
    'settings'     => 'isya_imam',
));
$wp_customize->add_setting('isya_muadzin',array(
    'default'           => '',
	'transport'         => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('isya_muadzin',array(
	'description'  => __('Muadzin', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'wm_shalat',
    'settings'     => 'isya_muadzin',
));


// Layout Setting
$wp_customize->add_section('wm_layout',array(
    'title'       => __('Layout Setting', 'wp-masjid'),
    'priority'    => 30,
    'panel'       => 'wm_profile',
));

// Layout
$wp_customize->add_setting('wm_mode',array(
    'default'     => 'wp-masjid',
	'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('wm_mode',array(
    'label'        => __('Choose Layout', 'wp-masjid'),
	'description'  => __('Choose Layout for Frontend', 'wp-masjid'),
    'type'         => 'select',
	'choices'      => array(
		'masjid'      => 'WP Masjid',
		'khalifah'    => 'Khalifah',
	),
    'section'      => 'wm_layout',
    'settings'     => 'wm_mode',
));

$wp_customize->add_setting('global_hidden',array(
    'default'     => '',
	'transport'   => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('global_hidden',array(
    'description' => '<div class="custom_area customize-control-title">'.__( 'Font Setting', 'wp-masjid' ).'</div>',
    'type'        => 'hidden',
    'section'     => 'wm_layout',
    'settings'    => 'global_hidden',
));

$wp_customize->add_setting('global_fonts',array(
    'default'     => '',
	'transport'   => 'refresh',
	'sanitize_callback' => 'web_sanitize_fonts'
));
$wp_customize->add_control('global_fonts',array(
	'description'  => __( 'Global Font', 'wp-masjid' ),
    'type'         => 'select',
	'choices'      => $font_choices,
    'section'      => 'wm_layout',
    'settings'     => 'global_fonts',
));
$wp_customize->add_setting('global_fontsize',array(
    'default'     => 14,
	'transport'   => 'postMessage',
	'sanitize_callback' => 'absint'
));
$wp_customize->add_control('global_fontsize',array(
	'description'  => __( 'Font Size', 'wp-masjid' ),
    'type'         => 'number',
	'input_attrs' => array(
        'min'     => 13,
		'max'     => 16,
    ),
    'section'      => 'wm_layout',
    'settings'     => 'global_fontsize',
));
$wp_customize->add_setting('header_fonts',array(
    'default'     => '',
	'transport'   => 'refresh',
	'sanitize_callback' => 'web_sanitize_fonts'
));
$wp_customize->add_control('header_fonts',array(
	'description'  => __( 'Heading Font', 'wp-masjid' ),
    'type'         => 'select',
	'choices'      => $font_choices,
    'section'      => 'wm_layout',
    'settings'     => 'header_fonts',
));

$wp_customize->add_setting('share_hidden',array(
    'default'     => '',
	'transport'   => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('share_hidden',array(
    'description' => '<div class="custom_area custom_share customize-control-title">'.__( 'Default Thumbnail Share', 'wp-masjid' ).'</div>',
    'type'        => 'hidden',
    'section'     => 'wm_layout',
    'settings'    => 'share_hidden',
));
// Foto Share
$wp_customize->add_setting( 'share_image', array(
    'default' => get_theme_file_uri('wm-img/share.jpg'), // Add Default Image URL 
	'transport'   => 'postMessage',
    'sanitize_callback' => 'esc_url_raw'
));
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'share_image', array(
    'label'       => __('Default Thumbnail Share', 'wp-masjid'),
	'description' => __('Set a default thumbnail image for sharing to Facebook, Twitter, and WhatsApp', 'wp-masjid'),
    'section'     => 'wm_layout',
    'settings'    => 'share_image',
    'button_labels' => array(// All These labels are optional
        'select' => 'Choose Image',
        'remove' => 'Remove Image',
        'change' => 'Change Image',
    )
)));
$wp_customize->add_setting( 'thumb_image', array(
    'default' => get_theme_file_uri('wm-img/share.jpg'), // Add Default Image URL 
	'transport'   => 'postMessage',
    'sanitize_callback' => 'esc_url_raw'
));
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'thumb_image', array(
    'label'       => __('Default Thumbnail Post', 'wp-masjid'),
	'description' => __('Set a default thumbnail image for pos', 'wp-masjid'),
    'section'     => 'wm_layout',
    'settings'    => 'thumb_image',
    'button_labels' => array(// All These labels are optional
        'select' => __('Choose Image', 'wp-masjid'),
        'remove' => __('Remove Image', 'wp-masjid'),
        'change' => __('Change Image', 'wp-masjid'),
    )
)));

// Run
$wp_customize->add_setting('run_hidden',array(
    'default'     => '',
	'transport'   => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('run_hidden',array(
    'description' => '<div class="custom_area customize-control-title">'.__( 'Running Text', 'wp-masjid' ).'</div>',
    'type'        => 'hidden',
    'section'     => 'wm_layout',
    'settings'    => 'run_hidden',
));
$wp_customize->add_setting('run_text',array(
    'default'      => __('Running text is configured via Appearance > Customize > WP Masjid: Settings > Layout Settings', 'wp-masjid'),
	'transport'    => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('run_text',array(
    'description'  => __('Use shortcode<br/>[spasi] for space<br/>[strong]Text[/strong]<br/>[span]Text[/span]<br/>[a link="https://.."]text[/a]', 'wp-masjid'),
    'type'         => 'textarea',
    'section'      => 'wm_layout',
    'settings'     => 'run_text',
));	

$wp_customize->add_setting('notfound_hidden',array(
    'default'     => '',
	'transport'   => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('notfound_hidden',array(
    'description' => '<div class="custom_area custom_notfound customize-control-title">'.__( '404 Page', 'wp-masjid' ). '</div>',
    'type'        => 'hidden',
    'section'     => 'wm_layout',
    'settings'    => 'notfound_hidden',
));
$wp_customize->add_setting('head_404',array(
    'default'     => __('Error 404 Not Found', 'wp-masjid'),
	'transport'   => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('head_404',array(
	'description'  => __('Heading 404', 'wp-masjid'),
    'type'         => 'text',
    'section'      => 'wm_layout',
    'settings'     => 'head_404',
));
$wp_customize->add_setting('text_404',array(
    'default'     => __('The page you requested is unavailable', 'wp-masjid'),
	'transport'   => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('text_404',array(
	'description'  => __('Text 404', 'wp-masjid'),
    'type'         => 'textarea',
    'section'      => 'wm_layout',
    'settings'     => 'text_404',
));

// Dev Section
$wp_customize->add_section('dev_section',array(
    'title'       => __('Meet the Developer', 'wp-masjid'),
    'priority'    => 90,
    'panel'       => 'wm_profile',
));
$wp_customize->add_setting('upload_hidden',array(
    'default'     => __( 'Download', 'wp-masjid' ),
	'transport'   => 'postMessage',
	'sanitize_callback' => ''
));
$wp_customize->add_control('upload_hidden',array(
    'description' => '<div class="custom_area customize-control-title">'.__( 'Meet the Developer', 'wp-masjid' ).'</div>',
    'type'        => 'hidden',
    'section'     => 'dev_section',
    'settings'    => 'upload_hidden',
));
$wp_customize->add_setting('text_hidden',array(
    'default'     => __( 'Download', 'wp-masjid' ),
	'transport'   => 'postMessage',
	'sanitize_callback' => ''
));
$wp_customize->add_control('text_hidden',array(
    'description' => '<div class="dev_area"><img src="' . esc_url( get_theme_file_uri('wm-img/dev.jpg' )) . '" /><br/>'.__( 'Hello, I am Yayun from Ciuss Creative, the developer of the WP Masjid theme.<br/><br/>Thank you for using the WP Masjid theme, which we have been developing since 2017 and continue to maintain today.<br/><br/>We kindly ask for your prayers and support to enable us to continue providing updates and support for the WP Masjid theme.', 'wp-masjid' ) . '</div>',
    'type'        => 'hidden',
    'section'     => 'dev_section',
    'settings'    => 'text_hidden',
));

$wp_customize->add_setting('copy_hidden',array(
    'default'     => '',
	'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('copy_hidden',array(
    'description' => '<div class="custom_area custom_notfound customize-control-title">'.__( 'Footer', 'wp-masjid' ) .'</div>',
    'type'        => 'hidden',
    'section'     => 'wm_layout',
    'settings'    => 'copy_hidden',
));

$wp_customize->add_setting('wm_footer',array(
    'default'     => '',
	'transport'   => 'postMessage',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control('wm_footer',array(
	'description'  => __('Change Footer Text', 'wp-masjid'),
    'type'         => 'textarea',
    'section'      => 'wm_layout',
    'settings'     => 'wm_footer',
));
}
add_action( 'customize_register', 'wm_customize_register', 11 );



function active_masjid( $control ) {
   if ( $control->manager->get_setting('wm_mode')->value() == 'wp-masjid' ) {
      return true;
   } else {
      return false;
   }
}
function active_khalifah( $control ) {
   if ( $control->manager->get_setting('wm_mode')->value() == 'khalifah' ) {
      return true;
   } else {
      return false;
   }
}

function active_idsholat( $control ) {
   if ( $control->manager->get_setting('js_mode')->value() == 'idsholat' ) {
      return true;
   } else {
      return false;
   }
}
function active_muslimpro( $control ) {
   if ( $control->manager->get_setting('js_mode')->value() == 'muslimpro' ) {
      return true;
   } else {
      return false;
   }
}
