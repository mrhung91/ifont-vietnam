<?php
/**
 * @version		$Id: view.html.php 21655 2011-06-23 05:43:24Z chdemko $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * @package		Joomla.Administrator
 * @subpackage	com_users
 */
class ShopViewFont extends JView
{
	protected $form;
	protected $item;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->form			= $this->get('Form');
		$this->item			= $this->get('Item');
		$this->state		= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		parent::display($tpl);
		$this->addToolbar();
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', 1);

		$isNew		= ($this->item->font_id == 0);
		$canDo		= ShopHelper::getActions();

		$isNew	= ($this->item->font_id == 0);
		JToolBarHelper::title(JText::_($isNew ? 'COM_SHOP_VIEW_NEW_FONT_TITLE' : 'COM_SHOP_VIEW_EDIT_FONT_TITLE'));
		if ($canDo->get('core.edit')||$canDo->get('core.edit.own')||$canDo->get('core.create')) {
			JToolBarHelper::apply('font.apply');
			JToolBarHelper::save('font.save');
		}
		if ($canDo->get('core.create')&&$canDo->get('core.manage')) {
			JToolBarHelper::save2new('font.save2new');
		}
		if (empty($this->item->font_id))  {
			JToolBarHelper::cancel('font.cancel');
		} else {
			JToolBarHelper::cancel('font.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}
