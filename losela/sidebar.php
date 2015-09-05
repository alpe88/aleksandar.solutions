<!-- SideBar Begins Here -->
	<?php if(is_front_page() && is_home()){ #Default homepage ?>
				
	<?php }elseif(is_front_page()){ #static homepage ?>

	<?php	}elseif(is_home()){ #blog page ?>
		</div>
	<?php }else{ #everything else ?>
		<?php if(is_page()){ ?>
			<div id="tw-widget" class="hidden-xs"></div>
			<?php	}?>
	<?php } ?>
<!-- SideBar Ends Here -->