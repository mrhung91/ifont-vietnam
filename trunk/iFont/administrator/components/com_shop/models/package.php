<?php
/**
 * @version		$Id: user.php 21766 2011-07-08 12:20:23Z eddieajau $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

/**
 * User model.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_users
 * @since		1.6
 */
class ShopModelPackage extends JModelAdmin
{
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	$type	The table type to instantiate
	 * @param	string	$prefix	A prefix for the table class name. Optional.
	 * @param	array	$config	Configuration array for model. Optional.
	 *
	 * @return	JTable	A database object
	 * @since	1.6
	*/
	public function getTable($type = 'Package', $prefix = 'ShopTable', $config = array())
	{
		$table = JTable::getInstance($type, $prefix, $config);

		return $table;
	}

	/**
	 * Method to get a single record.
	 *
	 * @param	integer	$pk		The id of the primary key.
	 *
	 * @return	mixed	Object on success, false on failure.
	 * @since	1.6
	 */
	public function getItem($pk = null)
	{
		$result = parent::getItem($pk);
		return $result;
	}

	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Initialise variables.
		$app = JFactory::getApplication();

		// Get the form.
		$form = $this->loadForm('com_shop.package', 'package', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_shop.edit.package.data', array());

		if (empty($data)) {
			$data = $this->getItem();
			$this->_loadFontType($data);
		}
		return $data;
	}

	private function _loadFontType($data) {
		$db		= JFactory::getDBO();
		$query	= $db->getQuery(true);
		$query->select('spt.type_id');
		$query->from('#__shop_package_type spt');
		$query->where('spt.package_id='.$data->package_id);
		$db->setQuery($query);
		$result = $db->loadColumn(0);
		$data->types = $result;
	}

	/**
	 * Override JModelAdmin::preprocessForm to ensure the correct plugin group is loaded.
	 *
	 * @param	object	$form	A form object.
	 * @param	mixed	$data	The data expected for the form.
	 * @param	string	$group	The name of the plugin group to import (defaults to "content").
	 *
	 * @throws	Exception if there is an error in the form event.
	 * @since	1.6
	 */
	protected function preprocessForm(JForm $form, $data, $group = 'user')
	{
		parent::preprocessForm($form, $data, $group);
	}

	/**
	 * Method to save the form data.
	 *
	 * @param	array	$data	The form data.
	 *
	 * @return	boolean	True on success.
	 * @since	1.6
	 */
	public function save($data)
	{
		$user = JFactory::getUser();
		$pk = (!empty($data['package_id'])) ? $data['package_id'] : (int) $this->getState('package.id');
		if ($pk == 0) {
			$data['created_by'] = $user->id;
		}
		return parent::save($data);
	}

	/**
	 * Method to delete rows.
	 *
	 * @param	array	$pks	An array of item ids.
	 *
	 * @return	boolean	Returns true on success, false on failure.
	 * @since	1.6
	 */
	public function delete(&$pks)
	{
		// Initialise variables.
		$user	= JFactory::getUser();
		$table	= $this->getTable();
		$pks	= (array) $pks;

        // Check if I am a Super Admin
		$iAmSuperAdmin	= $user->authorise('core.admin');

		// Trigger the onUserBeforeSave event.
		JPluginHelper::importPlugin('user');
		$dispatcher = JDispatcher::getInstance();

		if (in_array($user->id, $pks)) {
			$this->setError(JText::_('COM_USERS_USERS_ERROR_CANNOT_DELETE_SELF'));
			return false;
		}

		// Iterate the items to delete each one.
		foreach ($pks as $i => $pk)
		{
			if ($table->load($pk)) {
				// Access checks.
				$allow = $user->authorise('core.delete', 'com_users');
				// Don't allow non-super-admin to delete a super admin
				$allow = (!$iAmSuperAdmin && JAccess::check($pk, 'core.admin')) ? false : $allow;

				if ($allow) {
					// Get users data for the users to delete.
					$user_to_delete = JFactory::getUser($pk);

					// Fire the onUserBeforeDelete event.
					$dispatcher->trigger('onUserBeforeDelete', array($table->getProperties()));

					if (!$table->delete($pk)) {
						$this->setError($table->getError());
						return false;
					} else {
						// Trigger the onUserAfterDelete event.
						$dispatcher->trigger('onUserAfterDelete', array($user_to_delete->getProperties(), true, $this->getError()));
					}
				}
				else {
					// Prune items that you can't change.
					unset($pks[$i]);
					JError::raiseWarning(403, JText::_('JERROR_CORE_DELETE_NOT_PERMITTED'));
				}
			}
			else {
				$this->setError($table->getError());
				return false;
			}
		}

		return true;
	}

	/**
	 * Gets the available groups.
	 *
	 * @return	array
	 * @since	1.6
	 */
	public function getPackages()
	{
		$user = JFactory::getUser();
		if ($user->authorise('core.edit', 'com_shop') && $user->authorise('core.manage', 'com_shop'))
		{
			$model = JModel::getInstance('Packages', 'ShopModel', array('ignore_request' => true));
			return $model->getItems();
		}
		else
		{
			return null;
		}
	}

}
