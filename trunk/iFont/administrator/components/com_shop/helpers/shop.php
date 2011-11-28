<?php
/**
 * @version		$Id: shop.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Administrator
 * @subpackage	com_shop
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * Shop component helper.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_shop
 * @since		1.6
 */
class ShopHelper
{
	/**
	 * @var		JObject	A cache for the available actions.
	 * @since	1.6
	 */
	protected static $actions;

	/**
	 * Configure the Linkbar.
	 *
	 * @param	string	The name of the active view.
	 *
	 * @return	void
	 * @since	1.6
	 */
	public static function addSubmenu($vName)
	{

		// Groups and Levels are restricted to core.admin
		$canDo = self::getActions();

		if ($canDo->get('core.admin')) {
			JSubMenuHelper::addEntry(
				"Fonts",
				'index.php?option=com_shop&view=fonts',
				$vName == 'fonts'
			);

			JSubMenuHelper::addEntry(
				"Packages",
				'index.php?option=com_shop&view=packages',
				$vName == 'packages'
			);

			JSubMenuHelper::addEntry(
				"Types",
				'index.php?option=com_shop&view=types',
				$vName == 'types'
			);
		}
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		if (empty(self::$actions)) {
			$user	= JFactory::getUser();
			self::$actions	= new JObject;

			$actions = array(
				'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
			);

			foreach ($actions as $action) {
				self::$actions->set($action, $user->authorise($action, 'com_shop'));
			}
		}

		return self::$actions;
	}

	/**
	 * Get a list of filter options for the blocked state of a user.
	 *
	 * @return	array	An array of JHtmlOption elements.
	 * @since	1.6
	 */
	static function getStateOptions()
	{
		// Build the filter options.
		$options	= array();
		$options[]	= JHtml::_('select.option', '0', JText::_('JENABLED'));
		$options[]	= JHtml::_('select.option', '1', JText::_('JDISABLED'));

		return $options;
	}

	/**
	 * Get a list of the font packages for filtering.
	 *
	 * @return	array	An array of JHtmlOption elements.
	 * @since	1.6
	 */
	static function getPackages()
	{
		$db = JFactory::getDbo();
		$db->setQuery(
			'SELECT a.package_id AS value, a.name AS text' .
			' FROM #__shop_package AS a' .
			' ORDER BY a.name ASC'
		);
		$options = $db->loadObjectList();

		// Check for a database error.
		if ($db->getErrorNum()) {
			JError::raiseNotice(500, $db->getErrorMsg());
			return null;
		}

		foreach ($options as &$option) {
			$option->text = str_repeat('- ',$option->level).$option->text;
		}

		return $options;
	}
}