<?php

elgg_load_css('jquery.mmenu/jquery.mmenu.all.css');
elgg_require_js('navigation/menu/site');


// we want css classes to use dashes
$name = elgg_extract('name', $vars, '');

$name_class_selector = preg_replace('/[^a-z0-9\-]/i', '-', strtolower($name));
		
$show_section_headers = elgg_extract('show_section_headers', $vars, false);
$item_class = elgg_extract('item_class', $vars, '');

$class = elgg_extract_class($vars, ["elgg-menu", "elgg-menu-{$name_class_selector}"]);

$menu_view = '';

foreach ($vars['menu'] as $section => $menu_items) {
	$section_class = $class;
	$section_class_selector = preg_replace('/[^a-z0-9\-]/i', '-', strtolower($section));
	$section_class[] = "elgg-menu-{$name_class_selector}-{$section_class_selector}";
	
	$menu_view .= elgg_view('mmenu/section', [
		'items' => $menu_items,
		'class' => $section_class,
		'section' => $section,
		'name' => $name,
		'show_section_headers' => $show_section_headers,
		'item_class' => $item_class,
		'id' => elgg_extract('id', $vars),
	]);
}

if (!$menu_view) {
	return;
}

echo elgg_format_element('nav', [
	'class' => [
		'elgg-menu-container',
		"elgg-menu-{$name_class_selector}-container",
	],
	'data-menu-name' => $name,
], elgg_format_element('ul', [], $menu_view));

