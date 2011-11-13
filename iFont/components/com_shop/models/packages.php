<?php
/**
 * @version		$Id: categories.php 21593 2011-06-21 02:45:51Z dextercowley $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');
jimport('joomla.application.component.helper');

/**
 * This models supports retrieving lists of article categories.
 *
 * @package		Joomla.Site
 * @subpackage	com_shop
 * @since		1.6
 */
class ShopModelPackages extends JModelList
{
	/**
	 * Model context string.
	 *
	 * @var		string
	 */
	public $_context = 'com_shop.packages';

	/**
	 * The category context (allows other extensions to derived from this model).
	 *
	 * @var		string
	 */
	protected $_extension = 'com_shop';

	private $_parent = null;

	private $_items = null;

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication();
		$this->setState('filter.extension', $this->_extension);

		// Get the parent id if defined.
		$parentId = JRequest::getInt('id');
		$this->setState('filter.parentId', $parentId);

		$params = $app->getParams();
		$this->setState('params', $params);

		$this->setState('filter.published',	1);
		$this->setState('filter.access',	true);
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 *
	 * @return	string		A store id.
	 */
	protected function getStoreId($id = '') {
		// Compile the store id.
		$id	.= ':'.$this->getState('filter.extension');
		$id	.= ':'.$this->getState('filter.published');
		$id	.= ':'.$this->getState('filter.access');
		$id	.= ':'.$this->getState('filter.parentId');

		return parent::getStoreId($id);
	}

	/**
	 * Gets a list of packages
	 *
	 * @return	array	An array of banner objects.
	 * @since	1.6
	 */
	function getListQuery() {
		$db			= $this->getDbo();
		$query		= $db->getQuery(true);
		$nullDate	= $db->quote($db->getNullDate());

		$query->select('a.package_id as id, a.name as name, a.price, a.alias, a.description,'
			. ' a.thumb, a.is_vietnamese, a.is_mac, a.is_windows'
		);
		$query->from('#__shop_package as a');
		$query->join('LEFT', '#__users AS u ON u.id = a.created_by');
		$query->select('u.name as user');
		$query->where('a.status=1');

		$query->order('a.package_id DESC');

		return $query;
	}

	/**
	 * Redefine the function an add some properties to make the styling more easy
	 *
	 * @param	bool	$recursive	True if you want to return children recursively.
	 *
	 * @return	mixed	An array of data items on success, false on failure.
	 * @since	1.6
	 */
	public function getItems($recursive = false) {
		if (!isset($this->cache['items'])) {
			$this->cache['items'] = parent::getItems();
			foreach ($this->cache['items'] as $item) {
				$item->num_fonts = $this->_getNumFonts($item->id);
			}
		}
		return $this->cache['items'];
	}

	public function getParent()
	{
		if (!is_object($this->_parent)) {
			$this->getItems();
		}

		return $this->_parent;
	}

	private function _getNumFonts($package_id) {
		$db = JFactory::getDbo();
		$query = "SELECT COUNT(*) FROM #__shop_font a WHERE package_id = " . $package_id;
		$db->setQuery($query);
		$num_fonts = $db->loadResult();
		return $num_fonts;
	}

}
