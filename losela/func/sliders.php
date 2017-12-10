<?php


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

/*
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
add_action('wp_footer', 'highlightsJs');*/
