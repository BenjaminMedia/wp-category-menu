<?php
/**
 * @package Category Menu
 * Plugin Name: Category Menu
 * Version: 0.1
 * Description: Autoload post category on menu, add [category] to menu item where you want to load category
 * Author: Niteco
 * Author URI: http://niteco.se/
 * Plugin URI: PLUGIN SITE HERE
 * Text Domain: category-menu
 * Domain Path: /languages
 */

/**
 * load all categories to sub-menu
 * @param $items
 * @param $args
 * @return mixed
 */
if (!function_exists('category_to_menu')) {
	function category_to_menu($items, $args)
	{
		$cat = array(
			'taxonomy'     => 'category',
			'hierarchical' => true,
			'title_li'     => '',
			'hide_empty'   => false,
			'echo' => false,
		);
		$categories = wp_list_categories($cat);
		$categories = str_replace('children', 'sub-menu', $categories);

		$items = str_replace('[category]</a>', '</a><ul class="sub-menu">'. $categories. '</ul>', $items);
		return $items;
	}

	add_filter( 'wp_nav_menu_items', 'category_to_menu', 10, 2);
}