<?php
/**
 * @version		$Id: categories.php 21593 2011-06-21 02:45:51Z dextercowley $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

jimport('joomla.application.component.model');
require_once JPATH_COMPONENT . '/helpers/cart.php';

/**
 * This models supports retrieving lists of article categories.
 *
 * @package		Joomla.Site
 * @subpackage	com_shop
 * @since		1.6
 */
class ShopModelCart extends JModel
{
	/**
	 * Model context string.
	 *
	 * @var		string
	 */
	public $_context = 'com_shop.cart';

	/**
	 * The category context (allows other extensions to derived from this model).
	 *
	 * @var		string
	 */
	protected $_extension = 'com_shop';

	private $_parent = null;

	private $_items = null;

	/**
	 * Redefine the function an add some properties to make the styling more easy
	 *
	 * @param	bool	$recursive	True if you want to return children recursively.
	 *
	 * @return	mixed	An array of data items on success, false on failure.
	 * @since	1.6
	 */
	public function getItems() {
		$items = array();
		$cartInfo = ShopHelperCart::getShopCartInfo();

		if (isset($cartInfo["fonts"])) {
			$fonts = $cartInfo["fonts"];
			if ($fonts != null && count($fonts) > 0) {
				$fontItems = array();
				foreach ($fonts as $font_id => $font) {
					$font->link = ShopHelperRoute::getFontRoute($font_id);
					$font->package_link = ShopHelperRoute::getPackageRoute($font->package_id);
					$fontItems[] = $font;
				}
				$items["fonts"] = $fontItems;
			}
		}
		if (!isset($items["fonts"])) {
			$items["fonts"] = array();
		}

		if (isset($cartInfo["packages"])) {
			$packages = $cartInfo["packages"];
			if ($packages != null && count($packages) > 0) {
				$packageItems = array();
				foreach ($packages as $package_id => $package) {
					$package->link = ShopHelperRoute::getPackageRoute($package_id);
					$packageItems[] = $package;
				}
				$items["packages"] = $packageItems;
			}
		}
		if (!isset($items["packages"])) {
			$items["packages"] = array();
		}

		return $items;
	}

	protected function populateState($ordering = null, $direction = null) {
		// Initiliase variables.
		$app	= JFactory::getApplication('site');

		// Load the parameters. Merge Global and Menu Item params into new object
		$params = $app->getParams();
		$menuParams = new JRegistry;

		if ($menu = $app->getMenu()->getActive()) {
			$menuParams->loadString($menu->params);
		}

		$mergedParams = clone $menuParams;
		$mergedParams->merge($params);

		$this->setState('params', $mergedParams);
	}

}
