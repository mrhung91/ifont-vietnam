<?php
/**
 * @version		$Id: category.php 21097 2011-04-07 15:38:03Z dextercowley $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.categories');

/**
 * Content Component Category Tree
 *
 * @static
 * @package		Joomla.Site
 * @subpackage	com_content
 * @since 1.6
 */
class ShopHelperPackage {

	public static function getNumFonts($package_id) {
		$db = JFactory::getDbo();
		$query = "SELECT COUNT(*) FROM #__shop_font a WHERE package_id = " . $package_id;
		$db->setQuery($query);
		$num_fonts = $db->loadResult();
		return $num_fonts;
	}

}
