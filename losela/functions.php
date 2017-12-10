<?php

/*
Theme Name: Aleksandar Petrovic's WordPress Theme for aleksandar.solutions
Author: Aleksandar Petrovic
Author URI:
Text Domain: Aleksandar.Solutions
Description: This is a theme I developed for aleksandar.solutions 
Version: 1.0
*/

/* INCLUDES */
#custom walker include
require_once('func/resource_loaders.php');
require_once('func/BS_Walker.php');
require_once('func/config.php');
require_once('func/menus.php');
require_once('func/sliders.php');
require_once('func/pagination.php');
require_once('func/login.php');
require_once('func/seo.php');
require_once('func/filters.php');
require_once('func/helpers.php');

/*
(function($) {
	
	// $ Works! You can test it with next line if you like
	// console.log($);
	
})( jQuery );
*/

/*DON'T LOOK DOWN!*/
#BROWSER DETECTION
function mobileDetection(){
	$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );	
	if($isMobile){
		return true;
	}
}
?>