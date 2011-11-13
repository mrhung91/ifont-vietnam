<?php
/**
 * @version		$Id: pagination.php 21097 2011-04-07 15:38:03Z dextercowley $
 * @package		Joomla.Administrator
 * @subpackage	Templates.bluestork
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * This is a file to add template specific chrome to pagination rendering.
 *
 * pagination_list_footer
 *	Input variable $list is an array with offsets:
 *		$list[prefix]		: string
 *		$list[limit]		: int
 *		$list[limitstart]	: int
 *		$list[total]		: int
 *		$list[limitfield]	: string
 *		$list[pagescounter]	: string
 *		$list[pageslinks]	: string
 *
 * pagination_list_render
 *	Input variable $list is an array with offsets:
 *		$list[all]
 *			[data]		: string
 *			[active]	: boolean
 *		$list[start]
 *			[data]		: string
 *			[active]	: boolean
 *		$list[previous]
 *			[data]		: string
 *			[active]	: boolean
 *		$list[next]
 *			[data]		: string
 *			[active]	: boolean
 *		$list[end]
 *			[data]		: string
 *			[active]	: boolean
 *		$list[pages]
 *			[{PAGE}][data]		: string
 *			[{PAGE}][active]	: boolean
 *
 * pagination_item_active
 *	Input variable $item is an object with fields:
 *		$item->base	: integer
 *		$item->prefix	: string
 *		$item->link	: string
 *		$item->text	: string
 *
 * pagination_item_inactive
 *	Input variable $item is an object with fields:
 *		$item->base	: integer
 *		$item->prefix	: string
 *		$item->link	: string
 *		$item->text	: string
 *
 * This gives template designers ultimate control over how pagination is rendered.
 *
 * NOTE: If you override pagination_item_active OR pagination_item_inactive you MUST override them both
 */

function pagination_list_render($list) {
	// Initialise variables.
	$html = '<ul class="clearfix">';
	$html .= '<li class="pagination-prev">'.$list['previous']['data'].'</li>';
	foreach($list['pages'] as $page) {
		$html .= '<li>'.$page['data'].'</li>';
	}
	$html .= '<li class="pagination-next">'. $list['next']['data'].'</li>';
	$html .= '</ul>';

	return $html;
}

function pagination_item_active(&$item) {
	$text = pagination_item_text($item);
	return "<a href=\"" . $item->link . "\" title=\"".$item->text."\">".$text."</a>";
}

function pagination_item_inactive(&$item) {
	$text = pagination_item_text($item);
	return "<span>".$text."</span>";
}

function pagination_item_text($item) {
	$text = is_numeric($item->text) ? sprintf('%02d', $item->text) : $item->text;
	return $text;
}
?>
