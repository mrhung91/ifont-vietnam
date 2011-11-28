<?php
/**
 * @version		$Id: users.php 21320 2011-05-11 01:01:37Z dextercowley $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of user records.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_users
 * @since		1.6
 */
class ShopModelTypes extends JModelList
{
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
				'a.id', 'title', 'a.title', 'description', 'a.description', 'a.ordering'
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return	void
	 * @since	1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Adjust the context to support modal layouts.
		if ($layout = JRequest::getVar('layout', 'default')) {
			$this->context .= '.'.$layout;
		}

		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$excluded = json_decode(base64_decode(JRequest::getVar('excluded', '', 'default', 'BASE64')));
		if (isset($excluded)) {
			JArrayHelper::toInteger($excluded);
		}
		$this->setState('filter.excluded', $excluded);

		// Load the parameters.
		$params		= JComponentHelper::getParams('com_shop');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.title', 'asc');
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
	 * @since	1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('filter.search');
		return parent::getStoreId($id);
	}

	/**
	 * Gets the list of fonts and adds expensive joins to the result set.
	 *
	 * @return	mixed	An array of data items on success, false on failure.
	 * @since	1.6
	 */
	public function getItems() {
		// Get a storage key.
		$store = $this->getStoreId();

		// Try to load the data from internal storage.
		if (empty($this->cache[$store])) {
			$items = parent::getItems();

			// Add the items to the internal cache.
			$this->cache[$store] = $items;
		}

		return $this->cache[$store];
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 * @since	1.6
	 */
	protected function getListQuery() {
		// Create a new query object
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$user = JFactory::getUser();

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.id, a.title, a.ordering'
			)
		);
		$query->from('#__shop_type AS a');

		// Filter by search in name.
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->getEscaped($search, true).'%');
				$query->where('a.title LIKE '.$search);
			}
		}

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		$query->order($db->getEscaped($orderCol.' '.$orderDirn));

		return $query;
	}

}
