<?php

/* Shorthand declaration */
function render_meta($metas) {
	$tags = [];

	/* Loop through each meta tag */
	foreach ($metas as $meta) {

		/* Properties are required */
		if (!empty($meta)) {
			$tag = ['<meta'];

			/* Loop through each property */
			foreach ($meta as $property => $value) {
				array_push($tag, $property . '="' . $value . '"');
			}

			/* Enclode the tag and push it to $tags */
			array_push($tag, '>');
			$tag = implode(' ', $tag);
			array_push($tags, $tag);
		}

	}

	$tags = implode("\n\t", $tags);
	echo $tags;
}

/* Output */
// render_meta([
// 	[
// 		'name' => 'title',
// 		'content' => 'EPSI Furniture'
// 	],
// 	[
// 		'name' => 'description',
// 		'content' => 'This is a furniture website.'
// 	],

// 	/* Twitter */
// 	[
// 		'name' => 'twitter:card',
// 		'content' => 'summary_large_image'
// 	],
// 	[
// 		'name' => 'twitter:url',
// 		'content' => get_site_url()
// 	],
// 	[
// 		'name' => 'twitter:title',
// 		'content' => 'EPSI'
// 	]
// ]);
