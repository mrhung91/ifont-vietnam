<?php
/**
 * @version		$Id: view.html.php 21484 2011-06-08 00:57:51Z dextercowley $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * HTML Article View class for the Content component
 *
 * @package		Joomla.Site
 * @subpackage	com_content
 * @since		1.5
 */
class ShopViewFont extends JView
{
	protected $item;
	protected $params;
	protected $state;

	function display($tpl = null)
	{
		// Initialise variables.
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$dispatcher	= JDispatcher::getInstance();

		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');

		$this->_setFontThumbnails();

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));

			return false;
		}

		// Create a shortcut for $item.
		$item = &$this->item;
		require_once JPATH_COMPONENT . "/helpers/cart.php";
		if (ShopHelperCart::isFontAdded($item->font_id, $item->package_id)) {
			$item->isFontAdded = true;
		} else {
			$item->isFontAdded = false;
		}

		// Merge article params. If this is single-article view, menu params override article params
		// Otherwise, article params override menu item params
		$this->params	= $this->state->get('params');
		$active	= $app->getMenu()->getActive();
		$temp	= clone ($this->params);

		// Check to see which parameters should take priority
		if ($active) {
			$item->params->merge($temp);
		} else {
			// Merge so that font params take priority
			$temp->merge($item->params);
			$item->params = $temp;
		}

		// Check the view access to the article (the model has already computed the values).
		if ($item->params->get('access-view') != true && (($item->params->get('show_noauth') != true &&  $user->get('guest') ))) {
			JError::raiseWarning(403, JText::_('JERROR_ALERTNOAUTHOR'));
			return;
		}

		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($this->item->params->get('pageclass_sfx'));

		$this->_prepareDocument();

		parent::display($tpl);
	}

	/**
	 * Prepares the document
	 */
	protected function _prepareDocument() {
		$this->params->def('page_heading', $this->item->name);
		$title = $this->item->name;
		$this->document->setTitle($title);
	}

	/**
	 * Prepare thumbnails contain texts rendered by using this font
	 */
	protected function _setFontThumbnails() {
		$thumbnails = $this->item->params->get("thumbnails");
		if ($thumbnails == null) {
			$thumbnails = $this->_createFontThumbnails();
			$model = $this->getModel();
			//$model->updateAttribs($this->item, $thumbnails);
		}
		$this->item->thumbnails = $thumbnails;
	}

	protected function _createFontThumbnails() {
		$text = "Thuy Kieu la chi, em la Thuy Van";
		$thumbnailsInfo = array(
			array(144, 0, 0),
			array(72, 0, 0),
			array(48, 0, 0),
			array(36, 0, 0),
			array(24, 0, 0),
			array(18, 0, 0),
			array(14, 0, 0),
			array(12, 0, 0),
			array(10, 0, 0),
		);

		require_once JPATH_COMPONENT . "/helpers/font.php";
		$thumbnails = array();

		$file_path = $this->item->file_path;
		if (empty($file_path)) {
			return null;
		}

		$font_file = JPATH_SITE . DS . $file_path;
		if (!file_exists($font_file)) {
			return null;
		}

		foreach ($thumbnailsInfo as $info) {
			$fontSize = $info[0];
			$thumbUrl = ShopHelperFont::render($this->item->font_id, $font_file, $text, $fontSize);
			$item = array();
			$item["url"] = $thumbUrl;
			$item["size"] = $fontSize;
			$thumbnails[] = $item;
		}

		return $thumbnails;
	}

}
