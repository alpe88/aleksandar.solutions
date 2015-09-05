<?php get_header(); ?>
<!-- Header Ends Here -->
<div class="margin-bottom-xxl"></div>
<!-- Content Begins Here -->
<?php 	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							
							if(1 == $paged){
								$args = array(
								'post_type'              => 'post',
								'post_status'            => 'publish',
								'posts_per_page'         => '3',
								'order'                  => 'DESC',
								'orderby'                => 'date',
								'category__not_in'		 => '5',
								'paged' 		 => $paged
								);
							}else{
								$args = array(
								'post_type'              => 'post',
								'post_status'            => 'publish',
								'posts_per_page'         => '3',
								'order'                  => 'DESC',
								'orderby'                => 'date',
								'paged' 		 		 => $paged,
								'category__not_in'		 => '5',
								'post__not_in'		 => get_option('sticky_posts')
								);
							}

							$posts_query = new WP_Query($args);					
							?>
<!-- Main Content Section Begins Here -->
<div class="container">
		<div class="row">
			<div id="mainContent" class="col-xs-12">
				<?php if($posts_query->have_posts()): ?>
				<!-- the loop -->
				<?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
					<article id="post-content-<?php the_ID(); ?>" class="post-content">
						<div class="col-xs-12 center-block text-center">
							<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($posts_query->ID), 'post_thumbnail' );
								$url = $thumb['0'];?>
							<div class="col-xs-12 bgCover" style="background:url(<?php echo $url;?>)">
							<div class="margin-bottom-xxl"></div>
								<div class="col-xs-12 well">
									<div class="col-xs-12">
										<a class="post-title" href="<?php the_permalink(); ?>">
											<h1 class="">
												~<?php the_title(); ?>~
											</h1>
										</a>
									</div>
									<div class="col-xs-12">
										<div class="col-xs-12"><?php the_category('|', 'multiple');?></div>
										<!--<div class="col-xs-12"><?php the_tags('~', ' | ', '~');?></div>-->
										<div class="col-xs-12"><?php fetch_tags();?></div>
										<div class="col-xs-12"><?php the_time('F j, Y');?></div>													
									</div>
								
									<div class="col-xs-12"><div class="margin-bottom-xs"></div>
										<div class="b-t p"><?php the_excerpt(); ?></div>
										<div align="right">
											<a class="btn btn-small btn-primary outline" href="<?php the_permalink(); ?>">Read On&nbsp;<i class="icon-circle-right"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</article>
					<?php endwhile; ?>
					<!-- pagination here -->
					<div class="text-center col-xs-12">
						<?php alesol_pager($posts_query->max_num_pages);?>
					</div>
					<?php wp_reset_postdata(); ?>
					<?php else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>
			</div>
			<div class="<?php display_sidebar();?>">
				<?php get_sidebar();?>
			</div>
		</div>
</div> 
<!-- Main Content Section Ends Here -->
<!-- Content Ends Here -->

<!-- Footer Begins Here -->
<?php get_footer(); ?>