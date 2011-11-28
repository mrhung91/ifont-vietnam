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
 * Font type model.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_users
 * @since		1.6
 */
class ShopModelType extends JModelAdmin {
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
	public function getTable($type = 'Type', $prefix = 'ShopTable', $config = array()) {
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
		$form = $this->loadForm('com_shop.type', 'type', array('control' => 'jform', 'load_data' => $loadData));
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
		$data = JFactory::getApplication()->getUserState('com_shop.edit.font.data', array());

		if (empty($data)) {
			$data = $this->getItem();
		}

		return $data;
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
	protected function preprocessForm(JForm $form, $data, $group = 'type')
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
	public function save($data) {
		$user = JFactory::getUser();
		$pk = (!empty($data['id'])) ? $data['id'] : (int) $this->getState('type.id');
		return parent::save($data);
	}

	/**
	 * Method to block user records.
	 *
	 * @param	array	$pks	The ids of the items to publish.
	 * @param	int		$value	The value of the published state
	 *
	 * @return	boolean	True on success.
	 * @since	1.6
	 */
	function block(&$pks, $value = 1) {
		return true;
	}

	/**
	 * Method to activate user records.
	 *
	 * @param	array	$pks	The ids of the items to activate.
	 *
	 * @return	boolean	True on success.
	 * @since	1.6
	 */
	function activate(&$pks) {
		return true;
	}

}
