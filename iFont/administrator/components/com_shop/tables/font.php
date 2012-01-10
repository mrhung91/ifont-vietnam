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

class ShopTableFont extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__shop_font', 'font_id', $db);
	}

	/**
	 * Overloaded check function
	 *
	 * @return	boolean
	 * @see		JTable::check
	 * @since	1.5
	 */
	function check() {
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
		return 'com_shop.font.'.(int) $this->$k;
	}

	protected function _getAssetTitle()
	{
		return $this->title;
	}

	public function bind($array, $ignore = '') {
		if (isset($array['attribs'])) {
			if (is_array($array['attribs'])) {
				$registry = new JRegistry();
				$registry->loadArray($array['attribs']);
				$array['attribs'] = (string)$registry;
			} else if ($array['attribs'] instanceof JRegistry) {
				$array['attribs'] = (string) $array['attribs'];
			}
		}
		return parent::bind($array, $ignore);
	}

	public function store($updateNulls = false) {
		$date	= JFactory::getDate();
		$user	= JFactory::getUser();

		if ($this->font_id) {
			// Existing category
			$this->modified		= $date->toMySQL();
			$this->modified_by	= $user->get('id');
		} else {
			// New category
			$this->created		= $date->toMySQL();
			$this->created_by	= $user->get('id');
		}

		if (parent::store($updateNulls)) {
			return true;
		}
		return false;
	}
}
