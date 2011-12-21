<?php
/**
 * @version		$Id: font.php 21700 2011-06-28 04:32:41Z dextercowley $
 * @package		Joomla.Site
 * @subpackage	com_shop
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.modelitem');

/**
 * Shop Component Font Model
 *
 * @package		Joomla.Site
 * @subpackage	com_shop
 * @since 1.5
 */
class ShopModelFont extends JModelItem
{
	/**
	 * Model context string.
	 *
	 * @var		string
	 */
	protected $_context = 'com_shop.font';

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState() {
		$app = JFactory::getApplication('site');

		// Load state from the request.
		$pk = JRequest::getInt('id');
		$this->setState('font.id', $pk);

		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);
	}

	/**
	 * Method to get font data.
	 *
	 * @param	integer	The id of the font.
	 *
	 * @return	mixed	Menu item data object on success, false on failure.
	 */
	public function &getItem($pk = null)
	{
		// Initialise variables.
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('font.id');

		if ($this->_item === null) {
			$this->_item = array();
		}

		if (!isset($this->_item[$pk])) {

			try {
				$db = $this->getDbo();
				$query = $db->getQuery(true);

				$query->select($this->getState(
					'item.select', 'a.font_id, a.name, a.alias, a.description, a.price, ' .
					'a.package_id, a.created, a.created_by, ' .
					'a.modified, a.modified_by, a.status, a.file_path, a.attribs'
					)
				);
				$query->from('#__shop_font AS a');

				// Join on category table.
				$query->select('p.name AS package_name, p.alias AS package_alias');
				$query->join('LEFT', '#__shop_package AS p on p.package_id = a.package_id');

				$query->where('a.font_id = ' . (int) $pk);

				$db->setQuery($query);

				$data = $db->loadObject();

				if ($error = $db->getErrorMsg()) {
					throw new Exception($error);
				}

				if (empty($data)) {
					return JError::raiseError(404,JText::_('COM_SHOP_ERROR_FONT_NOT_FOUND'));
				}

				// Convert parameter fields to objects.
				$registry = new JRegistry;
				$registry->loadString($data->attribs);
				$data->params = clone $this->getState('params');
				$data->params->merge($registry);

				// Compute view access permissions.
				$data->params->set('access-view', true);

				$this->_item[$pk] = $data;
			} catch (JException $e) {
				if ($e->getCode() == 404) {
					// Need to go thru the error handler to allow Redirect to work.
					JError::raiseError(404, $e->getMessage());
				} else {
					$this->setError($e);
					$this->_item[$pk] = false;
				}
			}
		}

		return $this->_item[$pk];
	}

}
