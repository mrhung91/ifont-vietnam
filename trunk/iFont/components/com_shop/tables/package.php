<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Database
 *
 * @copyright   Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Users table
 *
 * @package     Joomla.Platform
 * @subpackage  Table
 * @since       11.1
 */
class JTablePackage extends JTable
{

	/**
	 * Contructor
	 *
	 * @param  database   A database connector object
	 *
	 * @return  JTableUser
	 *
	 * @since  11.1
	 */
	function __construct(&$db)
	{
		parent::__construct('#__shop_package', 'package_id', $db);

		// Initialise.
		$this->package_id = 0;
	}

	/**
	 * Method to load a package from the database so that it can be bound to the package object.
	 *
	 * @param   integer  $packageId  An optional package id.
	 * @param   boolean  $reset   False if row not found or on error
	 *                            (internal error state set in that case).
	 *
	 * @return  boolean  True on success, false on failure.
	 *
	 * @since   11.1
	 */
	function load($packageId = null, $reset = true)
	{
		// Get the id to load.
		if ($packageId !== null) {
			$this->package_id = $packageId;
		} else {
			$packageId = $this->package_id;
		}

		// Check for a valid id to load.
		if ($packageId === null) {
			return false;
		}

		// Reset the table.
		$this->reset();

		// Load the package data.
		$this->_db->setQuery(
			'SELECT *' .
			' FROM #__shop_package' .
			' WHERE package_id = '.(int) $packageId
		);
		$data = (array) $this->_db->loadAssoc();

		// Check for an error message.
		if ($this->_db->getErrorNum()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		if(!count($data))
		{
			return false;
		}
		// Bind the data to the table.
		$return = $this->bind($data);

		return $return;
	}

	/**
	 * Method to bind the user, user groups, and any other necessary data.
	 *
	 * @param   array    $array    The data to bind.
	 * @param   mixed    $ignore   An array or space separated list of fields to ignore.
	 *
	 * @return  boolean  True on success, false on failure.
	 *
	 * @since   11.1
	 */
	function bind($array, $ignore = '')
	{
		if (key_exists('params', $array) && is_array($array['params'])) {
			$registry = new JRegistry;
			$registry->loadArray($array['params']);
			$array['params'] = (string)$registry;
		}

		// Attempt to bind the data.
		$return = parent::bind($array, $ignore);

		return $return;
	}

	/**
	 * Validation and filtering
	 *
	 * @return  boolean  True is satisfactory
	 *
	 * @since   11.1
	 */
	function check()
	{
		jimport('joomla.mail.helper');

		// Validate package information
		if (trim($this->name) == '') {
			$this->setError(JText::_('JLIB_DATABASE_ERROR_PLEASE_ENTER_YOUR_NAME'));
			return false;
		}

		// Set alias
		$this->alias = JApplication::stringURLSafe($this->alias);
		if (empty($this->alias)) {
			$this->alias = JApplication::stringURLSafe($this->name);
		}

		// check for existing username
		$query = 'SELECT package_id'
			. ' FROM #__shop_package '
			. ' WHERE name = ' . $this->_db->Quote($this->name)
			. ' AND package_id != '. (int) $this->package_id;

		$this->_db->setQuery($query);
		$xid = intval($this->_db->loadResult());
		if ($xid && $xid != intval($this->package_id)) {
			$this->setError( JText::_('JLIB_DATABASE_ERROR_NAME_INUSE'));
			return false;
		}

		return true;
	}

	/**
	 * Method to store a row in the database from the JTable instance properties.
	 * If a primary key value is set the row with that primary key value will be
	 * updated with the instance property values.  If no primary key value is set
	 * a new row will be inserted into the database with the properties from the
	 * JTable instance.
	 *
	 * @param   boolean  $updateNulls  True to update fields even if they are null.
	 *
	 * @return  boolean  True on success.
	 *
	 * @link    http://docs.joomla.org/JTable/store
	 * @since   11.1
	 */
	function store($updateNulls = false)
	{
		// Get the table key and key value.
		$k = $this->_tbl_key;
		$key =  $this->$k;

		// TODO: This is a dumb way to handle the groups.
		// Store groups locally so as to not update directly.
		$groups = $this->groups;
		unset($this->groups);

		// Insert or update the object based on presence of a key value.
		if ($key) {
			// Already have a table key, update the row.
			$return = $this->_db->updateObject($this->_tbl, $this, $this->_tbl_key, $updateNulls);
		}
		else {
			// Don't have a table key, insert the row.
			$return = $this->_db->insertObject($this->_tbl, $this, $this->_tbl_key);
		}

		// Handle error if it exists.
		if (!$return)
		{
			$this->setError(JText::sprintf('JLIB_DATABASE_ERROR_STORE_FAILED', strtolower(get_class($this)), $this->_db->getErrorMsg()));
			return false;
		}

		// Reset groups to the local object.
		$this->groups = $groups;
		unset($groups);

		// Store the group data if the user data was saved.
		if ($return && is_array($this->groups) && count($this->groups))
		{
			// Delete the old user group maps.
			$this->_db->setQuery(
				'DELETE FROM '.$this->_db->quoteName('#__user_usergroup_map') .
				' WHERE '.$this->_db->quoteName('user_id').' = '.(int) $this->id
			);
			$this->_db->query();

			// Check for a database error.
			if ($this->_db->getErrorNum()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}

			// Set the new user group maps.
			$this->_db->setQuery(
				'INSERT INTO '.$this->_db->quoteName('#__user_usergroup_map').' ('.$this->_db->quoteName('user_id').', '.$this->_db->quoteName('group_id').')' .
				' VALUES ('.$this->id.', '.implode('), ('.$this->id.', ', $this->groups).')'
			);
			$this->_db->query();

			// Check for a database error.
			if ($this->_db->getErrorNum()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}

		return true;
	}

	/**
	 * Method to delete a user, user groups, and any other necessary
	 * data from the database.
	 *
	 * @param   integer  $userId   An optional user id.
	 *
	 * @return  boolean  True on success, false on failure.
	 *
	 * @since   11.1
	 */
	function delete($userId = null)
	{
		// Set the primary key to delete.
		$k = $this->_tbl_key;
		if ($userId) {
			$this->$k = intval($userId);
		}

		// Delete the user.
		$this->_db->setQuery(
			'DELETE FROM '.$this->_db->quoteName($this->_tbl).
			' WHERE '.$this->_db->quoteName($this->_tbl_key).' = '.(int) $this->$k
		);
		$this->_db->query();

		// Check for a database error.
		if ($this->_db->getErrorNum()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Delete the user group maps.
		$this->_db->setQuery(
			'DELETE FROM '.$this->_db->quoteName('#__user_usergroup_map') .
			' WHERE '.$this->_db->quoteName('user_id').' = '.(int) $this->$k
		);
		$this->_db->query();

		// Check for a database error.
		if ($this->_db->getErrorNum()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		/*
		 * Clean Up Related Data.
		 */

		$this->_db->setQuery(
			'DELETE FROM '.$this->_db->quoteName('#__messages_cfg') .
			' WHERE '.$this->_db->quoteName('user_id').' = '.(int) $this->$k
		);
		$this->_db->query();

		// Check for a database error.
		if ($this->_db->getErrorNum()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		$this->_db->setQuery(
			'DELETE FROM '.$this->_db->quoteName('#__messages') .
			' WHERE '.$this->_db->quoteName('user_id_to').' = '.(int) $this->$k
		);
		$this->_db->query();

		// Check for a database error.
		if ($this->_db->getErrorNum()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		return true;
	}

	/**
	 * Updates last visit time of user
	 *
	 * @param   integer  The timestamp, defaults to 'now'
	 *
	 * @return  boolean  False if an error occurs
	 *
	 * @since   11.1
	 */
	function setLastVisit($timeStamp = null, $userId = null)
	{
		// Check for User ID
		if (is_null($userId))
		{
			if (isset($this)) {
				$userId = $this->id;
			} else {
				// do not translate
				jexit(JText::_('JLIB_DATABASE_ERROR_SETLASTVISIT'));
			}
		}

		// If no timestamp value is passed to functon, than current time is used.
		$date = JFactory::getDate($timeStamp);

		// Update the database row for the user.
		$db = $this->_db;
		$query = $db->getQuery(true);
		$query->update($db->quoteName($this->_tbl));
		$query->set($db->quoteName('lastvisitDate') . '=' . $db->quote($date->format($db->getDateFormat())));
		$query->where($db->quoteName('id') . '=' . (int)$userId);
		$db->setQuery($query);
		$db->query();

		// Check for a database error.
		if ($db->getErrorNum()) {
			$this->setError($db->getErrorMsg());
			return false;
		}

		return true;
	}
}
