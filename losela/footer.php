<div class="margin-bottom-sm border-bottom"></div>
<footer>

<div class="container">
	<div class="row">
		<section>
			<div class="col-xs-12">
				<div id="social-menu" class="social">
					<ul class="list-inline nomargin text-center">
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
							'walker'         => new BS_Walker(),
							));
						?>
						<li>
						<a href="http://aleksandar.solutions" target="_blank" class="site_author btn-xs">an aleksandar petrovic site&nbsp &copy; <?php
							#$copyYear = 1988; // Set your website start date
							$curYear = date('Y'); // Keeps the second year updated
							#echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
							echo $curYear;?>
						</a>
					</li>
					</ul>
				</div>
			</div>
		</section>
	</div>
</div>
</footer>
					
<?php wp_footer(); ?>
<!-- Footer Ends Here -->
</body>
<!-- Body Ends Here -->
</html>
<!-- Document Ends Here -->