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
class ShopModelSearch extends JModelList {

	protected $_fonts = null;

	/**
	 * Model context string.
	 *
	 * @var		string
	 */
	protected $_context = 'com_shop.search';

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

		if ($this->_fonts === null) {
			$model = JModel::getInstance('Fonts', 'ShopModel', array('ignore_request' => true));
			$model->setState('params', JFactory::getApplication()->getParams());
			$model->setState('list.start', $this->getState('list.start'));
			$model->setState('list.limit', $limit);
			$model->setState('list.direction', $this->getState('list.direction'));
			$model->setState('list.filter', $this->getState('list.filter'));

			if ($limit >= 0) {
				$this->_fonts = $model->getItems();

				if ($this->_fonts === false) {
					$this->setError($model->getError());
				}
			} else {
				$this->_fonts=array();
			}

			$this->_pagination = $model->getPagination();
		}

		return $this->_fonts;
	}

	public function getFilterSearch() {
		$filterSearch = $this->getState('list.filter');
		if (empty($filterSearch)) {
			$filterSearch = JRequest::getString("filter-search");
		}
		return $filterSearch;
	}

	public function getPagination()
	{
		if (empty($this->_pagination)) {
			return null;
		}
		return $this->_pagination;
	}

}
