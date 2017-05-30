<footer>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div id="main-menu" class="navbar-collapse collapse navbar-main uppercase">
						<ul class="nav navbar-nav">
							<?php wp_nav_menu(
									array( 
											'theme_location' => 'social_menu',
											'menu'           => 'Social Menu',
											'depth'          => '2',
											'container'      => '', 
											'container_id'   => '',
											'container_class'=> '',
											'menu_id'        => '',
											'menu_class'     => '',
											'items_wrap'     => '%3$s',
											'fallback_cb'	 => '',
											'walker'         => new DD_Walker(),
											));
								?>
						</ul>
					</div>
				</div>
			</div>
		</div>

	<div class="text-sm text-center">
		<a href="http://aleksandar.solutions" target="_blank" class="site_author btn-xs">an aleksandar petrovic site&nbsp &copy; <?php
			#$copyYear = 1988; // Set your website start date
			$curYear = date('Y'); // Keeps the second year updated
			#echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
			echo $curYear;?></a>
	</div>
</footer>
	<!-- Begin Scripts -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
   	<script src="<?php bloginfo('template_directory');?>/js/bootstrap.min.js"></script>
	<!-- Smooth Scrolling -->
	<script src="<?php bloginfo('template_directory');?>/js/navbar-scroll.js"></script>
	<script src="<?php bloginfo('template_directory');?>/js/smooth-scroll.js"></script>							

  	<script type="text/javascript">
		$(document).ready(function() {

		});	
	</script>
<?php wp_footer(); ?>
<!-- Footer Ends Here -->
</body>
<!-- Body Ends Here -->
</html>
<!-- Document Ends Here -->