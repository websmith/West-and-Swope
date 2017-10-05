<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Overwrite or add your own custom functions to X in this file.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Parent Stylesheet
//   02. Additional Functions
// =============================================================================

// Enqueue Parent Stylesheet
// =============================================================================

add_filter( 'x_enqueue_parent_stylesheet', '__return_true' );


// Additional Functions
// =============================================================================

add_action('wp_enqueue_scripts', 'lightbox_styles', 11);

function lightbox_styles() {
	wp_register_style('lightbox-styles', get_stylesheet_directory_uri().'/framework/css/lightbox.min.css', array(), null, 'screen');
	wp_enqueue_style('lightbox-styles');
}

add_action('wp_enqueue_scripts', 'lightbox_scripts', 11);

function lightbox_scripts() {
	wp_register_script('lightbox-scripts', get_stylesheet_directory_uri().'/framework/js/lightbox.min.js', array('jquery'), null, true);
	wp_enqueue_script('lightbox-scripts');
}

add_action( 'init', 'properties_custom_posts' );

function properties_custom_posts() {
	$args = array(
		'public' => true,
		'label'  => 'Properties',
		'singular_name' => 'Property',
		'add_new_item' => 'Add New Property',
		'edit_item' => 'Edit Property',
		'new_item' => 'New Property',
		'view_item' => 'View Property',
		'search_items' => 'Search Properties',
		'not_found' => 'Property Not Found',
		'not_found_in_trash' => 'Property Not Found in Trash',
		'all_items' => 'All Properties',
		'archives' => 'Archived Properties',
		'insert_into_item' => 'Insert Into Property',
		'uploaded_to_this_item' => 'Uploaded to Property',
		'featured_image' => 'Main Property Image',
		'set_featured_image' => 'Set Main Property Image',
		'remove_featured_image' => 'Remove Main Property Image',
		'use_featured_image' => 'Set as Main Property Image',
		'menu_position' => 5,
		'menu_icon' => 'dashicons-admin-multisite',
		'taxonomies'  => array('category'),
		'supports' => array('title', 'thumbnail'),
	);
	register_post_type('properties', $args);
}

add_action( 'init', 'testimonials_custom_posts' );

function testimonials_custom_posts() {
	$args = array(
		'public' => true,
		'label'  => 'Testimonials',
		'singular_name' => 'Testimonial',
		'add_new_item' => 'Add New Testimonial',
		'edit_item' => 'Edit Testmonial',
		'new_item' => 'New Testmonial',
		'view_item' => 'View Testmonial',
		'search_items' => 'Search Testimonials',
		'not_found' => 'Testimonial Not Found',
		'not_found_in_trash' => 'Testimonial Not Found in Trash',
		'all_items' => 'All Testimonials',
		'archives' => 'Archived Testimonials',
		'insert_into_item' => 'Insert Into Testimonial',
		'uploaded_to_this_item' => 'Uploaded to Testimonial',
		'menu_position' => 6,
		'menu_icon' => 'dashicons-format-quote',
		'supports' => array('title'),
	);
	register_post_type('testimonials', $args);
}


// Deregister Portfolio CPT
// =============================================================================
add_action('after_setup_theme','remove_portfolio_cpt', 100);

function remove_portfolio_cpt() {   
	remove_action('init', 'x_portfolio_init');    
}
