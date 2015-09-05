<?php get_header(); ?>
<!-- Header Ends Here -->

<!-- Content Begins Here -->
<!-- Main Content Section Begins Here -->
<div class="margin-bottom-xxl"></div>
<div class="container">
		<div class="row">
			<div id="mainContent" class="<?php is_sidebar_displayed();?>">
								<?php if(have_posts()): ?>
									<!-- the loop -->
									<?php while (have_posts()) : the_post(); ?>
											<article id="post-content-<?php the_ID(); ?>" class="post-content">
													<div class="col-xs-12 margin-bottom-sm nopadding">
													<?php the_title();?>
													<?php the_content();?>
													</div>	
											</article>

									<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
								<?php else : ?>
									<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
								<?php endif; ?>
			</div>
			<!-- Sidebar will be loaded here -->
			<?php get_sidebar();?>
		</div>
	</div> 
<!-- Main Content Section Ends Here -->
<!-- Content Ends Here -->

<!-- Footer Begins Here -->
<?php get_footer(); ?>