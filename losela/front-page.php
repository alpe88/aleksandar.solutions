<?php get_header(); ?>
<!-- Header Ends Here -->

<!-- Content Begins Here -->

<div class="container">
	<div class="row">
		<?php
			$abt_args = array('pagename' => 'about');
			$p = new WP_Query($abt_args);
		?>
		<div class="col-xs-12">
		<?php if ( $p->have_posts() ) : while ( $p->have_posts() ) : $p->the_post(); ?>
			<?php echo showMeta('Post Title'); ?>
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