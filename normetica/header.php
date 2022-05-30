<?php
/**
 * The header for our theme.
 *
 * @package woostify
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<?php wp_head(); ?>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
		<link rel="stylesheet" href="global.css">
	</head>

	<body <?php body_class(); ?>>
		<?php
		wp_body_open();

		do_action( 'woostify_theme_header' );
