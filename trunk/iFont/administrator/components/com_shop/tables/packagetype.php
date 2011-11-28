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

class ShopTablePackageType extends JTable {

	protected $_types;

	function __construct(&$db) {
		parent::__construct('#__shop_package_type', 'id', $db);
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
		return 'com_shop.package_type.'.(int) $this->$k;
	}

	protected function _getAssetTitle()
	{
		return $this->title;
	}

	protected function _getAssetParentId($table = null, $id = null)
	{
		$assetId = null;
		$asset = JTable::getInstance('Asset');
		$asset->loadByName('com_shop');
		return $asset->id;
	}

	public function bind($array, $ignore = '')
	{
		if (isset($array['params']) && is_array($array['params'])) {
			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			$array['params'] = (string)$registry;
		}

		if (isset($array['type']) && is_array($array['type'])) {
			$this->setTypes($array['type']);
		}

		return parent::bind($array, $ignore);
	}

	public function delete($pk = null) {
		$db = $this->getDBO();

		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__shop_font');
		$query->where('package_id='.$pk);

		$db->setQuery($query);
		$ids = $db->loadObjectList();

		if ($ids) {
			$content = JTable::getInstance('Font');
			foreach ($ids as $id) {
				$content->delete($id);
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

	public function getPath() {
		return $this->package_id.':'.$this->alias;
	}

	public function setTypes($types) {
		$this->_types = $types;
	}

}
