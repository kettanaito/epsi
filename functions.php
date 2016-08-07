<?php

// Debugging shorthand
function p($s) {
	echo '<pre>';
	print_r($s);
	echo '</pre>';
}

/* Constants */
define(THEME_NAME, 'epsi');
define(THEME_URL, get_template_directory_uri());

/* Hide WordPress admin bar */
add_filter('show_admin_bar', '__return_false');

/* Remove WordPress default <head> inserts */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wp_generator');

remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_shortlink_wp_head');

/* Remove WordPress Emoji CSS and JavaScript */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

/* Remove Menu item */
add_action('admin_menu', function () {
	$remove_pages = ['edit.php', 'edit-comments.php'];

	foreach ($remove_pages as $page_slug) {
		remove_menu_page($page_slug);
	}
});

/* Shorthand: Slugify */
function slugify($string) {
	$string = preg_replace('~[^\pL\d]+~u', '-', $string);
	$string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
	$string = preg_replace('~[^-\w]+~', '', $string);
	$string = trim($string, '-');
	$string = preg_replace('~-+-~', '-', $string);
	$string = strtolower($string);
	echo $string;
}

/* Shorthand: Indent */
function indent($depth) {
	return str_repeat("\t", $depth + 6);
}

/* Custom Menu Walker */
class MV_Cleaner_Walker_Nav_Menu extends Walker {
		var $tree_type = array('post_type', 'taxonomy', 'custom');
		var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

		function start_lvl(&$output, $depth, $args) {
			$indent = indent($depth);
			$output .= "\n" . $indent . "<ul class=\"sub-menu\">\n";
		}

		function end_lvl(&$output, $depth, $args) {
			$output .= indent($depth) . "\</ul>\n";
		}

		function start_el(&$output, $item, $depth, $args) {
			global $wp_query;
			$class_names = $value = '';
			$classes = empty($item->classes ) ? array() : (array) $item->classes;
			$new_classes = [];
			$allowed_classes = ['menu-item', 'current-menu-item'];
			foreach ($allowed_classes as $class) {
				in_array($class, $classes) && array_push($new_classes, $class);
			}
			$classes = $new_classes;
			$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
			$class_names = strlen(trim( $class_names)) > 0 ? ' class="' . esc_attr($class_names) . '"' : '';
			$id = apply_filters('nav_menu_item_id', '', $item, $args );
			$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';
			$output .= "\n" . indent($depth + 1) . '<li' . $id . $value . $class_names .'>';
			$attributes  = ! empty($item->attr_title ) ? ' title="' . esc_attr( $item->attr_title) .'"' : '';
			$attributes .= ! empty($item->target ) ? ' target="' . esc_attr( $item->target) .'"' : '';
			$attributes .= ! empty($item->xfn ) ? ' rel="' . esc_attr( $item->xfn) .'"' : '';
			$attributes .= ! empty($item->url ) ? ' href="' . esc_attr( $item->url) .'"' : '';
			$item_output = $args->before;
			$item_output .= "\n" . indent($depth + 2) . '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
			$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
		}

		function end_el(&$output, $item, $depth) {
			$output .= "\n" . indent($depth + 1) . "</li>";
		}
}

/* Append Search button to Main menu */
add_filter('wp_nav_menu_items', 'add_nav_menu_items', 10, 2);
function add_nav_menu_items( $items, $args, $depth ) {
	$search_item = "\n" . indent($depth + 1) . "<li id=\"menu-item-search\" class=\"menu-item\">\n";
	$search_item .= indent($depth + 2) . "<a href=\"#\">S</a>\n";
	$search_item .= indent($depth + 1) . "</li>";
	$search_item .= "\n" . indent($depth);
	return $items . $search_item;
}

/* Indents the output of a function */
if (!function_exists('print_indented')) {
	function print_indented($fn) {
		ob_start();
		call_user_func($fn);
		$html = ob_get_contents();
		ob_end_clean();
		echo preg_replace("/\n/", "\n\t", substr($html, 0, - 1));
		echo "\n";
	}
}

/* HTML5: Remove type="text/css" from <link> */
function style_hide_type($src) {
	$formated = str_replace("'", '"', $src);
	$formated = str_replace('type="text/css"', '', $formated);
	$formated = str_replace('  ', ' ', $formated);
	return $formated;
}
add_filter('style_loader_tag', 'style_hide_type');

/* HTML5: Remove type="text/javascript" from <script> */
function script_hide_type($src) {
	$formated = str_replace("'", '"', $src);
	$formated = str_replace('type="text/javascript"', '', $formated);
	$formated = str_replace('  ', ' ', $formated);
	return $formated;
}
add_filter('script_loader_tag', 'script_hide_type');

/* Enable thumbnails support */
add_theme_support('post-thumbnails');

/* Clean <body> classes */
add_filter('body_class', 'body_class_blacklist', 10, 2);

function body_class_blacklist($wp_classes, $extra_classes) {
	/* List of the forbidden WP generated classes */
	$blacklist = ['logged-in', 'page-id', 'page-template-default'];

	/* Filter the body classes */
	foreach ($blacklist as $forbiddenClass) {
		foreach ($wp_classes as $i => $item) {
			if (strpos($item, $forbiddenClass) !== false) {
				unset($wp_classes[$i]);
			}
		}
	}

	/* Add the extra classes back untouched */
	return array_merge($wp_classes, (array) $extra_classes);
}

/* Get meta */
function get_meta() {
	include_once('meta.php');
}

/* Shorthand: Get relative URL */
function get_url($path) {
	$url = esc_url(THEME_URL . '/' . $path);
	return $url;
}

function the_url($path) {
	$url = esc_url(THEME_URL . '/' . $path);
	echo $url;
}

/* Initialize the theme */
add_action('after_setup_theme', 'theme_setup');

function theme_setup () {
	/* Translation domain */
	load_theme_textdomain(THEME_NAME, THEME_URL . '/languages');

	/* Navigation menu */
	register_nav_menus(array(
		'primary' => __('Main Menu', THEME_NAME)
	));

	/* Declare thumbnail sizes */
	// WIP: Redeclare sizes
	add_image_size('post-thumbnail-tiny', 0, 0, true);
	add_image_size('post-thumbnail-mobile', 0, 0, true);
}

/* Include theme CSS and JavaScript */
add_action('wp_enqueue_scripts', 'theme_assets');

/* Include theme assets dynamically */
function theme_assets() {

	/* Include assets */
	theme_assign_assets(array(

		/* Site-wide assets */
		'all' => array(

			'styles' => array(
				'theme' => get_url('assets/css/style.min.css')
			),

			'scripts' => array(
				'fout' => array(
					'url' => get_url('assets/js/fout.min.js'),
					'in_footer' => false
				),
				'theme' => array(
					'url' => get_url('assets/js/script.min.js'),
					'dependency' => 'jquery'
				)
			)
		)

		/* Page-specific assets */
		// 'single-post' => array(
		// 	'scripts' => array(
		// 		['parallax', '/plugins/parallax.min.js'],
		// 		['vibrant', '/plugins/vibrant.min.js'],
		// 		['single-post', '/single-post.min.js', 'vibrant']
		// 	)
		// ),

		// 'contacts' => array(
		// 	'scripts' => array(
		// 		['google-maps', '/libs/google.maps.api.js', 0, 0, false],
		// 		['contacts', '/contacts.min.js', 'google-maps']
		// 	)
		// )

	));

}

/* Assign custom assets depending on page */
function theme_assign_assets($data) {
	$body_classes = get_body_class();

	foreach ($data as $pages => $assets) {
		$pages = explode(',', str_replace(' ', '', $pages));
		$styles = $assets['styles'];
		$scripts = $assets['scripts'];

		foreach ($pages as $page_slug) {

			if ($page_slug == 'all' || is_page($page_slug) || in_array($page_slug, $body_classes)) {

				/* Include Styles */
				foreach ($styles as $style_name => $style_data) {
					$url = is_array($style_data) ? $style_data['url'] : $style_data;
					wp_enqueue_style('style-' . $style_name, $url);
				}

				/* Include Scripts */
				foreach ($scripts as $script_name => $script_data) {
					$priority = array_key_exists('priority', $script_data) ? $script_data['priority'] : false;
					$url = is_array($script_data) ? $script_data['url'] : $script_data;
					$dependency = array_key_exists('dependency', $script_data) ? $script_data['dependency'] : true;
					$version = array_key_exists('version', $script_data) ? $script_data['version'] : true;
					$in_footer = array_key_exists('in_footer', $script_data) ? $script_data['in_footer'] : true;

					wp_enqueue_script($script_name, $url, $dependency, $version, $in_footer);
				}

			}

		}

	}
}

/* Layout */

/* Shorthand: Get template part */
function the_part($filename) {
	$parts_directory = 'parts/';
	return get_template_part($parts_directory . $filename);
}