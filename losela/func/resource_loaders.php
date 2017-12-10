<?php

/* Load Custom jQuery*/
function load_google_cdn_jquery() {
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'shapeSpace_include_custom_jquery');

function style_loader(){
	wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_style', 'style_loader' );

function script_loader() {
    /*wp_enqueue_script( 'reference_name', get_template_directory_uri() . '/js/my-great-script.js', array( 'dependencies' ), 'version', true_or_false_for_location );*/
}
add_action( 'wp_enqueue_scripts', 'script_loader' );