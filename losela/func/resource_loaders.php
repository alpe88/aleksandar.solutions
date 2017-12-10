<?php

/* Load Custom jQuery*/
function load_google_cdn_jquery() {
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), '3.1.1', true);
}

function style_loader(){
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_style('bootstrap_main', get_template_directory_uri() . '/bs/css/bootstrap.min.css');
	wp_enqueue_style('bootstrap_sharp', get_template_directory_uri() . '/bs/css/bs.sharp.css', array('bootstrap_main'), '1.0.0');
	wp_enqueue_style('bootstrap_fullheight', get_template_directory_uri() . '/bs/css/bs.fh.css', array('bootstrap_main'), '1.0.0');
}

function script_loader() {
    /*wp_enqueue_script( 'reference_name', get_template_directory_uri() . '/js/my-great-script.js', array( 'dependencies' ), 'version', true_or_false_for_location );*/
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bs/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
}

function load_resources(){
	load_google_cdn_jquery();
	style_loader();
	script_loader();
}
add_action( 'wp_enqueue_scripts', 'load_resources' );