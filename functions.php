<?php
/**
 * Give-me-back-php Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package give-me-back-php
 */

add_action( 'wp_enqueue_scripts', 'give_me_back_php_parent_theme_enqueue_styles' );

/**
 * Enqueue scripts and styles.
 */
function give_me_back_php_parent_theme_enqueue_styles() {
	wp_enqueue_style( 'twentytwentyfive-style', get_template_directory_uri() . '/style.css', array(), '0.1.0' );
	wp_enqueue_style(
		'give-me-back-php-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'twentytwentyfive-style' ),
		'0.1.0'
	);
}


add_action( 'init', function () {
wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
} );
