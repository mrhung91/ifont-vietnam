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
 * Font types list controller class.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_shop
 * @since		1.6
 */
class ShopControllerTypes extends JControllerAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_SHOP_TYPES';

	/**
	 * Constructor.
	 *
	 * @param	array An optional associative array of configuration settings.
	 * @see		JController
	 * @since	1.6
	 */
	public function __construct($config = array()) {
		parent::__construct($config);
	}
	/**
	 * Proxy for getModel.
	 *
	 * @since	1.6
	 */
	public function getModel($name = 'Type', $prefix = 'ShopModel', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}

}