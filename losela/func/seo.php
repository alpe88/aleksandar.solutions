<?php


#SEO Titling:
function SEO_title($location){
	global $post;

	if (!isset($location)){
		$location = 'Seattle, WA';
	}
	
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
	echo $location;
}

#SEO Keywords
function get_keywords(){
	global $post;
	$posttags = get_the_tags($post->ID);
	$category = get_the_category($post->ID);
	$keyword_list = $category[0]->cat_name;
	if ($posttags) {
  		foreach($posttags as $tag) {
    			$comma = ', ';
				$keyword_list .= $comma;
				$keyword_list .= $tag->name;
  		}
	}
	echo $keyword_list;
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

