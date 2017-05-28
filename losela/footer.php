<footer>
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
	<!-- Material Design
   	<script src="<?php bloginfo('template_directory');?>/md/js/ripples.min.js"></script>
	<script src="<?php bloginfo('template_directory');?>/md/js/material.min.js"></script>-->
	<!-- Animation -->
	<script src="<?php bloginfo('template_directory');?>/js/wow.min.js"></script>
	<!-- Smooth Scrolling -->
	<script src="<?php bloginfo('template_directory');?>/js/navbar-scroll.js"></script>
	<script src="<?php bloginfo('template_directory');?>/js/smooth-scroll.js"></script>							
	<!-- Twitter Fetcher
	<script src="<?php bloginfo('template_directory');?>/tw/tf.min.js"></script> -->
	<!-- Flexslider 
	<script src="<?php bloginfo('template_directory');?>/flexslider/jquery.flexslider-min.js"></script> -->
  	<script type="text/javascript">
		$(document).ready(function() {
			new WOW().init();
			/*$('.flexslider').flexslider({
				animation: "slide",
				controlNav: false,
				directionNav: false
			});
			*/
		});	
	</script>
<?php wp_footer(); ?>
<!-- Footer Ends Here -->
</body>
<!-- Body Ends Here -->
</html>
<!-- Document Ends Here -->