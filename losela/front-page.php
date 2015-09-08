<?php get_header(); ?>
<!-- Header Ends Here -->

<!-- Content Begins Here -->
<!-- Main Content Section Begins Here -->
<section><!-- Start of First Section -->
	<?php	$abt_args = array('pagename' => 'about');
			$p = new WP_Query($abt_args);
		?>
	<div class="container-fluid nopadding">
		<div class="row-fluid"><div class="margin-bottom-xxl"></div>
			<div id="1" class="col-xs-12 nopadding b-tb well">
				<div class="row-fluid"><!-- Start of First Content Section -->
					<?php if ( $p->have_posts() ) : while ( $p->have_posts() ) : $p->the_post(); ?>
					<div class="col-sm-8 vcenter nopadding">
						<div class="row-fluid">
							<div class="col-xs-12 text-center">
								<div class="row">
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
									<div class="col-xs-12 col-sm-4"><a href="index.php/about#artist"><div class="ctrl-w rounded wow zoomIn" data-wow-duration="2s" data-wow-delay="0.2s">
									<i class="flaticon-theatre2"></i></div><h4 class="text-md text-center playfair">Artist.</h4></a>
									</div>
									<div class="col-xs-12 col-sm-4"><a href="index.php/about#developer"><div class="ctrl-w rounded wow zoomIn" data-wow-duration="2s" data-wow-delay="0.2s">
									<i class="flaticon-computerscreen47"></i></div><h4 class="text-md text-center playfair">Developer.</h4></a>
									</div>
									<div class="col-xs-12"><a href="index.php/portfolio"><h3 class="btn btn-xs btn-primary outline">VIEW PORTFOLIO</h3></a><div class="margin-bottom-sm"></div></div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-4 vcenter nopadding">
						<?php if(has_post_thumbnail()){the_post_thumbnail('',
							array('class' => "img-responsive center-block rounded-corners-left-half wow zoomIn"));}
								
							?>
					</div>
					<?php endwhile; else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>
					<?php wp_reset_postdata();?>
				</div><!-- End of First Content Section -->
			</div>
				<div class="col-xs-12 text-center"><div class="margin-bottom-sm"></div>
					<a href="#2" class=""><div class="wow bounceInDown" data-wow-duration="3s" data-wow-delay="0.2s">
					<i class="icon-circle-down" style="font-size:48px;"></i></div>
					</a>
				</div>
		</div>
	</div>
</section><!-- End of First Section -->

<section><!-- Start of Second Section -->
	<?php $cp_args = array(
			'meta_query'	=>	array(
			array(
			'key' => 'Current Project',
			'value' => 'Yes'
			)
				),
			'post_type'		=> array('post', 'page')
			);
			$cp = new WP_Query($cp_args); 
		?>
	<div class="container nopadding">
		<div class="row">
			<div id="2" class="col-xs-12 nopadding"><div class="margin-bottom-xxl"></div>
				<div class="row"><!-- Start of Second.a Content Section -->
					<div class="col-xs-12 text-center">
						<h3>~Current Projects~</h3>
					</div>
					<div class="row">
					<?php if ( $cp->have_posts() ) : while ( $cp->have_posts() ) : $cp->the_post(); ?>
						<div class="col-xs-12 col-sm-4 p-t p-b text-center">
							<a class="hhs" href="<?php the_permalink();?>">
								<figure>
									<?php if(has_post_thumbnail()){the_post_thumbnail('',
										array('class' => "hhs-img img-responsive center-block wow zoomIn"));}
									?>
										<figcaption>
											<div class="btn btn-xs btn-primary outline"><?php the_title('<span>','</span>');?><span><?php the_excerpt(); ?></span>Learn More&nbsp;<i class="icon-circle-right"></i></div>
										</figcaption>
								</figure>
							</a>
						</div>
					<?php endwhile; else : ?>
						<p><?php _e( 'Currently I am not working on any projects...' ); ?></p>
					<?php endif; ?>
					</div>
					<?php wp_reset_postdata();?>
				</div><!-- End of Second Content.a Section -->
				
				<div class="row"><!-- Start of Second.b Content Section -->
					<div class="col-xs-12 text-center">
						<h3>~Must Read Tutorials~</h3>
					</div>
					<div class="row">
					<?php 	$tut_args = array( 'meta_query'	=>	array(array('key' => 'Tutorial Series First',)),'post_type'		=> array('post', 'page'));
							$tut = new WP_Query($tut_args); ?>
						<?php if ( $tut->have_posts() ) : while ( $tut->have_posts() ) : $tut->the_post(); ?>
						<div class="col-xs-12 col-sm-4 p-t p-b text-center">
							<a class="hhs" href="<?php the_permalink();?>">
								<figure>
									<?php if(has_post_thumbnail()){the_post_thumbnail('',
										array('class' => "hhs-img img-responsive center-block wow zoomIn"));}
									?>
										<figcaption>
											<div class="btn btn-xs btn-primary outline"><?php the_title('<span>','</span>');?><span><?php the_excerpt(); ?></span>Learn More&nbsp;<i class="icon-circle-right"></i></div>
										</figcaption>
								</figure>
							</a>
						</div>
					<?php endwhile; else : ?>
						<p><?php _e( 'Seems like I have not written any tutorials yet...' ); ?></p>
					<?php endif; ?>
					</div>
					<?php wp_reset_postdata();?>
				</div><!-- End of Second Content.b Section -->
			</div>
		</div>
	</div>
</section><!-- End of Second Section -->
<!-- Main Content Section Ends Here -->
<!-- Content Ends Here -->
<!-- Footer Begins Here -->
<?php get_footer(); ?>