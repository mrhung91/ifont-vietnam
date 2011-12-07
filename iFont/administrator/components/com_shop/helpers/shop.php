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

			JSubMenuHelper::addEntry(
				"Orders",
				'index.php?option=com_shop&view=orders',
				$vName == 'orders'
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
				'core.admin', 'core.manage', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
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

	static function getOrderStateOptions() {
		// Build the filter options.
		$options	= array();
		$options[]	= JHtml::_('select.option', '0', JText::_('JUNPUBLISHED'));
		$options[]	= JHtml::_('select.option', '1', JText::_('JPENDING'));
		$options[]	= JHtml::_('select.option', '2', JText::_('JDELIVERED'));
		$options[]	= JHtml::_('select.option', '3', JText::_('JREJECTED'));
		$options[]	= JHtml::_('select.option', '4', JText::_('JDELETED'));

		return $options;
	}

	static function getJGridOrderStates() {
		$states	= array(
			0	=> array('pending',		'JUNPUBLISHED',	'JLIB_HTML_PENDING_ITEM',	'JPUBLISHED',	false,	'unpublish',	'unpublish'),
			1	=> array('deliver',		'JPENDING',		'JLIB_HTML_DELIVER_ITEM',	'JUNPUBLISHED',	false,	'pending',		'pending'),
			2	=> array('reject',		'JDELIVERED',	'JLIB_HTML_REJECT_ITEM',	'JDELIVERED',	false,	'publish',		'publish'),
			3	=> array('delete',		'JREJECTED',	'JLIB_HTML_DELETE_ITEM',	'JREJECTED',	false,	'expired',		'expired'),
			4	=> array('unpublish',	'JDELETED',		'JLIB_HTML_UNPUBLISH_ITEM',	'JDELETED',		false,	'trash',		'trash'),
		);

		return $states;
	}

}