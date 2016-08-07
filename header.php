<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<title><?php esc_textarea(bloginfo('name')); ?></title>
	<?php print_indented('wp_head'); ?>
	<link rel="shortlink" href="<?php echo wp_get_shortlink(); ?>">
	<!-- META <?php echo get_meta(); ?> -->
	<meta name="msapplication-config" content="<?php the_url('/images/favicon/browserconfig.xml'); ?>">
	<meta name="theme-color" content="#00a0f1">
	<link rel="apple-touch-icon" href="<?php the_url('/images/favicon/apple-touch-icon.png'); ?>" sizes="180x180">
	<link rel="icon" type="image/png" href="<?php the_url('/images/favicon/favicon-32x32.png'); ?>" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php the_url('/images/favicon/favicon-16x16.png'); ?>" sizes="16x16">
	<link rel="manifest" href="<?php the_url('/images/favicon/manifest.json'); ?>">
	<link rel="mask-icon" href="<?php the_url('/images/favicon/safari-pinned-tab.svg'); ?>" color="#00a0f1">
	<link rel="shortcut icon" href="<?php the_url('/images/favicon/favicon.ico'); ?>">
</head>
<body id="<?php echo $post->post_type . '-' . $post->post_name ?>" <?php body_class(); ?>>
	<header id="header">
		<div class="container">
			<div class="row flex" data-mod="align-center">
				<div class="col-xs-2">
					<a href="<?php echo bloginfo('url'); ?>">
						<img src="" alt="<?php bloginfo('name'); ?>">
					</a>
				</div>
				<div class="col-xs-10 text-right">
					<nav class="main-menu-container">
						<?php
							wp_nav_menu(array(
								'theme_location' => 'primary',
								'container' => false,
								'menu_id' => 'main-menu',
								'walker' => new MV_Cleaner_Walker_Nav_Menu()
							));
							echo "\n"
						?>
					</nav>
				</div>
			</div>
		</div>
	</header>
	<?php the_part('subheader'); ?>

	<main id="content" role="main">