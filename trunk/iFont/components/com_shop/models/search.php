<?php
/**
 * @version		$Id: articles.php 21700 2011-06-28 04:32:41Z dextercowley $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * This models supports retrieving lists of articles.
 *
 * @package		Joomla.Site
 * @subpackage	com_content
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
				'id', 'a.package_id',
				'name', 'a.name',
				'alias', 'a.alias',
				'price', 'a.price',
				'packageid', 'a.package_id', 'category_title',
				'state', 'a.state',
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
	 * @return	void
	 * @since	1.6
	 */
	protected function populateState($ordering = 'ordering', $direction = 'ASC')
	{
		// Initialise variables.
		$app = JFactory::getApplication();
		$session = JFactory::getSession();

		// Adjust the context to support modal layouts.
		if ($layout = JRequest::getVar('layout')) {
			$this->context .= '.'.$layout;
		}

		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$access = $this->getUserStateFromRequest($this->context.'.filter.access', 'filter_access', 0, 'int');
		$this->setState('filter.access', $access);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		$packageId = $this->getUserStateFromRequest($this->context.'.filter.package_id', 'filter_package_id');
		$this->setState('filter.package_id', $packageId);

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
		$id .= ':'.$this->getState('filter.font_id');
		$id .= ':'.$this->getState('filter.font_id.include');
		$id .= ':'.$this->getState('filter.package_id');
		$id .= ':'.$this->getState('filter.package_id.include');
		$id .= ':'.$this->getState('filter.author_id');
		$id .= ':'.$this->getState('filter.author_id.include');
		$id .= ':'.$this->getState('filter.author_alias');
		$id .= ':'.$this->getState('filter.author_alias.include');
		$id .= ':'.$this->getState('filter.date_filtering');
		$id .= ':'.$this->getState('filter.date_field');
		$id .= ':'.$this->getState('filter.start_date_range');
		$id .= ':'.$this->getState('filter.end_date_range');
		$id .= ':'.$this->getState('filter.relative_date');

		return parent::getStoreId($id);
	}

	/**
	 * Get the master query for retrieving a list of fonts subject to the model state.
	 *
	 * @return	JDatabaseQuery
	 * @since	1.6
	 */
	function getListQuery()
	{
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.font_id as id, a.name, a.alias, a.price, a.package_id, a.created, a.created_by, ' .
				// use created if modified is 0
				'CASE WHEN a.modified = 0 THEN a.created ELSE a.modified END as modified, ' .
					'a.modified_by, uam.name as modified_by_name,' .
				'a.thumb, a.file_path '
			)
		);

		$query->from('#__shop_font AS a');

		// Join over the packages.
		$query->select('p.name AS package_title, p.alias AS package_alias');
		$query->join('LEFT', '#__shop_package AS p ON p.package_id = a.package_id');

		// Join over the users for the author and modified_by names.
		$query->select("CASE WHEN a.created_by_alias > ' ' THEN a.created_by_alias ELSE ua.name END AS author");
		$query->select("ua.email AS author_email");

		$query->join('LEFT', '#__users AS ua ON ua.id = a.created_by');
		$query->join('LEFT', '#__users AS uam ON uam.id = a.modified_by');

		// Filter by a single or group of fonts.
		$fontId = $this->getState('filter.font_id');

		if (is_numeric($fontId)) {
			$type = $this->getState('filter.font_id.include', true) ? '= ' : '<> ';
			$query->where('a.font_id '.$type.(int) $articleId);
		} else if (is_array($fontId)) {
			JArrayHelper::toInteger($fontId);
			$fontId = implode(',', $fontId);
			$type = $this->getState('filter.font_id.include', true) ? 'IN' : 'NOT IN';
			$query->where('a.font_id '.$type.' ('.$fontId.')');
		}

		// Filter by a single or group of packages
		$packageId = $this->getState('filter.package_id');

		if (is_numeric($packageId)) {
			$type = $this->getState('filter.package_id.include', true) ? '= ' : '<> ';

			$packageEquals = 'a.package_id '.$type.(int) $packageId;
			$query->where($packageEquals);
		} else if (is_array($packageId) && (count($packageId) > 0)) {
			JArrayHelper::toInteger($categoryId);
			$categoryId = implode(',', $packageId);
			if (!empty($categoryId)) {
				$type = $this->getState('filter.package_id.include', true) ? 'IN' : 'NOT IN';
				$query->where('a.package_id '.$type.' ('.$packageId.')');
			}
		}

		// Filter by author
		$authorId = $this->getState('filter.author_id');
		$authorWhere = '';

		if (is_numeric($authorId)) {
			$type = $this->getState('filter.author_id.include', true) ? '= ' : '<> ';
			$authorWhere = 'a.created_by '.$type.(int) $authorId;
		}
		else if (is_array($authorId)) {
			JArrayHelper::toInteger($authorId);
			$authorId = implode(',', $authorId);

			if ($authorId) {
				$type = $this->getState('filter.author_id.include', true) ? 'IN' : 'NOT IN';
				$authorWhere = 'a.created_by '.$type.' ('.$authorId.')';
			}
		}

		if (!empty($authorWhere) && !empty($authorAliasWhere)) {
			$query->where('('.$authorWhere.' OR '.$authorAliasWhere.')');
		}
		else if (empty($authorWhere) && empty($authorAliasWhere)) {
			// If both are empty we don't want to add to the query
		}
		else {
			// One of these is empty, the other is not so we just add both
			$query->where($authorWhere.$authorAliasWhere);
		}

		// Filter by start and end dates.
		$nullDate	= $db->Quote($db->getNullDate());
		$nowDate	= $db->Quote(JFactory::getDate()->toMySQL());

		// Filter by Date Range or Relative Date
		$dateFiltering = $this->getState('filter.date_filtering', 'off');
		$dateField = $this->getState('filter.date_field', 'a.created');

		switch ($dateFiltering)
		{
			case 'range':
				$startDateRange = $db->Quote($this->getState('filter.start_date_range', $nullDate));
				$endDateRange = $db->Quote($this->getState('filter.end_date_range', $nullDate));
				$query->where('('.$dateField.' >= '.$startDateRange.' AND '.$dateField .
					' <= '.$endDateRange.')');
				break;

			case 'relative':
				$relativeDate = (int) $this->getState('filter.relative_date', 0);
				$query->where($dateField.' >= DATE_SUB('.$nowDate.', INTERVAL ' .
					$relativeDate.' DAY)');
				break;

			case 'off':
			default:
				break;
		}

		// process the filter for list views with user-entered filters
		$params = $this->getState('params');

		if ((is_object($params)) && ($params->get('filter_field') != 'hide') && ($filter = $this->getState('list.filter'))) {
			// clean filter variable
			$filter = JString::strtolower($filter);
			$hitsFilter = intval($filter);
			$filter = $db->Quote('%'.$db->getEscaped($filter, true).'%', false);

			switch ($params->get('filter_field'))
			{
				case 'author':
					$query->where(
						'LOWER( CASE WHEN a.created_by_alias > '.$db->quote(' ').
						' THEN a.created_by_alias ELSE ua.name END ) LIKE '.$filter.' '
					);
					break;

				case 'name':
				default: // default to 'title' if parameter is not valid
					$query->where('LOWER( a.name ) LIKE '.$filter);
					break;
			}
		}

		// Add the list ordering clause.
		$query->order($this->getState('list.ordering', 'a.ordering').' '.$this->getState('list.direction', 'ASC'));

		return $query;
	}

	/**
	 * Method to get a list of fonts.
	 *
	 * Overriden to inject convert the attribs field into a JParameter object.
	 *
	 * @return	mixed	An array of objects on success, false on failure.
	 * @since	1.6
	 */
	public function getItems() {
		$items	= parent::getItems();
		$user	= JFactory::getUser();
		$userId	= $user->get('id');
		$guest	= $user->get('guest');
		$groups	= $user->getAuthorisedViewLevels();

		// Get the global params
		$globalParams = JComponentHelper::getParams('com_shop', true);

		require_once JPATH_COMPONENT . "/helpers/cart.php";
		foreach ($items as &$item) {
			$item->params = clone $this->getState('params');
			$item->params->set('access-view', true);

			if (ShopHelperCart::isFontAdded($item->id)) {
				$item->isFontAdded = true;
			} else {
				$item->isFontAdded = false;
			}
		}

		return $items;
	}

	public function getStart() {
		return $this->getState('list.start');
	}

}
