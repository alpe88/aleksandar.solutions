<?php get_header(); ?>
<!-- Header Ends Here -->

<!-- Content Begins Here -->
<!-- Main Content Section Begins Here -->
<div class="container">
		<div class="row">
			<!-- Sidebar will be loaded here -->
				<?php get_sidebar();?>
			<div id="mainContent" class="<?php is_sidebar_displayed();?>">
				<?php	
							$sticky = get_option('sticky_posts');
							rsort($sticky);
							$sticky = array_slice($sticky, 0, 1);
							if($isMobile){
								if($sticky){ 
									$posts_on_page = 2;
								}else{ 
									$posts_on_page = 3;							
								} 

							}else{ 
								if($sticky){ 
									$posts_on_page = 1;
								}else{ 
									$posts_on_page = 3;							
								} 
							}
							
							$args = array(
								'post_type'              => 'post',
								'post_status'            => 'publish',
								'posts_per_page'         => $posts_on_page,
								'order'                  => 'DESC',
								'orderby'                => 'date',
								);

							
							$posts_array = new WP_Query($args);					
							?>
								<?php if($posts_array->have_posts()): ?>
									<!-- the loop -->
									<?php while ($posts_array->have_posts()) : $posts_array->the_post(); ?>
										<?php 
											if(is_sticky($posts_array->ID)){
												$post_col_sm = "col-sm-8";
											}else{
												$post_col_sm = "col-sm-4";
											}
											?>
											<article id="post-content-<?php the_ID(); ?>" class="post-content">
													<div class="<?php echo $post_col_sm; ?> col-xs-12 margin-bottom-sm nopadding">
														<a class="post-title" href="<?php the_permalink(); ?>">
															<?php if(has_post_thumbnail()){
																		the_post_thumbnail('',
																			array('class' => "img-thumbnail img-responsive block-center"));} ?>
																				<div class="">
																					<h3 class="text-center b-ud text-md">
																						<?php the_title(); ?>
																					</h3>
																				</div>
														</a>
														<div class="col-xs-12 nopadding">
															<div class="text-center margin-bottom-xs">
																<small>Posted on <?php the_date();?> by <?php the_author_posts_link(); ?></small>
															</div>														
														</div>
														<div class="col-xs-12 nopadding">
															<?php the_excerpt(); ?>
																<div align="right">
																	<a class="small read-more" href="<?php the_permalink(); ?>">Full Post</a>
																</div>
														</div>
													</div>
											</article>

									<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
								<?php else : ?>
									<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
								<?php endif; ?>
			</div>
		</div>
	</div> 
<!-- Main Content Section Ends Here -->
<!-- Content Ends Here -->

<!-- Footer Begins Here -->
<?php get_footer(); ?>