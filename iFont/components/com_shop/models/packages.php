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
class ShopModelPackages extends JModelList {

	const SORT_BY_DATE_NEWEST = 1;
	const SORT_BY_DATE_OLDEST = 2;

	public static $_SORT_CRITERIA = array(
		ShopModelPackages::SORT_BY_DATE_NEWEST => 'Mới nhất',
		ShopModelPackages::SORT_BY_DATE_OLDEST => 'Cũ nhất',
	);

	/**
	 * Model context string.
	 *
	 * @var		string
	 */
	public $_context = 'com_shop.packages';

	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'id', 'a.id',
					'title', 'a.title',
					'alias', 'a.alias',
					'package_id', 'a.package_id', 'package_title',
					'created', 'a.created',
					'created_by', 'a.created_by',
				);
			}

	parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState() {
		require_once JPATH_COMPONENT . "/helpers/package.php";
		$app = JFactory::getApplication();

		$value = JRequest::getUInt('limit', $app->getCfg('list_limit', 0));
		$this->setState('list.limit', $value);

		$value = JRequest::getUInt('limitstart', 0);
		$this->setState('list.start', $value);

		$this->_buildSort();

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
			. ' a.thumb, a.is_vietnamese, a.is_mac, a.is_windows, a.created'
		);
		$query->from('#__shop_package as a');
		$query->join('LEFT', '#__users AS u ON u.id = a.created_by');
		$query->select('u.name as user');
		$query->where('a.status=1');

		$query->order($this->getState('list.ordering', 'a.package_id').' '.$this->getState('list.direction', 'ASC'));

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

	public function getFilterOrder() {
		$filterOrder = $this->getState('list.filter_order');
		if ($filterOrder == null) {
			$filterOrder = ShopModelPackages::SORT_BY_DATE_NEWEST;
			$this->_buildSort();
		}
		$criteria = ShopModelPackages::$_SORT_CRITERIA;
		if (isset($criteria[$filterOrder])) {
			return $criteria[$filterOrder];
		}
		return $criteria[0];
	}

	private function _getNumFonts($package_id) {
		require_once JPATH_COMPONENT .'/helpers/package.php';
		return ShopHelperPackage::getNumFonts($package_id);
	}

	private function _buildSort() {
		$orderCol = null;
		$listOrder = null;

		$filterOrder	= JRequest::getInt('filter_order', 'a.package_id');
		switch ($filterOrder) {
			case ShopModelPackages::SORT_BY_DATE_OLDEST:
				$orderCol = "a.created";
				$listOrder = "ASC";
				break;

			case ShopModelPackages::SORT_BY_DATE_NEWEST:
			default:
				$orderCol = "a.created";
				$listOrder = "DESC";
				break;

		}
		$this->setState('list.filter_order', $filterOrder);
		$this->setState('list.ordering', $orderCol);
		$this->setState('list.direction', $listOrder);
	}

}
