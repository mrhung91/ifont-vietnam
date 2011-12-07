<?php
/**
 * @version		$Id: users.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Administrator
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_shop')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');

require JPATH_COMPONENT_ADMINISTRATOR . DS . "constants.php";

// Include dependancies
jimport('joomla.application.component.controller');

// Execute the task.
$controller	= JController::getInstance('Shop', array('default_view' => 'packages'));
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
