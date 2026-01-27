<?php
/**
 * Jika pengguna mengganti wordPress ke versi lebih rendah.
 * Kembalikan tema ke default theme.
 */
function wm_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'wm_upgrade_notice' );
}
add_action( 'after_switch_theme', 'wm_switch_theme' );

function wm_upgrade_notice() {
	$message = sprintf( __( 'WP Masjid requires at least WordPress version 5.8 or higher.', 'wp-masjid' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

function wm_customize() {
	wp_die( sprintf( __( 'WP Masjid requires at least WordPress version 5.8 or higher.', 'wp-masjid' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'wm_customize' );

function wm_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'WP Masjid requires at least WordPress version 5.8 or higher.', 'wp-masjid' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'wm_preview' );