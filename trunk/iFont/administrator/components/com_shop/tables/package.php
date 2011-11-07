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

class ShopTablePackage extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__shop_package', 'package_id', $db);
		$this->created = JFactory::getDate()->toMySQL();
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

		if (isset($array['metadata']) && is_array($array['metadata'])) {
			$registry = new JRegistry();
			$registry->loadArray($array['metadata']);
			$array['metadata'] = (string)$registry;
		}

		if (isset($array['rules']) && is_array($array['rules'])) {
			$rules = new JRules($array['rules']);
			$this->setRules($rules);
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
			if ($this->id) {
				$db	=& JFactory::getDBO();
			}
			return true;
		}
		return false;
	}
}
