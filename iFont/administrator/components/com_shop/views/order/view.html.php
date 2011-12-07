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
 * @subpackage	com_shop
 */
class ShopViewOrder extends JView
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

		$layout = JRequest::getCmd("layout");
		if ($layout == "edit") {
			$this->_setReferenceData();
		}

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		parent::display($tpl);
		$this->addToolbar();
	}

	protected function _setReferenceData() {
		$item = $this->item;
		if ($item !== false) {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select("a.id")->from("#__shop_order_item AS a")
				->where("a.order_id = " . $item->id)
				->select("f.font_id AS font_id, f.name AS font_name")
				->join('LEFT', '#__shop_font AS f ON f.font_id = a.font_id')
				->select("p.package_id AS package_id, p.name AS package_name")
				->join('LEFT', '#__shop_package AS p ON p.package_id = a.package_id');
			$db->setQuery($query);
			$rows = $db->loadObjectList();
			$item->fonts = array();
			$item->packages = array();
			if (!empty($rows)) {
				foreach ($rows AS $row) {
					if ($row->font_id != null) {
						$item->fonts[] = $row;
					} else if ($row->package_id != null) {
						$item->packages[] = $row;
					}
				}
			}
		}
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar() {
		JRequest::setVar('hidemainmenu', 1);
		$canDo		= ShopHelper::getActions();

		JToolBarHelper::title(JText::_('COM_SHOP_VIEW_EDIT_ORDER_TITLE'));
		if ($canDo->get('core.edit')||$canDo->get('core.edit.own')||$canDo->get('core.create')) {
			JToolBarHelper::apply('order.apply');
			JToolBarHelper::save('order.save');
		}
		if (empty($this->item->id))  {
			JToolBarHelper::cancel('order.cancel');
		} else {
			JToolBarHelper::cancel('order.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}
