<?php
/**
 * version $Id: view.html.php 21484 2011-06-08 00:57:51Z dextercowley $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * HTML View class for the Content component
 *
 * @package		Joomla.Site
 * @subpackage	com_content
 * @since 1.5
 */
class ShopViewSearch extends JView
{
	protected $state;
	protected $items;
	protected $pagination;

	function display($tpl = null)
	{
		$app	= JFactory::getApplication();
		$user	= JFactory::getUser();

		// Get some data from the models
		$state			= $this->get('State');
		$params			= $state->params;
		$items			= $this->get('Items');
		$filterSearch	= $this->get('FilterSearch');
		$pagination = $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		// Compute the article slugs and prepare introtext (runs content plugins).
		foreach ($items as $item) {
			$item->slug = $item->alias ? ($item->id . ':' . $item->alias) : $item->id;
		}

		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));

		$this->assignRef('state', $state);
		$this->assignRef('items', $items);
		$this->assignRef('params', $params);
		$this->assignRef('pagination', $pagination);
		$this->assignRef('user', $user);
		$this->assignRef('Itemid',	JRequest::getInt('Itemid', 0));
		$this->assignRef('filterSearch',	$filterSearch);

		$this->_prepareDocument();

		parent::display($tpl);
	}

	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu();
		$pathway	= $app->getPathway();
		$title		= JText::_('COM_SHOP_SEARCH_FONTS');

		$this->params->def('page_heading', $title);
		$this->document->setTitle($title);
	}
}
