<?php
/**
 * Navigation menu registration
 */
//register_nav_menus(array(
//	'top-navigation'=>'Top navigation menu',//header menu
//));
/**
 * Enqueue scripts and styles.
 */
function test_scripts ()
{
	// Load our stylesheets and scripts.
	wp_enqueue_style(
		'style',
		get_stylesheet_uri(),
		array()
	);
	wp_enqueue_style(
		'bootstrap-min',
		get_stylesheet_directory_uri() . '/css/bootstrap.min.css',
		array()
	);
	wp_enqueue_style(
		'bootstrap',
		get_stylesheet_directory_uri() . '/css/bootstrap.css',
		array()
	);
	wp_enqueue_style(
		'font-awesome-min',
		'//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
		array()
	);
	wp_enqueue_style(
		'swiper',
		get_stylesheet_directory_uri() . '/css/swiper.css',
		array()
	);
	wp_enqueue_style(
		'jquery.fancybox',
		'//cdn.jsdelivr.net/npm/fancybox@3.0.0/dist/css/jquery.fancybox.css',
		array()
	);
	wp_deregister_script('jquery');
	wp_enqueue_script(
		'jquery',
		get_template_directory_uri() . '/js/jquery-1.8.2.min.js',
		array (),
		filemtime( get_theme_file_path('/js/jquery-1.8.2.min.js') )
	);
	wp_enqueue_script(
		'swiper',
		get_template_directory_uri() . '/js/swiper.js',
		array ('jquery'),
		filemtime( get_theme_file_path('/js/swiper.js') )
	);
	wp_enqueue_script(
		'swiper-param',
		get_template_directory_uri() . '/js/swiper-param.js',
		array ('swiper'),
		filemtime( get_theme_file_path('/js/swiper-param.js') ),
		true
	);
	wp_enqueue_script(
		'main',
		get_template_directory_uri() . '/js/main.js',
		array ('jquery'),
		filemtime( get_theme_file_path('/js/main.js') )
	);
	wp_enqueue_script(
		'jquery.fancybox',
		get_template_directory_uri() . '/js/jquery.fancybox.js',
		array ('jquery'),
		filemtime( get_theme_file_path('/js/jquery.fancybox.js') )
	);
	wp_enqueue_script(
		'fancybox-param',
		get_template_directory_uri() . '/js/fancybox-param.js',
		array ('jquery.fancybox'),
		filemtime( get_theme_file_path('/js/fancybox-param.js') ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'test_scripts' );
