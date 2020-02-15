<?php
/**
 * ${varname} post type
 */

// Define our post type names
${`${varname}_names`} = [
	'name'                  => 'vtl_${varname}',
	'menu_name'             => 'Widgets',
	'singular'              => 'Widget',
	'plural'                => 'Widgets',
	'all_items'             => 'All Widgets',
	'slug'                  => 'widget',
	'featured_image'        => 'Widget Diagram',
	'set_featured_image'    => 'Set ${varname} diagram',
	'remove_featured_image' => 'Remove ${varname} diagram',
	'use_featured_image'    => 'Use as ${varname} diagram',
];

// Define our options
${`${varname}_options`} = [
	'exclude_from_search' => false,
	'hierarchical'        => false,
	'menu_position'       => 20,
	'has_archive'         => true,
	'rewrite'             => array('with_front' => false),
	'show_in_admin_bar'   => true,
	'show_in_menu'        => true,
	'show_in_nav_menus'   => true,
	'show_in_rest'        => false,
	'show_ui'             => true,
	'supports'            => array('title', 'page-attributes'),
];

// Create post type
${`${varname}`} = new PostType($widget_names, $widget_options);

// Set the menu icon
${`${varname}`}->icon('dashicons-star-filled');

// Set the title placeholder text
${`${varname}`}->placeholder('Enter ${varname} name');

// Hide admin columns
${`${varname}`}->columns()->hide(['wpseo-score', 'wpseo-score-readability']);

// Set all columns
${`${varname}`}->columns()->set([
	'cb'          => '<input type="checkbox" />',
	'feat_img'    => 'Thumb',
	'title'       => __('Title'),
	'widget_type' => __('Group'),
]);

// Add custom admin columns to default array
${`${varname}`}->columns()->add([
	'${varname}_color' => 'Color',
]);

// Populate custom admin columns
${`${varname}`}->columns()->populate('${varname}_color', function($column, $post_id) {
	echo get_post_meta($post_id, '${varname}_color');
});

// Add CSS to style columns
add_action('admin_head', function() {
	$screen = get_current_screen();
	if ($screen && ($screen->base === 'edit') && ($screen->id === 'edit-vtl_${varname}')) {
		echo '<style>
		th[id=feat_img] {
			width: 42px;
		}
		</style>';
	}
});

// Make custom admin columns sortable
${`${varname}`}->columns()->sortable([
	'${varname}_color' => ['${varname}_color', true]
]);

// Define taxonomy names
${`${varname}_type_names`} = [
	'name'     => 'widget_type',
	'singular' => 'Widget Type',
	'plural'   => 'Widget Types',
	'slug'     => 'widget-type',
];

// Define taxonomy options
${`${varname}_type_options`} = [
	'heirarchical'      => true,
	'labels'            => array('menu_name' => 'Types'),
	'show_admin_column' => true,
	'show_in_nav_menus' => false,
	'show_in_rest'      => true,
];

// Register taxonomy
${`${varname}`}->taxonomy(${`${varname}_type_names`}, ${`${varname}_type_options`});
