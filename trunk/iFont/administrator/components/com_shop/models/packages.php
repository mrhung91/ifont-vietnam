<?php
/**
 * @version		$Id: users.php 21320 2011-05-11 01:01:37Z dextercowley $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of package records.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_users
 * @since		1.6
 */
class ShopModelPackages extends JModelList
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
				'a.package_id', 'a.id',
				'name', 'a.name',
				'description', 'a.description',
				'a.created', 'a.created',
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

		// Load the parameters.
		$params		= JComponentHelper::getParams('com_shop');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.name', 'asc');
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

			// Bail out on an error or empty list.
			if (empty($items)) {
				$this->cache[$store] = $items;
				return $items;
			}

			// First pass: get list of the font id's
			$packageIds = array();
			foreach ($items as $item) {
				$packageIds[] = (int) $item->package_id;
			}

			// Get the counts from the database only for the users in the list.
			$db		= $this->getDbo();
			$query	= $db->getQuery(true);

			// Join over the group mapping table.
			$query->select('sf.package_id, COUNT(DISTINCT sf.font_id) as font_count')
				->from('#__shop_font AS sf')
				->where('sf.package_id IN ('.implode(',', $packageIds).')')
				->group('sf.package_id');

			$db->setQuery($query);

			// Load the counts into an array indexed on the user id field.
			$packages = $db->loadRow('package_id');

			$error = $db->getErrorMsg();
			if ($error) {
				$this->setError($error);
				return false;
			}

			// Second pass: collect the group counts into the master items array.
			foreach ($items as &$item)
			{
				if (isset($packages[$item->package_id])) {
					$item->font_count = $fontPackage[$item->package_id]->font_count;
				}
			}

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
				'a.package_id, a.name, a.alias, a.status, a.thumb, a.is_vietnamese, a.is_mac, a.is_windows'
			)
		);
		$query->from('#__shop_package AS a');

		// Filter by search in name.
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->getEscaped($search, true).'%');
				$query->where('(a.name LIKE '.$search.' OR a.alias LIKE '.$search.')');
			}
		}

		return $query;
	}

}
