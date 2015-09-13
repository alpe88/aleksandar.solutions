<?php get_header(); ?>
<!-- Header Ends Here -->

<!-- Content Begins Here -->
<!-- Main Content Section Begins Here -->
<section>
<?php $abt_args = array('pagename' => 'about');$p = new WP_Query($abt_args);?>

<?php  $abt_imgs_args = array(
            'post_parent'    => $p->ID,
            'post_type'      => 'attachment',
            'numberposts'    => -1, // show all
            'post_status'    => 'any',
            'post_mime_type' => 'image',
            'orderby'        => 'menu_order',
            'order'           => 'ASC'
       );
$abt_img_arr = array();
$images = get_posts($abt_imgs_args);
if($images){foreach($images as $image){$abt_img_arr[] = wp_get_attachment_url($image->ID);}}
?>
	<div class="bgCover" style="background-image:url(<?php echo $abt_img_arr[9]; ?>);">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 text-center">
					<div class="row">
					<!-- Start of First Content Section -->
					<?php if ( $p->have_posts() ) : while ( $p->have_posts() ) : $p->the_post(); ?>
						<div class="col-xs-12">
							<a href="index.php/about">
								<h1>
									<?php echo get_post_meta(get_the_ID(),'Post Title', true); ?>
									<div class="margin-bottom-sm"></div>
								</h1>
							</a>
						</div>
						<div class="col-xs-12 col-sm-4"><a href="index.php/about#philosopher"><div class="ctrl-w rounded wow zoomIn" data-wow-duration="2s" data-wow-delay="0.2s">
						<i class="flaticon-astronomy6"></i></div><h4 class="text-md text-center playfair">Philosopher.</h4></a>
						</div>
						<div class="col-xs-12 col-sm-4"><a href="index.php/about#artist"><div class="ctrl-w rounded wow zoomIn" data-wow-duration="2s" data-wow-delay="0.4s">
						<i class="flaticon-theatre2"></i></div><h4 class="text-md text-center playfair">Artist.</h4></a>
						</div>
						<div class="col-xs-12 col-sm-4"><a href="index.php/about#developer"><div class="ctrl-w rounded wow zoomIn" data-wow-duration="2s" data-wow-delay="0.6s">
						<i class="flaticon-computerscreen47"></i></div><h4 class="text-md text-center playfair">Developer.</h4></a>
						</div>
						<div class="col-xs-12">
							<?php if(has_post_thumbnail()){the_post_thumbnail(array(400,400),array('class' => "img-responsive center-block wow zoomIn"));}?>
						</div>
						<div class="col-xs-12"><a href="index.php/portfolio"><h3 class="btn btn-xs btn-primary outline">VIEW PORTFOLIO</h3></a><div class="margin-bottom-sm"></div></div>
					<?php endwhile; else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>
					<?php wp_reset_postdata();?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section></section>
<!-- Main Content Section Ends Here -->
<!-- Content Ends Here -->
<!-- Footer Begins Here -->
<?php get_footer(); ?>