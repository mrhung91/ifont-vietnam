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
class ShopModelPackage extends JModelList {

	const SORT_BY_DATE_NEWEST = 1;
	const SORT_BY_DATE_OLDEST = 2;

	public static $_SORT_CRITERIA = array(
		ShopModelPackage::SORT_BY_DATE_NEWEST => 'Mới nhất',
		ShopModelPackage::SORT_BY_DATE_OLDEST => 'Cũ nhất',
	);

	/**
	 * Category items data
	 *
	 * @var array
	 */
	protected $_item = null;

	protected $_fonts = null;

	/**
	 * Model context string.
	 *
	 * @var		string
	 */
	protected $_context = 'com_shop.package';

	/**
	 * The package that applies.
	 *
	 * @access	protected
	 * @var		object
	 */
	protected $_package = null;

	/**
	 * Constructor.
	 *
	 * @param	array	An optional associative array of configuration settings.
	 * @see		JController
	 * @since	1.6
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.package_id',
				'title', 'a.title',
				'alias', 'a.alias',
				'status', 'a.status',
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
	 * return	void
	 * @since	1.6
	 */
	protected function populateState($ordering = null, $direction = null) {
		// Initiliase variables.
		$app	= JFactory::getApplication('site');
		$pk		= JRequest::getInt('id');
		$itemid = JRequest::getInt('id', 0) . ':' . JRequest::getInt('Itemid', 0);

		$this->setState('package.id', $pk);

		// Load the parameters. Merge Global and Menu Item params into new object
		$params = $app->getParams();
		$menuParams = new JRegistry;

		if ($menu = $app->getMenu()->getActive()) {
			$menuParams->loadString($menu->params);
		}

		$mergedParams = clone $menuParams;
		$mergedParams->merge($params);

		$this->setState('params', $mergedParams);
		$user		= JFactory::getUser();
		// Create a new query object.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$groups	= implode(',', $user->getAuthorisedViewLevels());

		if ((!$user->authorise('core.edit.state', 'com_shop')) &&  (!$user->authorise('core.edit', 'com_shop'))){
			// limit to published for people who can't edit or edit.state.
			$this->setState('filter.published', 1);
		}

		// process show_noauth parameter
		if (!$params->get('show_noauth')) {
			$this->setState('filter.access', true);
		}
		else {
			$this->setState('filter.access', false);
		}

		// Optional filter text
		$this->setState('list.filter', JRequest::getString('filter-search'));

		// filter.order
		$this->_buildSort();

		$this->setState('list.start', JRequest::getVar('limitstart', 0, '', 'int'));

		$limit = $app->getUserStateFromRequest('com_shop.package.list.' . $itemid . '.limit', 'limit', $params->get('display_num'));

		$this->setState('list.limit', $limit);

	}

	/**
	 * Get the articles in the category
	 *
	 * @return	mixed	An array of articles or false if an error occurs.
	 * @since	1.5
	 */
	function getItems()
	{
		$params = $this->getState()->get('params');
		$limit = $this->getState('list.limit');

		if ($this->_fonts === null && $package = $this->getPackage()) {
			$model = JModel::getInstance('Fonts', 'ShopModel', array('ignore_request' => true));
			$model->setState('params', JFactory::getApplication()->getParams());
			$model->setState('filter.package_id', $package->package_id);
			$model->setState('list.ordering', $this->_buildSort());
			$model->setState('list.start', $this->getState('list.start'));
			$model->setState('list.limit', $limit);
			$model->setState('list.direction', $this->getState('list.direction'));
			$model->setState('list.filter', $this->getState('list.filter'));

			if ($limit >= 0) {
				$this->_fonts = $model->getItems();

				if ($this->_fonts === false) {
					$this->setError($model->getError());
				}
			}
			else {
				$this->_fonts=array();
			}

			$this->_pagination = $model->getPagination();
		}

		return $this->_fonts;
	}

	public function getPagination()
	{
		if (empty($this->_pagination)) {
			return null;
		}
		return $this->_pagination;
	}

	/**
	 * Method to get package data for the current package
	 *
	 * @param	int		An optional ID
	 *
	 * @return	object
	 * @since	1.5
	 */
	public function getPackage()
	{
		if (!is_object($this->_item)) {
			if( isset( $this->state->params ) ) {
				$params = $this->state->params;
				$options = array();
			}

			$package = JTable::getInstance('Package', 'ShopTable');
			$package->load($this->getState('package.id', 'root'));
			$package->params = clone $this->getState('params');;
			$package->params->set('access-view', true);

			$this->_item = $package;
		}

		return $this->_item;
	}

	public function getPackageFonts($package_id) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->from('#__shop_font AS a')
			->where('a.package_id=' . $package_id);
		$result = $this->_db->loadObjectList();
		return $result;
	}

	public function getLatestPackageFont($package_id) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->from('#__shop_font AS a')
			->select('a.font_id as id, a.name, a.alias, a.price, a.package_id, a.created, a.created_by, ' .
						'a.thumb, a.file_path')
			->where('a.package_id=' . $package_id)
			->order('a.font_id DESC');
		$this->_db->setQuery($query, 0, 1);
		$result = $this->_db->loadObject();
		return $result;
	}

	public function getFilterOrder() {
		$filterOrder = $this->getState('list.filter_order');
		if ($filterOrder == null) {
			$filterOrder = ShopModelPackage::SORT_BY_DATE_NEWEST;
			$this->_buildSort();
		}
		$criteria = ShopModelPackage::$_SORT_CRITERIA;
		if (isset($criteria[$filterOrder])) {
			return $criteria[$filterOrder];
		}
		return $criteria[0];
	}

	/**
	 * Build the orderby for the query
	 *
	 * @return	string	$orderby portion of query
	 * @since	1.5
	 */
	protected function _buildShopOrderBy() {
		$app		= JFactory::getApplication('site');
		$db			= $this->getDbo();
		$params		= $this->state->params;
		$itemid		= JRequest::getInt('id', 0) . ':' . JRequest::getInt('Itemid', 0);
		$orderCol	= $app->getUserStateFromRequest('com_shop.package.list.' . $itemid . '.filter_order', 'filter_order', '', 'string');
		$orderDirn	= $app->getUserStateFromRequest('com_shop.package.list.' . $itemid . '.filter_order_Dir', 'filter_order_Dir', '', 'cmd');
		$orderby	= ' ';

		if (!in_array($orderCol, $this->filter_fields)) {
			$orderCol = null;
		}

		if (!in_array(strtoupper($orderDirn), array('ASC', 'DESC', ''))) {
			$orderDirn = 'ASC';
		}

		if ($orderCol && $orderDirn) {
			$orderby .= $db->getEscaped($orderCol) . ' ' . $db->getEscaped($orderDirn) . ', ';
		}

		$orderby .= ' a.created ';

		return $orderby;
	}

	private function _buildSort() {
		$db			= $this->getDbo();

		$orderCol = null;
		$listOrder = null;

		$filterOrder	= JRequest::getInt('filter_order', 'a.package_id');
		switch ($filterOrder) {
			case ShopModelPackage::SORT_BY_DATE_OLDEST:
				$orderCol = "a.created";
				$listOrder = "ASC";
				break;

			case ShopModelPackage::SORT_BY_DATE_NEWEST:
			default:
				$orderCol = "a.created";
				$listOrder = "DESC";
				break;

		}
		$this->setState('list.filter_order', $filterOrder);
		$this->setState('list.ordering', $orderCol);
		$this->setState('list.direction', $listOrder);

		if ($orderCol && $listOrder) {
			$orderby = $db->getEscaped($orderCol);
		}
		return $orderby;
	}


}
