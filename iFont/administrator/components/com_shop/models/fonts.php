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
class ShopModelFonts extends JModelList
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
				'a.font_id', 'a.id',
				'name', 'a.name',
				'description', 'a.description',
				'price', 'a.price',
				'package_id', 'a.package_id',
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

		$packageId = $this->getUserStateFromRequest($this->context.'.filter.package', 'filter_package_id', null, 'int');
		$this->setState('filter.package_id', $packageId);

		$packages = json_decode(base64_decode(JRequest::getVar('packages', '', 'default', 'BASE64')));
		if (isset($groups)) {
			JArrayHelper::toInteger($packages);
		}
		$this->setState('filter.packages', $packages);

		$excluded = json_decode(base64_decode(JRequest::getVar('excluded', '', 'default', 'BASE64')));
		if (isset($excluded)) {
			JArrayHelper::toInteger($excluded);
		}
		$this->setState('filter.excluded', $excluded);

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
		$id	.= ':'.$this->getState('filter.package_id');

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
			$packages = $this->getState('filter.packages');
			$packageId = $this->getState('filter.package_id');
			if (isset($packages) && (empty($packages) || $packageId && !in_array($packageId, $packages))) {
				$items = array();
			} else {
				$items = parent::getItems();
			}

			// Bail out on an error or empty list.
			if (empty($items)) {
				$this->cache[$store] = $items;
				return $items;
			}

			// Joining the packages with the main query is a performance hog.
			// Find the information only on the result set.

			// First pass: get list of the font id's
			$fontIds = array();
			foreach ($items as $item) {
				$fontIds[] = (int) $item->font_id;
			}

			// Get the counts from the database only for the fonts in the list.
			$db		= $this->getDbo();
			$query	= $db->getQuery(true);

			// Join over the package mapping table.
			$query->select('sf.font_id as font_id, sp.name as package_name')
				->from('#__shop_font AS sf')
				->join('INNER', '#__shop_package AS sp ON sp.package_id = sf.package_id')
				->where('sf.font_id IN ('.implode(',', $fontIds).')');

			$db->setQuery($query);

			// Load the counts into an array indexed on the user id field.
			$fontPackage = $db->loadObjectList('font_id');

			$error = $db->getErrorMsg();
			if ($error) {
				$this->setError($error);
				return false;
			}

			// Second pass: collect the package counts into the master items array.
			foreach ($items as &$item) {
				if (isset($fontPackage[$item->font_id])) {
					$item->package_name = $fontPackage[$item->font_id]->package_name;
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
				'a.font_id, a.name, a.alias, a.price, a.package_id, a.status, a.thumb'
			)
		);
		$query->from('#__shop_font AS a');

		// Join over the packages for the linked user.
		$query->select('sp.name AS linked_package');
		$query->join('LEFT', '#__shop_package AS sp ON sp.package_id=a.package_id');

		// Filter by a single or group of packages.
		$packageId = $this->getState('filter.category_id');
		if (is_numeric($packageId)) {
			$query->where('a.package_id = '.(int) $packageId);
		} else if (is_array($packageId)) {
			JArrayHelper::toInteger($packageId);
			$packageId = implode(',', $packageId);
			$query->where('a.package_id IN ('.$packageId.')');
		}

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
