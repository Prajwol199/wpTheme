<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rise_business
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<title>
	    <?php if(is_front_page()){
	        echo get_bloginfo('name');
	    } else{
	        echo wp_title('');
	    }?>
	</title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta property="og:title" content="Page Title" />
		<meta property="og:type" content="type (see facebook for types)" />
		<meta property="og:image" content="url of image for page" />
		<meta property="og:site_name" content="Overall site name" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,700|Poppins:400,500,600,700" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.12.2.min.js"></script>
	<?php wp_head(); ?>
</head>

<?php // echo do_shortcode('[add_fields]'); ?>

<body <?php body_class(); ?>>
<header class="rt-site-header">
	<section class="header-top position-relative rt-bg-light">
		<div class="container-fluid">
			<div class="row">
				<div class="col-6 rt-top-left">
					<ul class="rt-top-contact rt-top-list">
						<?php 
							$number = get_theme_mod('phone_block');
							$email = get_theme_mod('email_block');						
						?>
						<li><a href="tel:<?php esc_html_e($number) ?>"><i class="fas fa-phone-volume"></i><span id="phone_number"><?php rise_business_selective_phone_block(); ?></span></a></li>
						<li><a href="mailto:emailid"><i class="fas fa-envelope"></i><span id="email"><?php rise_business_selective_email_block(); ?></span></a></li>
					</ul>
				</div>
				<div class="col-6 position-relative z-index rt-top-right">
					<ul class="rt-top-contact rt-top-list">
						<?php 
							wp_nav_menu(array(
								'theme_location' => 'menu-1',
								)
							);
						?>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<section class="rt-nav-bar-section bg-white">
	<div class="container-fluid">
		<div class="row">
			<div class="col-4 site-logo">
				<div class="rt-logo">
					<h1><a href="#"><?php bloginfo('title')?></a></h1>						
				</div>
			</div>
			<div class="col-8 pl-0">
					<?php 
						wp_nav_menu(array(
							'theme_location' 	=> 'menu-2',
							'menu_class'		=> 'navigation clearfix',
							'container'			=> 'nav',
							'container_class'	=> 'rt-main-menu',
							// 'menu_class' => 'navigation clearfix',
							)
						);
					?>
			</div>				
		</div>
	</div><!-- container -->		
</section>
<!-- nav bar section end -->
</header><!-- header section -->

