<?php
/**
 * @version		$Id: controller.php 20196 2011-01-09 02:40:25Z ian $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Users master display controller.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_users
 * @since		1.6
 */
class ShopController extends JController
{
	/**
	 * Checks whether a user can see this view.
	 *
	 * @param	string	$view	The view name.
	 *
	 * @return	boolean
	 * @since	1.6
	 */
	protected function canView($view)
	{
		$canDo	= ShopHelper::getActions();

		switch ($view)
		{
			// Special permissions.
			case 'fonts':
			case 'font':
			case 'packages':
			case 'package':
			case 'types':
			case 'type':
				return $canDo->get('core.admin');
				break;

			// Default permissions.
			default:
				return true;
		}
	}

	/**
	 * Method to display a view.
	 *
	 * @param	boolean			If true, the view output will be cached
	 * @param	array			An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/shop.php';

		// Load the submenu.
		ShopHelper::addSubmenu(JRequest::getCmd('view', 'fonts'));

		$view		= JRequest::getCmd('view', 'fonts');
		$layout 	= JRequest::getCmd('layout', 'default');
		$id			= JRequest::getInt('id');

		if (!$this->canView($view)) {
			JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));

			return;
		}

		// Check for edit form.
		if ($view == 'font' && $layout == 'edit' && !$this->checkEditId('com_shop.edit.font', $id)) {
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_shop&view=fonts', false));

			return false;
		} else if ($view == 'package' && $layout == 'edit' && !$this->checkEditId('com_shop.edit.package', $id)) {
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_shop&view=packages', false));

			return false;
		}

		parent::display();
		return $this;
	}
}