<?php
/**
 * @version		$Id: route.php 21097 2011-04-07 15:38:03Z dextercowley $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.helper');

/**
 * Shop Component Route Helper
 *
 * @static
 * @package		Joomla.Site
 * @subpackage	com_shop
 * @since 1.5
 */
abstract class ShopHelperRoute {
	protected static $lookup;

	/**
	 * @param	int	The route of the content item
	 */
	public static function getFontRoute($font_id, $package_id = 0) {
		$needles = array(
			'font_id'  => array((int) $font_id)
		);
		//Create the link
		$link = 'index.php?option=com_shop&view=font&id='. $font_id;
		if ((int) $package_id > 0) {
			$package = JTable::getInstance("Package", "ShopTable");
			if(is_numeric($package_id) && $package->load($package_id)) {
				$package_slug = $package->getPath();
			} else {
				$package_slug = $package_id;
			}
			$needles['package'] = $package_slug;
			$needles['packages'] = $needles['package'];
			$link .= '&packageid='.$package_slug;
		}

		if ($item = self::_findItem($needles)) {
			$link .= '&Itemid='.$item;
		} elseif ($item = self::_findItem()) {
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	public static function getPackageRoute($package_id) {
		$id = (int) $package_id;
		$package = JTable::getInstance("Package", "ShopTable");

		if($id < 1) {
			$link = '';
		} else {
			if ($package->load($package_id)) {
				$packageids = $package->getPath();
				$needles = array(
					'package' => $packageids,
					'packages' => $packageids
				);
			}

			if ($item = self::_findItem($needles)) {
				$link = 'index.php?Itemid='.$item;
			} else {
				//Create the link
				$link = 'index.php?option=com_shop&view=package&id='.$id;
				if ($item = self::_findItem($needles)) {
					$link .= '&Itemid='.$item;
				} else if ($item = self::_findItem()) {
					$link .= '&Itemid='.$item;
				}
			}
		}

		return $link;
	}

	public static function getFormRoute($id) {
		//Create the link
		if ($id) {
			$link = 'index.php?option=com_shop&task=font.edit&a_id='. $id;
		} else {
			$link = 'index.php?option=com_shop&task=font.edit&a_id=0';
		}

		return $link;
	}

	protected static function _findItem($needles = null) {
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu('site');

		// Prepare the reverse lookup array.
		if (self::$lookup === null) {
			self::$lookup = array();

			$component	= JComponentHelper::getComponent('com_shop');
			$items		= $menus->getItems('component_id', $component->id);
			foreach ($items as $item) {
				if (isset($item->query) && isset($item->query['view'])) {
					$view = $item->query['view'];
					if (!isset(self::$lookup[$view])) {
						self::$lookup[$view] = array();
					}
					if (isset($item->query['id'])) {
						self::$lookup[$view][$item->query['id']] = $item->id;
					}
				}
			}
		}

		if ($needles) {
			foreach ($needles as $view => $id) {
				if (isset(self::$lookup[$view])) {
					if (isset(self::$lookup[$view][(int)$id])) {
						return self::$lookup[$view][(int)$id];
					}
				}
			}
		} else {
			$active = $menus->getActive();
			if ($active && $active->component == 'com_shop') {
				return $active->id;
			}
		}

		return null;
	}
}
