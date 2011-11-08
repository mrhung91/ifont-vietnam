<?php
/**
 * @version		$Id: helper.php 21020 2011-03-27 06:52:01Z infograf768 $
 * @package		Joomla.Site
 * @subpackage	mod_search
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * @package		Joomla.Site
 * @subpackage	mod_shop_packages
 * @since		1.5
 */
class modShopPackagesHelper {

	public static function getList($params) {
		$db = JFactory::getDbo();
		$query = "SELECT * FROM #__shop_package a ORDER BY a.created DESC";

		$limit = $params->get('limit, 10');
		$db->setQuery($query, 0, $limit);

		$items = $db->loadObjectList();

		foreach ($items as $item) {
			$item->num_fonts = modShopPackagesHelper::_getNumFonts($item->package_id);
			$item->user = modShopPackagesHelper::_getUser($item->created_by);
		}

		return $items;
	}

	private static function _getNumFonts($package_id) {
		$db = JFactory::getDbo();
		$query = "SELECT COUNT(*) FROM #__shop_font a";
		$db->setQuery($query);
		$num_fonts = $db->loadResult();
		return $num_fonts;
	}

	private static function _getUser($user_id) {
		$db = JFactory::getDbo();
		$query = "SELECT a.name FROM #__users a WHERE a.id = " . $user_id;
		$db->setQuery($query);
		$user_name = $db->loadResult();
		return $user_name;
	}

}