<?php
/**
 * @version		$Id: users.php 20228 2011-01-10 00:52:54Z eddieajau $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * Orders list controller class.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_shop
 * @since		1.6
 */
class ShopControllerOrders extends JControllerAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_SHOP_ORDERS';

	/**
	 * Constructor.
	 *
	 * @param	array An optional associative array of configuration settings.
	 * @see		JController
	 * @since	1.6
	 */
	public function __construct($config = array()) {
		parent::__construct($config);

		$this->registerTask('unpublish',	'changeState');	// value = 0
		$this->registerTask('pending',		'changeState');	// value = 1
		$this->registerTask('deliver',		'changeState');	// value = 2
		$this->registerTask('reject',		'changeState');	// value = 3
		$this->registerTask('delete',		'changeState');	// value = 4
	}
	/**
	 * Proxy for getModel.
	 *
	 * @since	1.6
	 */
	public function getModel($name = 'Order', $prefix = 'ShopModel', $config = array('ignore_request' => true)) {
		return parent::getModel($name, $prefix, $config);
	}

	/**
	 * Method to changeState a list of taxa
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	function changeState() {
		// Check for request forgeries
		JRequest::checkToken() or die(JText::_('JINVALID_TOKEN'));

		$session	= JFactory::getSession();
		$registry	= $session->get('registry');

		// Get items to publish from the request.
		$cid	= JRequest::getVar('cid', array(), '', 'array');
		$data	= array('unpublish' => 0, 'pending'=> 1, 'deliver' => 2, 'reject'=> 3, 'delete' => 4);
		$task 	= $this->getTask();
		$value	= JArrayHelper::getValue($data, $task, 0, 'int');

		if (empty($cid)) {
			JError::raiseWarning(500, JText::_('COM_SHOP_NO_ITEM_SELECTED'));
		}
		else {
			// Get the model.
			$model = $this->getModel();

			// Make sure the item ids are integers
			JArrayHelper::toInteger($cid);

			// Publish the items.
			if (!$model->changeState($cid, $value)) {
				JError::raiseWarning(500, $model->getError());
			}
			else {
				if ($value == 0) {
					$ntext = 'COM_SHOP_N_ITEMS_UNPUBLISHED';
				} else if ($value == 1) {
					$ntext = 'COM_SHOP_N_ITEMS_PENDING';
				} else if ($value == 2) {
					$ntext = 'COM_SHOP_N_ITEMS_DELIVERED';
				} else if ($value == 3) {
					$ntext = 'COM_SHOP_N_ITEMS_REJECTED';
				} else {
					$ntext = 'COM_SHOP_N_ITEMS_DELETED';
				}
				$this->setMessage(JText::plural($ntext, count($cid)));
			}
		}
		$extension = JRequest::getCmd('extension');
		$extensionURL = ($extension) ? '&extension=' . JRequest::getCmd('extension') : '';
		$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_list.$extensionURL, false));
	}

}