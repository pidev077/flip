<?php

add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style('theme-styles', get_template_directory_uri() . '/dist/css/style.css', array(), uniqid());
	wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/dist/js/main.bundle.js', array('jquery'), uniqid(), true);

	if (is_page_template('page-booking.php')) {
		wp_enqueue_style('page-booking', get_template_directory_uri() . '/dist/css/page-booking.css', array('theme-styles'), uniqid());
	}

	if (is_page_template('page-lien-he.php')) {
		wp_enqueue_style('page-lien-he', get_template_directory_uri() . '/dist/css/page-lien-he.css', array('theme-styles'), uniqid());
	}

	if (is_page_template('page-daotao.php')) {
		wp_enqueue_style('page-daotao', get_template_directory_uri() . '/dist/css/page-daotao.css', array('theme-styles'), uniqid());
	}

	if (is_page_template('page-thanks.php')) {
		wp_enqueue_style('page-thanks', get_template_directory_uri() . '/dist/css/page-thanks.css', array('theme-styles'), uniqid());
	}

	wp_localize_script('app-scripts', 'php_data', [
		'admin_logged' => in_array('administrator', wp_get_current_user()->roles) ? 'yes' : 'no',
		'ajax_url' => admin_url('admin-ajax.php'),
		'site_url' => site_url(),
		'rest_url' => get_rest_url(),
	]);

	wp_localize_script('theme-scripts', 'themeData', [
		'templateUrl' => get_template_directory_uri()
	]);
});

if (!function_exists('flip_load_fonts')) {
	/**
	 * Load custom font family
	 */
	function flip_load_fonts()
	{
		wp_enqueue_style('primary-font', get_template_directory_uri() . '/assets/fonts/stylesheet.css', [], FLIP_WP_TOOLKIT_VER);
	}
}

add_action('admin_enqueue_scripts', 'flip_load_fonts');
