<?php
/**
 * @version		$Id: view.html.php 21367 2011-05-18 12:29:19Z chdemko $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * Content categories view.
 *
 * @package		Joomla.Site
 * @subpackage	com_content
 * @since 1.5
 */
class ShopViewPackages extends JView
{
	protected $state = null;
	protected $item = null;
	protected $items = null;
	protected $pagination;

	/**
	 * Display the view
	 *
	 * @return	mixed	False on error, null otherwise.
	 */
	function display($tpl = null)
	{
		// Initialise variables
		$state			= $this->get('State');
		$items			= $this->get('Items');
		$pagination 	= $this->get('Pagination');
		$filterOrder	= $this->get('FilterOrder');
		$filterType		= $this->get('FilterType');
		$types			= $this->get('Types');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}

		if ($items === false) {
			JError::raiseError(404, JText::_('Package not found'));
			return false;
		}

		$params = &$state->params;

		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));

		require_once JPATH_COMPONENT . "/helpers/cart.php";
		foreach ($items as &$item) {
			if (ShopHelperCart::isPackageAdded($item->id)) {
				$item->isPackageAdded = true;
			} else {
				$item->isPackageAdded = false;
			}
		}

		$this->assignRef('params',		$params);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination', $pagination);
		$this->assignRef('filterOrder',	$filterOrder);
		$this->assignRef('filterType',	$filterType);
		$this->assignRef('types',	$types);
		$this->assignRef('Itemid',	JRequest::getInt("Itemid"));

		$this->_prepareDocument();

		parent::display($tpl);
	}

	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		$app	= JFactory::getApplication();
		$menus	= $app->getMenu();
		$title	= null;

		// Because the application sets a default page title,
		// we need to get it from the menu item itself
		$menu = $menus->getActive();
		if ($menu) {
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		} else {
			$this->params->def('page_heading', JText::_('Packages'));
		}
		$title = $this->params->get('page_title', '');
		if (empty($title)) {
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}
		$this->document->setTitle($title);

		if ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}
	}

}
