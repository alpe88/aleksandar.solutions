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
require_once('DD_Walker.php');

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
    $class = str_replace("class='avatar", "class='avatar pic-2 img-thumbnail img-responsive", $class);
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

#custom flexslider ala mike sinkula - with an aLeksandar.Solutions added!
function add_flexslider($cp_id) { 
	$args = array(
		'post_type' => 'attachment', 'post_parent' => $cp_id 
	);
    $attchs = get_children($args);
    if ($attchs) {        
        echo '<div class="flexslider">';
        echo '<ul class="slides">';
    
        foreach ($attchs as $attachment_id => $attachment) {            
			echo '<li class="img-responsive">';
            echo wp_get_attachment_image($attachment_id, 'large');
            echo '<p class="flex-caption">';
            echo get_post_field('post_content', $attachment->ID);
            echo '</p>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
}
add_shortcode( 'flexslider', 'add_flexslider' );

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
			echo 'Tutorials,Web,Development,Design';
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
$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );					
#BREADCRUMBS
function add_breadcrumbs() {
    #https://www.thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
    // Settings
    $separator          = '';
    $breadcrums_id      = 'breadcrumb';
    $breadcrums_class   = 'breadcrumb';
    $home_title         = 'Home';
     
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = '';
      
    // Get the query & post information
    global $post,$wp_query;
      
    // Do not display on the homepage
    if ( !is_front_page() ) {
      
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
          
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        /*echo '<li class="separator separator-home"> ' . $separator . ' </li>';*/
          
        if ( is_archive() && !is_tax() && !is_category() ) {
             
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
             
        } else if ( is_archive() && is_tax() && !is_category() ) {
             
            // If post is a custom post type
            $post_type = get_post_type();
             
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                 
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
             
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                /*echo '<li class="separator"> ' . $separator . ' </li>';*/
             
            }
             
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
             
        } else if ( is_single() ) {
             
            // If post is a custom post type
            $post_type = get_post_type();
             
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                 
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
             
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                /*echo '<li class="separator"> ' . $separator . ' </li>';*/
             
            }
             
            // Get post category info
            $category = get_the_category();
             
            // Get last category post is in
            $last_category = end(array_values($category));
             
            // Get parent any categories and create array
            $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
            $cat_parents = explode(',',$get_cat_parents);
             
            // Loop through parent categories and store in variable $cat_display
            $cat_display = '';
            foreach($cat_parents as $parents) {
                $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                /*$cat_display .= '<li class="separator"> ' . $separator . ' </li>';*/
            }
             
            // If it's a custom post type within a custom taxonomy
            if(empty($last_category) && !empty($custom_taxonomy)) {
                  
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
              
            }
             
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                 
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                 
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                /*echo '<li class="separator"> ' . $separator . ' </li>';*/
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
             
            }
             
        } else if ( is_category() ) {
              
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
              
        } else if ( is_page() ) {
              
            // Standard page
            if( $post->post_parent ){
                  
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                  
                // Get parents in the right order
                $anc = array_reverse($anc);
                  
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    /*$parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';*/
                }
                  
                // Display parent pages
                echo $parents;
                  
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                  
            } else {
                  
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_tag() ) {
              
            // Tag page
              
            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args ='include=' . $term_id;
            $terms = get_terms( $taxonomy, $args );
              
            // Display the tag name
            echo '<li class="item-current item-tag-' . $terms->term_id . ' item-tag-' . $terms[0]->slug . '"><strong class="bread-current bread-tag-' . $terms->term_id . ' bread-tag-' . $terms[0]->slug . '">' . $terms[0]->name . '</strong></li>';
          
        } elseif ( is_day() ) {
              
            // Day archive
              
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            /*echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';*/
              
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            /*echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';*/
              
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
              
        } else if ( is_month() ) {
              
            // Month Archive
              
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            /*echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';*/
              
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
              
        } else if ( is_year() ) {
              
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
              
        } else if ( is_author() ) {
              
            // Auhor archive
              
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
              
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
          
        } else if ( get_query_var('paged') ) {
              
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
              
        } else if ( is_search() ) {
          
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
          
        } elseif ( is_404() ) {
              
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
      
        echo '</ul>';  
    }    
}
?>