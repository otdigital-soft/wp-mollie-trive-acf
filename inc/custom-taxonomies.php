<?php
/**
 * Custom taxonomies for use with this theme
 */

add_action( 'init', 'custom_taxonomies' );

/**
 * Adds custom taxonomies
 */
function custom_taxonomies() {
	// Room type
	register_taxonomy(
		'room_type',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'room',             // post type name
		array(
			'hierarchical' => true,
			'label'        => 'Room Types', // display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'rooms',    // This controls the base slug that will display before each term
				'with_front' => false,  // Don't display the category base before
			),
			'show_in_rest' => true,
		)
	);
	// Room type
	register_taxonomy(
		'location_category',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'location',             // post type name
		array(
			'hierarchical' => true,
			'label'        => 'Categories', // display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'locations',    // This controls the base slug that will display before each term
				'with_front' => false,  // Don't display the category base before
			),
			'show_in_rest' => true,
		)
	);
}
