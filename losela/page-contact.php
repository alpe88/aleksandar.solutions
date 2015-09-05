<?php get_header(); ?>
<!-- Header Ends Here -->

<!-- Content Begins Here -->
<?php
	$cnt_args = array('pagename' => 'contact');
	$p = new WP_Query($cnt_args);
?>
<!-- Main Content Section Begins Here -->
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="row">
				<?php if ( $p->have_posts() ) : while ( $p->have_posts() ) : $p->the_post(); ?>
				<div class="col-xs-12 center-block text-center">
						<?php $thumb = get_attached_media('image', $p->ID());
							$url = $thumb['0'];?>
							<div class="col-xs-12 bgCover" style="background:url(<?php echo $url;?>)">
								<div class="margin-bottom-xl"></div>
									<div class="col-xs-12 well">
										<div class="row">
											<div class="col-xs-12">
												<div class="row">
													<div class="col-xs-12 col-sm-8 vcenter">
														<div class="row">
															<div class="col-xs-12">
																<a class="post-title" href="<?php the_permalink(); ?>">
																	<h1>
																		<?php echo get_post_meta(get_the_ID(),'Post Title', true); ?>
																	</h1>
																</a>
															</div>
														</div>
														<div class="row">
															<div class="col-xs-12">
																<?php the_content();?>
															</div>
														</div>
													</div>
													<div class="col-xs-12 col-sm-4 vcenter">
														<figure>
																<?php if(has_post_thumbnail()){the_post_thumbnail('',
																		array('class' => "img-responsive center-block"));}
																?>
																<figcaption></figcaption>
														</figure>
													</div>
												</div>
											</div>
										</div>
									</div>
							</div>
				<?php endwhile; else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>
				<?php wp_reset_postdata();?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Main Content Section Ends Here -->
<!-- Content Ends Here -->
<!-- Footer Begins Here -->
<?php get_footer(); ?>