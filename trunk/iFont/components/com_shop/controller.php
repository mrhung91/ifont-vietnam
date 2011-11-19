<?php
/**
 * @version		$Id: controller.php 20553 2011-02-06 06:32:09Z infograf768 $
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Base controller class for Shop.
 *
 * @package		Joomla.Site
 * @subpackage	com_shop
 * @since		1.5
 */
class ShopController extends JController
{
	/**
	 * Method to display a view.
	 *
	 * @param	boolean			If true, the view output will be cached
	 * @param	array			An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false) {
		$cachable = true;

		JHtml::_('behavior.caption');

		// Set the default view name and format from the Request.
		// Note we are using a_id to avoid collisions with the router and the return page.
		// Frontend is a bit messier than the backend.
		$id		= JRequest::getInt('a_id');
		$vName	= JRequest::getCmd('view', 'packages');
		JRequest::setVar('view', $vName);

		$safeurlparams = array('packageid'=>'INT','id'=>'INT','pid'=>'ARRAY','limit'=>'INT','limitstart'=>'INT',
			'showall'=>'INT','return'=>'BASE64','filter'=>'STRING','filter_order'=>'CMD','filter_order_Dir'=>'CMD','filter-search'=>'STRING','print'=>'BOOLEAN','lang'=>'CMD');

		// Check for edit form.
		if ($vName == 'form' && !$this->checkEditId('com_shop.edit.font', $id)) {
			// Somehow the person just went to the form - we don't allow that.
			return JError::raiseError(403, JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
		} else if ($vName == 'cart') {
			// If the user is a guest, redirect to the home page.
			$user = JFactory::getUser();
			if ($user->get('guest') == 1) {
				// Redirect to home page.
				$this->setRedirect(JRoute::_('index.php', false));
				return;
			}
		}

		parent::display($cachable, $safeurlparams);

		return $this;
	}
}