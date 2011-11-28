<?php
/**
 * @version		$Id: view.html.php 21705 2011-06-28 21:19:50Z dextercowley $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of font types.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_shop
 * @since		1.6
 */
class ShopViewTypes extends JView
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		$canDo	= ShopHelper::getActions();

		JToolBarHelper::title(JText::_('COM_SHOP_VIEW_TYPES_TITLE'));

		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew('type.add');
		}
		if ($canDo->get('core.edit')) {
			JToolBarHelper::editList('type.edit');
		}

		if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteList('', 'types.delete');
			JToolBarHelper::divider();
		}
	}
}
