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

class ShopTablePackage extends JTable {

	protected $_types;

	function __construct(&$db) {
		parent::__construct('#__shop_package', 'package_id', $db);
	}

	/**
	 * Overloaded check function
	 *
	 * @return	boolean
	 * @see		JTable::check
	 * @since	1.5
	 */
	function check()
	{
		jimport('joomla.filter.output');

		// Set name
		$this->name = htmlspecialchars_decode($this->name, ENT_QUOTES);

		// Set alias
		$this->alias = JApplication::stringURLSafe($this->alias);
		if (empty($this->alias)) {
			$this->alias = JApplication::stringURLSafe($this->name);
		}

		return true;
	}

	protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_shop.package.'.(int) $this->$k;
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

		if (isset($array['types']) && is_array($array['types'])) {
			$this->setTypes($array['types']);
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
		$date	= JFactory::getDate();
		$user	= JFactory::getUser();

		if ($this->package_id) {
			// Existing category
			$this->modified		= $date->toMySQL();
			$this->modified_by	= $user->get('id');
		} else {
			// New category
			$this->created		= $date->toMySQL();
			$this->created_by	= $user->get('id');
		}

		if (parent::store($updateNulls)) {
			if ($this->package_id && $this->_types != null) {
				$db	=& JFactory::getDBO();
				$query = $this->_db->getQuery(true);
				$query->delete();
				$query->from('`#__shop_package_type`');
				$query->where('package_id = ' . $this->package_id);
				$this->_db->setQuery($query);
				$this->_db->query();

				foreach ($this->_types as $typeId) {
					$typeModel = JModel::getInstance("PackageType", "ShopModel");
					$data = array("package_id" => $this->package_id, "type_id" => $typeId);
					$typeModel->save($data);
				}
			}
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
