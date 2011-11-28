<?php
/**
 * @version		$Id: package.php 21822 2011-07-12 10:40:17Z infograf768 $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * This models supports retrieving a package, the fonts associated with the package.
 *
 * @package		Joomla.Site
 * @subpackage	com_shop
 * @since		1.5
 */
class ShopModelType extends JModelList {

	/**
	 * Model context string.
	 *
	 * @var		string
	 */
	protected $_context = 'com_shop.type';

	public function getTypeNameById($type_id) {
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$query->select("a.title")
			->from("#__shop_type a")
			->where("a.id=".$type_id);
		$db->setQuery($query);
		$result = $db->loadResult();
		return $result;
	}

}
