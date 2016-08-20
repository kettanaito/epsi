<?php
	$header_classes = is_array($header_classes) ? implode(' ', $header_classes) : $header_classes;
?>
<header id="header" <?php if ($header_classes) { ?>class="<?php echo $header_classes; ?>"<?php } ?>>
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
							'walker' => new Main_Menu_Walker()
						));
						echo "\n"
					?>
				</nav>
			</div>
		</div>
	</div>
</header>