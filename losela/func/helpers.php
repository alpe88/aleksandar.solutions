<?php


#custom tag cloud tool tip function
function custom_tooltip_callback($count){
    return sprintf( 
        _n('%s Topic.', '%s Topics.', $count),
        number_format_i18n($count)
    );
}

#get meta information - the convenient way (:
function showMeta($arg){
	return get_post_meta(get_the_ID(),$arg, true);
}

