<!-- Document Begins Here -->
<!DOCTYPE html>
<html lang="en">
<!-- Header Begins Here -->
	<head>
	<title><?php SEO_title(); ?></title>
	<!-- Begin Favicon Information -->
	<link rel="shortcut icon" type="image/png" href="<?php bloginfo('template_directory');?>/icons/favicon.ico" >
	<!-- Begin Meta Information -->

	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	 <meta name="description" content="<?php echo strip_tags(get_the_excerpt()); ?>" /> 
	 <meta name="keywords" content="<?php get_keywords(); ?>" /> 
	 <meta name="robots" content="no index, no follow" /> 
	 <meta http-equiv="Cache-Control" content="no-cache" /> 
	 <meta http-equiv="Pragma" content="no-cache" /> 
	 <meta http-equiv="Expires" content="-1" /> 
	 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" /> 

	<!-- Begin Style Sheets -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/losela.min.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/bs.sharp.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/style.css" type="text/css">
	<!-- Animate -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/animate.css" type="text/css">
	<!-- Icons -->
	<!-- Google Font -->
	<link href='http://fonts.googleapis.com/css?family=Playfair+Display|Lobster' rel='stylesheet' type='text/css'>
	
	<!--[if lt IE 9]>
        	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
	<?php wp_head(); ?>
	</head>
	<!-- Header Ends Here -->
	<!-- Body Begins Here -->
	<body <?php body_class(''); ?> >		
	<?php if ( is_admin_bar_showing() ) echo ''; ?>
	<header>
		<nav id="nav_wrap" class="navbar navbar-default navbar-fixed-top navbar-transparent" role="navigation">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="navbar-header">
								<h1 id="logo" class="navbar-brand"><a href="<?php echo home_url(); ?>">aLeksandar.Solutions</a></h1>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div id="main-menu" class="navbar-collapse collapse navbar-main uppercase">
							<ul class="nav navbar-nav">
								<?php wp_nav_menu(
										array( 
											'theme_location' => 'main_menu',
											'menu'           => 'Main Menu',
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
		</nav>
	</header>