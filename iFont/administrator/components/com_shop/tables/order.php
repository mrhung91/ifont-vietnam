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

class ShopTableOrder extends JTable {

	protected $_fonts;
	protected $_packages;

	function __construct(&$db)
	{
		parent::__construct('#__shop_order', 'id', $db);
		$this->created = JFactory::getDate()->toMySQL();
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
		return 'com_shop.order.'.(int) $this->$k;
	}

	protected function _getAssetTitle() {
		return $this->title;
	}

	protected function _getAssetParentId($table = null, $id = null) {
		$assetId = null;
		$asset = JTable::getInstance('Asset');
		$asset->loadByName('com_shop');
		return $asset->id;
	}

	public function bind($array, $ignore = '') {
		if (isset($array['params']) && is_array($array['params'])) {
			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			$array['params'] = (string)$registry;
		}

		if (isset($array['fonts']) && is_array($array['fonts'])) {
			$this->setFonts($array['fonts']);
		}

		if (isset($array['packages']) && is_array($array['packages'])) {
			$this->setPackages($array['packages']);
		}

		return parent::bind($array, $ignore);
	}

	public function changeState($pks = null, $state = 1, $userId = 0) {
		// Initialise variables.
		$k = $this->_tbl_key;

		// Sanitize input.
		JArrayHelper::toInteger($pks);
		$userId = (int) $userId;
		$state  = (int) $state;

		// If there are no primary keys set check to see if the instance key is set.
		if (empty($pks)) {
			if ($this->$k) {
				$pks = array($this->$k);
			}
			// Nothing to set publishing state on, return false.
			else {
				$this->setError(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
				return false;
			}
		}

		// Get an instance of the table
		$table = JTable::getInstance('Order','ShopTable');
		$date = JFactory::getDate();
		$user = JFactory::getUser();

		// For all keys
		foreach ($pks as $pk) {
			// Load the banner
			if(!$table->load($pk)) {
				$this->setError($table->getError());
			}

			// Change the state
			$table->state = $state;
			$table->modified = $date->toMySQL();
			$table->modified_by = $user->get('id');

			// Check the row
			$table->check();

			// Store the row
			if (!$table->store()) {
				$this->setError($table->getError());
			}
		}
		return count($this->getErrors())==0;
	}

	public function store($updateNulls = false) {
		if (parent::store($updateNulls)) {
			if ($this->id) {
				if ($this->_fonts != null) {
					foreach ($this->_fonts as $fontInfo) {
						$itemModel = JModel::getInstance("OrderItem", "ShopModel");
						$data = array("order_id" => $this->id, "font_id" => $fontInfo->id);
						$itemModel->save($data);
					}
				}
				if ($this->_packages != null) {
					foreach ($this->_packages as $packageInfo) {
						$itemModel = JModel::getInstance("OrderItem", "ShopModel");
						$data = array("order_id" => $this->id, "package_id" => $packageInfo->id);
						$itemModel->save($data);
					}
				}
			}
			return true;
		}
		return false;
	}

	public function getPath() {
		return $this->id.':'.$this->alias;
	}

	public function setFonts($fonts) {
		$this->_fonts = $fonts;
	}

	public function setPackages($packages) {
		$this->_packages = $packages;
	}

}
