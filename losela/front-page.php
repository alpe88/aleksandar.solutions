<?php get_header(); ?>
<!-- Header Ends Here -->

<!-- Content Begins Here -->

<div class="container-fluid">
	<div class="row">
		<section>
			<!-- Latest Blog -->
			<?php
				#get latest post
				$latest_post_arg = array(
					'post_type'		=> array( 'post' ),
					'post_status'	=> 'publish',
					'order'			=> 'DESC',
					'orderby'		=> 'date',
					'posts_per_page'=> '1',
				);
				$latest_post = new WP_Query( $latest_post_arg );
			?>
			<?php if ( $latest_post->have_posts() ) : while ( $latest_post->have_posts() ) : $latest_post->the_post(); ?>
			<?php if(has_post_thumbnail()){
				$thumb_id = get_post_thumbnail_id();
				$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
				$thumb_url = $thumb_url_array[0];
			}
			?>
			<div class="col-xs-12">
				<div class="row" style="height:90vh;background:url('<?php echo $thumb_url;?>') no-repeat center;">
					<div class="col-xs-6">
						<article class="blog blog-post-number-<?php the_ID(); ?> ">
							<div class="blog-overlay">
								<div class="row">
									<div class="col-xs-12">
										<div class="blog-title">
										<?php the_title('<h1>','</h1>'); ?>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="blog-excerpt">
											<?php the_excerpt(); ?>
										</div>
										<div class="blog-read-more-link">
											<a class="more-link" href="<?php the_permalink($latest_post->ID); ?>">Read More<span class="dashicons dashicons-arrow-right-alt2"></span></a>
										</div>
									</div>
								</div>
							</div>
								
								
							<?php endwhile; else : ?>
								<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
							<?php endif; ?>
							<?php wp_reset_postdata();?>
						</article>
					</div>
				</div>
			</div>
		</section>	
	</div>
</div>

<div class="container">
	<div class="row">	
		<!-- Highlighted Works or Projects -->
		<div class="col-xs-12">
		<?php
			$highlighted_work_args = array(
						'post_type' => array( 'project', 'work' ),
						'post_status'	=> array( 'published' ),
						'meta_query' => array(
							array(
								'key' => 'portfolio-highlight',
								'value' => 'yes',
								'compare' => 'LIKE'
						)),
						'order'			=> 'DESC',
						'orderby'		=> 'date',
						'posts_per_page'=> '6',
			);
			$highlighted_work_posts = new WP_Query($highlighted_work_args);
		?>
			<?php if ( $highlighted_work_posts->have_posts() ) : $post_counter = 0; while ( $highlighted_work_posts->have_posts() ) : $highlighted_work_posts->the_post(); ?>
				<?php $post_counter++; ?>
				<?php 
					if(has_post_thumbnail()){
						the_post_thumbnail('',array('class' => "img-responsive"));
					}
				?>
				<?php the_title('<h2>','</h2>'); ?>
			<?php endwhile; else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php endif; ?>
			<?php wp_reset_postdata();?>
		</div>
	</div>
</div>

<!-- Content Ends Here -->
<!-- Footer Begins Here -->
<?php get_footer(); ?>