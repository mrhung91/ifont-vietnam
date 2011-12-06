<?php
/**
 * @version		$Id: article.php 21700 2011-06-28 04:32:41Z dextercowley $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.modelitem');

/**
 * Shop Component Order Model
 *
 * @package		Joomla.Site
 * @subpackage	com_shop
 * @since 1.5
 */
class ShopModelOrder extends JModelItem {

	const STATE_UNPUBLISHED = 0;
	const STATE_PENDING = 1;
	const STATE_DELIVERED = 2;
	const STATE_REJECTED = 3;
	const STATE_DELETED = 4;

	/**
	 * Model context string.
	 *
	 * @var		string
	 */
	protected $_context = 'com_shop.order';

	public function getTable($type = 'Order', $prefix = 'ShopTable', $config = array()) {
		$table = JTable::getInstance($type, $prefix, $config);
		return $table;
	}

	/**
	 * Method to get order data.
	 *
	 * @param	integer	The id of the article.
	 *
	 * @return	mixed	Menu item data object on success, false on failure.
	 */
	public function &getItem($pk = null) {
		// Initialise variables.
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('article.id');

		if ($this->_item === null) {
			$this->_item = array();
		}

		if (!isset($this->_item[$pk])) {

			try {
				$db = $this->getDbo();
				$query = $db->getQuery(true);

				$query->select($this->getState(
					'item.select', 'a.id, a.user_id, a.code, a.status' .
					'a.modified, a.modified_by, a.created, a.created_by'
				)
				);
				$query->from('#__shop_order AS a');
				$query->where('a.id = ' . (int) $pk);

				$db->setQuery($query);
				$data = $db->loadObject();

				if ($error = $db->getErrorMsg()) {
					throw new Exception($error);
				}

				if (empty($data)) {
					return JError::raiseError(404,JText::_('COM_SHOP_ERROR_ORDER_NOT_FOUND'));
				}

				// Check for published state if filter set.
				if (($data->state == $published)) {
					return JError::raiseError(404,JText::_('COM_SHOP_ERROR_ORDER_NOT_FOUND'));
				}

				// Convert parameter fields to objects.
				$registry = new JRegistry;
				$registry->loadString($data->attribs);
				$data->params = clone $this->getState('params');
				$data->params->merge($registry);

				$registry = new JRegistry;
				$registry->loadString($data->metadata);
				$data->metadata = $registry;

				// Compute selected asset permissions.
				$user	= JFactory::getUser();

				if (!$user->get('guest')) {
					$userId	= $user->get('id');
					$asset	= 'com_shop.order.'.$data->id;

					// Check general edit permission first.
					if ($user->authorise('core.edit', $asset)) {
						$data->params->set('access-edit', true);
					}
					// Now check if edit.own is available.
					else if (!empty($userId) && $user->authorise('core.edit.own', $asset)) {
						// Check for a valid user and that they are the owner.
						if ($userId == $data->created_by) {
							$data->params->set('access-edit', true);
						}
					}
				}

				// Compute view access permissions.
				if ($access = $this->getState('filter.access')) {
					// If the access filter has been set, we already know this user can view.
					$data->params->set('access-view', true);
				}
				else {
					// If no access filter is set, the layout takes some responsibility for display of limited information.
					$user = JFactory::getUser();
					$groups = $user->getAuthorisedViewLevels();

					if ($data->catid == 0 || $data->category_access === null) {
						$data->params->set('access-view', in_array($data->access, $groups));
					}
					else {
						$data->params->set('access-view', in_array($data->access, $groups) && in_array($data->category_access, $groups));
					}
				}

				$this->_item[$pk] = $data;
			}
			catch (JException $e)
			{
				if ($e->getCode() == 404) {
					// Need to go thru the error handler to allow Redirect to work.
					JError::raiseError(404, $e->getMessage());
				}
				else {
					$this->setError($e);
					$this->_item[$pk] = false;
				}
			}
		}

		return $this->_item[$pk];
	}

	public function save($data) {
		$user = JFactory::getUser();
		$date = JFactory::getDate();
		$pk = (!empty($data['id'])) ? $data['id'] : (int) $this->getState('order.id');
		if ($pk == 0) {
			$data['created_by'] = $user->get('id');
			$data['created'] = $date->toMySQL();
		}
		$table = JTable::getInstance("Order", "ShopTable");
		$isNew = true;

		// Allow an exception to be thrown.
		try {
			// Load the row if saving an existing record.
			if ($pk > 0) {
				$table->load($pk);
				$isNew = false;
			}

			// Bind the data.
			if (!$table->bind($data)) {
				$this->setError($table->getError());
				return false;
			}

			// Check the data.
			if (!$table->check()) {
				$this->setError($table->getError());
				return false;
			}

			// Store the data.
			if (!$table->store()) {
				$this->setError($table->getError());
				return false;
			}

			// Clean the cache.
			$this->cleanCache();
		} catch (Exception $e) {
			$this->setError($e->getMessage());

			return false;
		}

		$pkName = $table->getKeyName();

		if (isset($table->$pkName)) {
			$this->setState($this->getName().'.id', $table->$pkName);
		}
		$this->setState($this->getName().'.new', $isNew);

		return true;
	}

}
