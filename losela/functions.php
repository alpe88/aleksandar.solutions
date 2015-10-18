<?php

/*
Theme Name: Aleksandar Petrovic's WordPress Theme for aleksandar.solutions
Author: Aleksandar Petrovic
Author URI:
Text Domain: Aleksandar.Solutions
Description: This is a theme I developed for aleksandar.solutions 
Version: 1.0
*/
#custom walker include
require_once('BS_Walker.php');
#custom breadcrumbs include
require_once('BS_Breadcrumbs.php');
#theme support additions
add_theme_support('post-thumbnails');
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
add_post_type_support( 'page', 'excerpt', 'post-formats' );

#add RSS feed links to <head> tag
add_theme_support( 'automatic-feed-links' );

#for security, hide wp version in web pages and feeds
function remove_version_info() {
     return '';
}
add_filter('the_generator', 'remove_version_info');

#set Media Library image link default to "none"
function wpb_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	
	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'wpb_imagelink_setup', 10);

#use shortcodes in widgets
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

#Register custom menus
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'main-menu' => 'Main Menu',
		  'utility-menu' => 'Utility Menu',
		  'social_menu' => 'Social Menu' 
		)
	);
}
#register sidebar
register_sidebar(array(
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));

#admin bar toggle
if( !is_super_admin() ) {
show_admin_bar(false);
}else{show_admin_bar(true);}


/*FILTERS*/
#Remove rel attribute from the category list
function remove_category_list_rel($output)
{
  $output = str_replace(' rel="category tag"', '', $output);
  return $output;
}
add_filter('wp_list_categories', 'remove_category_list_rel');
add_filter('the_category', 'remove_category_list_rel');

#filter for gravatar class addon
function add_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='avatar img-thumbnail img-responsive", $class);
    return $class;
}
add_filter('get_avatar','add_gravatar_class');

#filter that adds wp css classes to custom post types as appropriate
function add_page_css_class( $css_class, $page, $depth, $args ) {
  if ( empty($args['post_type']) || !is_singular($args['post_type']) )
    return $css_class;

  $_current_page = get_queried_object();

  if ( in_array( $page->ID, $_current_page->ancestors ) )
    $css_class[] = 'current_page_ancestor';
  if ( $page->ID == $_current_page->ID )
    $css_class[] = 'current_page_item';
  elseif ( $_current_page && $page->ID == $_current_page->post_parent )
    $css_class[] = 'current_page_parent';

  return $css_class;
}
add_filter( 'page_css_class', 'add_page_css_class', 10, 4 );

#filter that adds custom post types to pages.
function set_query_post_type($query) {
  if(is_home() && $query->is_main_query() || is_feed() || is_category() || is_tag()) {
    $post_type = get_query_var('post_type');
	if($post_type)
	    $post_type = $post_type;
	else
	    $post_type = array('post','nav_menu_item');
    $query->set('post_type',$post_type);
	return $query;
    }
}
add_filter('pre_get_posts', 'set_query_post_type');

#excerpt length definition
function custom_excerpt_length( $length ) {
	return 55;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function remove_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'remove_excerpt_more');


#custom tag cloud tool tip function
function custom_tooltip_callback($count){
    return sprintf( 
        _n('%s Topic.', '%s Topics.', $count),
        number_format_i18n($count)
    );
}

#custom flexslider by !Aleksandar aka @lordPetri
function add_highlights_slider() {
	$args = array(#get all posts/pages with this key/value pair
		'meta_query'	=>	array(
			array(
				'key' => 'Front Page Highlight'
			)
		),
		'post_type'		=> array('post', 'page')
	);
	$ofp = new WP_Query($args);
	$htmlstr = '';
	$htmlstr .= '<div class="flexslider">';
	$htmlstr .= '<ul class="slides">';
		if ( $ofp->have_posts() ) : while ( $ofp->have_posts() ) : $ofp->the_post();
			$htmlstr .=  '<li id="'.get_the_ID().'">';
			$url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', true);
			$htmlstr .=  '<img class="img-responsive center-block wow zoomIn" src="'.$url[0].'" alt="Image of '.get_the_title($ofp->ID).'" />';
			$htmlstr .=  '<a href="'.get_permalink($ofp->ID).'">';
			$htmlstr .=  '<span class="flex-caption">';
			$htmlstr .=  '<h3>'.get_the_title($ofp->ID).'</h3>';
			$htmlstr .=  '<p>'.get_the_excerpt($ofp->ID).'</p>';
			$htmlstr .=  '</span>';
			$htmlstr .=  '</a>';
			$htmlstr .=  '</li>';
		endwhile;
			$htmlstr .=  '</ul>';
			$htmlstr .=  '</div>';
	else :
		_e( 'Sorry, no posts matched your criteria.' );
	endif;
	return $htmlstr;
}

#another slider using native BS3
function alt_highlight_slider(){
	$highlights_number = 0;
	$args = array(#get all posts/pages with this key/value pair
		'meta_query'	=>	array(
			array(
				'key' => 'Front Page Highlight'
			)
		),
		'post_type'		=> array('post', 'page')
	);
	$ofp = new WP_Query($args);
	$htmlstr = '';
	if($ofp->have_posts()){
		$htmlstr .= '<div id="highlights" class="carousel slide">';
			$htmlstr .= '<ol class="carousel-indicators">';		
				while($ofp->have_posts()):$ofp->the_post();
				$htmlstr .= '<li data-target="#highlights" data-slide-to='.$highlights_number++.'></li>';
				endwhile;
			$htmlstr .= '</ol>';
			
			$htmlstr .= '<div class="carousel-inner">';
				while($ofp->have_posts()):$ofp->the_post();
					$htmlstr .= '<div class="item">';
						$url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', true);
						$htmlstr .= '<div class="fill" style="background-image:url('.$url[0].')"></div>';
							$htmlstr .=	'<div class="carousel-caption">';
								$htmlstr .= '<h3>'.get_the_title($ofp->ID).'</h3>';
								$htmlstr .= '<p>'.get_the_excerpt($ofp->ID).'</p>';
							$htmlstr .= '</div>';
					$htmlstr .= '</div>';
				endwhile;
			$htmlstr .= '</div>';
			$htmlstr .= '<a class="carousel-control left" href="#highlights" data-slide="prev">';
				$htmlstr .= '<span class="icon-prev"></span>';
			$htmlstr .=	'</a>';
			$htmlstr .= '<a class="carousel-control right" href="#highlights" data-slide="next">';
				$htmlstr .= '<span class="icon-next"></span>';
			$htmlstr .= '</a>';
		$htmlstr .= '</div>';
	}
	else{
		$htmlstr = 'Sorry, no posts matched your criteria.';
	}
	return $htmlstr;
}

#script for carousel
function highlightsJs() { ?>

<script>
jQuery(document).ready(function($){
  $("#highlights .carousel-indicators li:first").addClass("active");
  $("#highlights .carousel-inner .item:first").addClass("active");
   $("#highlights").carousel({
  interval: 4000
  })
});
</script>
<?php
}
add_action('wp_footer', 'highlightsJs');

#get meta information - the convenient way (:
function showMeta($arg){
	return get_post_meta(get_the_ID(),$arg, true);
}
/*LOGIN STUFFS
function redirect_login_page() {
    $login_page  = home_url( '/login/' );
    $page_viewed = basename($_SERVER['REQUEST_URI']);
 
    if( ($page_viewed == "wp-login.php" || $page_viewed == "admin") && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }
}
add_action('init','redirect_login_page');

function admin_bar_logout_redirect(){
  wp_redirect(home_url());
  exit();
}
add_action('wp_logout','admin_bar_logout_redirect');
#END LOGIN*/

#SEO Titling:
function SEO_title(){
	global $post;

	if(is_front_page()){
		echo bloginfo('description');
	}
	elseif(is_page() || is_single()){
		echo the_title();
	}
	elseif(is_author()){
		if ($author_id = get_query_var('author')){$author = get_user_by( 'id',$author_id);}
		echo $author->first_name . ' ' . $author->last_name;
	}
	else{
		echo bloginfo('description');
	}

	if($post->post_parent){
		echo ' | ';
		echo get_the_title($post->post_parent);
	}
	
	echo ' | ';
	echo bloginfo('name');
	echo ' | ';
	echo 'Seattle, WA';
}

#SEO Keywords
function get_keywords(){
	global $post;
	$posttags = get_the_tags($post->ID);
	if ($posttags) {
  		foreach($posttags as $tag) {
    			echo $tag->name . ','; 
  		}
	}else{
			echo 'Tutorials, Web, Development, Design, ';
		}
	
	$category = get_the_category($post->ID);
	echo $category[0]->cat_name . ',';
	echo bloginfo('name') . ',';
	echo the_title();
}

#display tags desc
function fetch_tags(){
	global $post;
	$a = array();
	$tags = wp_get_post_tags($post->ID, array('orderby' => 'name', 'order' => 'DESC'));
	foreach($tags as $tag){
		echo '<a class="p-small" href="' . get_tag_link( $tag->ID ) . '">' . esc_html( $tag->name ) . '</a>';
	}
}

#custom function for sidebar display
function display_sidebar(){
$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );
	if(is_front_page() && is_home()){#Default homepage - sidebar displayed
		echo "hidden-xs hidden-sm hidden-md hidden-lg";
	}elseif (is_front_page()) {#static homepage - sidebar displayed (probably not needed, but better to be complete)
		echo "hidden-xs hidden-sm hidden-md hidden-lg";
	}elseif (is_home()) {#blog page - sidebar displayed
		echo "col-xs-12 col-sm-4";
	}else{#everything else
		if(is_page('Blog')){echo "hidden-xs hidden-sm hidden-md hidden-lg";}
		else{echo "hidden-xs hidden-sm hidden-md hidden-lg";}
	}
}

#PAGINATION
function alesol_pager($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
        echo '<div class="text-center">'; 
        echo '<nav><ul class="pagination">';#if looking to have a page/page add <li class="disabled hidden-xs"><span><span aria-hidden="true">Page '.$paged.' of '.$pages.'</span></span></li>
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."' aria-label='First'>&laquo;<span class='hidden-xs'> First</span></a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."' aria-label='Previous'>&lsaquo;<span class='hidden-xs'> Previous Page</span></a></li>";
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                 echo ($paged == $i)? "<li class=\"active\"><span>".$i." <span class=\"sr-only\">(current)</span></span>
    		 </li>":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
             }
         }
         if ($paged < $pages && $showitems < $pages) echo "<li><a href=\"".get_pagenum_link($paged + 1)."\"  aria-label='Next'><span class='hidden-xs'> Next Page</span>&rsaquo;</a></li>";  
         #if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."' aria-label='Last'><span class='hidden-xs'>Last </span>&raquo;</a></li>";
         echo "</ul></nav>";
         echo "</div>";
     }
 
}
#END PAGINATION


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