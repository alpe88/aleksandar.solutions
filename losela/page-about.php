<?php get_header(); ?>
<!-- Header Ends Here -->

<!-- Content Begins Here -->
<?php
	$abt_args = array('pagename' => 'about');
	$p = new WP_Query($abt_args);
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
							<div class="row">
								<div class="col-xs-12 bgCover" style="background:url(<?php echo $url;?>)">
									<div class="margin-bottom-xl"></div>
									<div class="row">
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
															<div class="row">
																<div class="col-xs-12"><hr/>
																	<h3>~Current Projects~</h3>
																</div>
															</div>
															<div class="row">
																<?php $cp_args = array(#get all posts/pages with this key/value pair
																	'meta_query'	=>	array(
																		array(
																			'key' => 'Current Project',
																			'value' => 'Yes'
																		)
																	),
																	'post_type'		=> array('post', 'page')
																);
																$cp = new WP_Query($cp_args); ?>
																<?php if ( $cp->have_posts() ) : while ( $cp->have_posts() ) : $cp->the_post(); ?>
																	<div class="col-xs-12 col-sm-4 p-t p-b">
																		<a class="hhs" href="<?php the_permalink();?>">
																			<figure>
																				<?php if(has_post_thumbnail()){the_post_thumbnail('',
																					array('class' => "hhs-img img-responsive center-block wow zoomIn"));}
																				?>
																				<figcaption>
																					<div class="btn btn-xs btn-primary outline"><?php the_title('<span>','</span>');?>&nbsp;<i class="icon-circle-right"></i><span><?php the_excerpt(); ?></span></div>
																				</figcaption>
																			</figure>
																		</a>
																	</div>
																	<?php endwhile; else : ?>
																		<p><?php _e( 'Looks like I am currently free.' ); ?></p>
																	<?php endif; ?>
																	<?php wp_reset_postdata();?>
															</div>
															<div class="row">
																<div class="col-xs-12"><hr/>
																	<h3>~From the Blog~</h3>
																</div>
															</div>
															<div class="row">
																	<?php 	$rp_args = array( 'orderby' => 'rand', 'showposts' => '3'
																		);
																	$rp = new WP_Query($rp_args); ?>
																	<?php if ( $rp->have_posts() ) : while ( $rp->have_posts() ) : $rp->the_post(); ?>
																		<div class="col-xs-12 col-sm-4 p-t p-b">
																			<a class="hhs" href="<?php the_permalink();?>">
																				<figure>
																					<?php if(has_post_thumbnail()){the_post_thumbnail('',
																							array('class' => "hhs-img img-responsive center-block wow zoomIn"));} ?>
																					<figcaption>
																						<div class="btn btn-xs btn-primary outline"><?php the_title('<span>','</span>');?>&nbsp;<i class="icon-circle-right"></i><span><?php the_excerpt(); ?></span></div>
																					</figcaption>
																				</figure>
																			</a>
																		</div>
																	<?php endwhile; else : ?>
																		<p><?php _e( 'Seems as though I have not written anything yet...' ); ?></p>
																	<?php endif; ?>
																	<?php wp_reset_postdata();?>
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