<?php

/**
 * JoomBlog component for Joomla 1.6 & 1.7
 * @package JoomBlog
 * @author JoomPlace Team
 * @Copyright Copyright (C) JoomPlace, www.joomplace.com
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.database.table');

class ShopTableOrderItem extends JTable {

	function __construct(&$db) {
		parent::__construct('#__shop_order_item', 'id', $db);
	}

	/**
	 * Overloaded check function
	 *
	 * @return	boolean
	 * @see		JTable::check
	 * @since	1.5
	 */
	function check() {
		return true;
	}

	protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_shop.order_item.'.(int) $this->$k;
	}

	protected function _getAssetTitle()
	{
		return $this->title;
	}

	public function bind($array, $ignore = '') {
		return parent::bind($array, $ignore);
	}

	public function delete($pk = null) {
		$db = $this->getDBO();

		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__shop_order_item');
		$query->where('id='.$pk);

		$db->setQuery($query);
		$ids = $db->loadObjectList();

		if ($ids) {
			$orderItemTbl = JTable::getInstance('OrderItem', 'ShopTable');
			foreach ($ids as $id) {
				$orderItemTbl->delete($id);
			}
		}

		return parent::delete($pk);
	}

	public function store($updateNulls = false) {
		if (parent::store($updateNulls)) {
			return true;
		}
		return false;
	}

}
