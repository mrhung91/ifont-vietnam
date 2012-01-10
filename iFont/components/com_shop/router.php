<?php
/**
 * @version		$Id: router.php 21321 2011-05-11 01:05:59Z dextercowley $
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Build the route for the com_shop component
 *
 * @param	array	An array of URL arguments
 * @return	array	The URL arguments to use to assemble the subsequent URL.
 * @since	1.5
 */
function ShopBuildRoute(&$query) {
	$segments	= array();

	// get a menu item based on Itemid or currently active
	$app		= JFactory::getApplication();
	$menu		= $app->getMenu();
	$params		= JComponentHelper::getParams('com_shop');
	$advanced	= $params->get('sef_advanced_link', 1);

	// we need a menu item.  Either the one specified in the query, or the current active one if none specified
	if (empty($query['Itemid'])) {
		$menuItem = $menu->getActive();
		$menuItemGiven = false;
	} else {
		$menuItem = $menu->getItem($query['Itemid']);
		$menuItemGiven = true;
	}

	if (isset($query['view'])) {
		$view = $query['view'];
	} else {
		// we need to have a view in the query or it is an invalid URL
		return $segments;
	}

	if ($view == 'package' || $view == 'font') {
		//$segments[] = $view;
		unset($query['view']);

		if ($view == 'font') {
			if (isset($query['id']) && isset($query['packageid']) && $query['packageid']) {
				$packageid = $query['packageid'];
				$id = $query['id'];
			} else {
				// we should have these two set for this view.  If we don't, it is an error
				return $segments;
			}
		} else {
			if (isset($query['id'])) {
				$packageid = $query['id'];
			} else {
				// we should have id set for this view.  If we don't, it is an error
				return $segments;
			}
		}

		if ($menuItemGiven && isset($menuItem->query['id'])) {
			$mPackageid = $menuItem->query['id'];
		} else {
			$mPackageid = 0;
		}

		$packageTbl = JTable::getInstance('Package', 'ShopTable');
		if (!$packageTbl->load($packageid)) {
			// we couldn't find the package we were given.  Bail.
			return $segments;
		}

		$path = array($packageTbl->getPath());

		$array = array();

		foreach($path AS $id) {
			if ((int)$id == (int)$mPackageid) {
				break;
			}

			list($tmp, $id) = explode(':', $id, 2);

			$array[] = $id;
		}

		$array = array_reverse($array);

		if (!$advanced && count($array)) {
			$array[0] = (int)$packageid.':'.$array[0];
		}

		$segments = array_merge($segments, $array);

		if ($view == 'font') {
			if ($advanced) {
				list($tmp, $id) = explode(':', $query['id'], 2);
			} else {
				$id = $query['id'];
			}
			$segments[] = $id;
		}
		unset($query['id']);
		unset($query['packageid']);
	} else if ($view == "cart") {
		unset($query['view']);
	}

	return $segments;
}

/**
 * Parse the segments of a URL.
 *
 * @param	array	The segments of the URL to parse.
 *
 * @return	array	The URL attributes to be used by the application.
 * @since	1.5
 */
function ShopParseRoute($segments) {
	global $component;
	JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_shop/tables');

	$vars = array();

	//Get the active menu item.
	$app	= JFactory::getApplication();
	$menu	= $app->getMenu();
	$item	= $menu->getActive();
	$params = JComponentHelper::getParams('com_shop');
	$advanced = $params->get('sef_advanced_link', 1);
	$db = JFactory::getDBO();

	// Count route segments
	$count = count($segments);

	// Standard routing for fonts.  If we don't pick up an Itemid then we get the view from the segments
	// the first segment is the view and the last segment is the id of the font or package.
	if (!isset($item)) {
		$vars['view']	= $segments[0];
		$vars['id']		= $segments[$count - 1];

		return $vars;
	}

	// if there is only one segment, then it points to either a font or a package
	// we test it first to see if it is a package.  If the id and alias match a package
	// then we assume it is a package.  If they don't we assume it is a font
	if ($count == 1) {
		// we check to see if an alias is given.  If not, we assume it is a font
		if (strpos($segments[0], ':') === false) {
			$alias = $segments[0];
		} else {
			list($id, $alias) = explode(':', $segments[0], 2);
		}

		// first we check if it is a category
		$query = 'SELECT alias, package_id AS id FROM #__shop_package WHERE alias = '.$db->quote($alias);
		$db->setQuery($query);
		$package = $db->loadObject();
		if ($package != null) {
			$vars['view'] = 'package';
			$vars['id'] = $package->id;
			return $vars;
		} else {
			$query = 'SELECT alias, font_id AS id FROM #__shop_font WHERE alias = '.$db->quote($alias);
			$db->setQuery($query);
			$font = $db->loadObject();

			if ($font) {
				$vars['view'] = 'font';
				$vars['id'] = $font->id;
				return $vars;
			}
		}
	}

	// if there was more than one segment, then we can determine where the URL points to
	// because the first segment will have the target category id prepended to it.  If the
	// last segment has a number prepended, it is an article, otherwise, it is a category.
	if (!$advanced) {
		$package_id = (int)$segments[0];
		$font_id = (int)$segments[$count - 1];

		if ($font_id > 0) {
			$vars['view'] = 'font';
			$vars['packageid'] = $package_id;
			$vars['id'] = $font_id;
		} else {
			$vars['view'] = 'package';
			$vars['id'] = $package_id;
		}

		return $vars;
	}

	$found = 0;
	foreach($segments as $segment) {
		$segment = str_replace(':', '-',$segment);

		if ($found == 0) {
			if ($advanced) {
				$db = JFactory::getDBO();
				$query = 'SELECT font_id AS id FROM #__shop_font WHERE alias = '.$db->Quote($segment);
				$db->setQuery($query);
				$pid = $db->loadResult();
			} else {
				$pid = $segment;
			}

			$vars['id'] = $pid;
			$vars['view'] = 'font';
		}

		$found = 0;
	}

	return $vars;
}
