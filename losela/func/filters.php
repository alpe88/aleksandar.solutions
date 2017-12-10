<?php

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

function change_excerpt_more( $more ) {
	return '<a class="more-link" href="' . get_permalink() . '"><p>Read More</p><span class="dashicons dashicons-arrow-right-alt2"></span></a>';
}
add_filter('excerpt_more', 'change_excerpt_more');

function modify_read_more_link() {
    return '<a class="more-link" href="' . get_permalink() . '"><span class="dashicons dashicons-arrow-right-alt2"></span></a>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );
