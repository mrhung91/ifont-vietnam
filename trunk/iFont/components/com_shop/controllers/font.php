<?php
/**
 * @version		$Id: article.php 21321 2011-05-11 01:05:59Z dextercowley $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * @package		Joomla.Site
 * @subpackage	com_content
 */
class ShopControllerFont extends JControllerForm
{
	/**
	 * @since	1.6
	 */
	protected $view_item = 'form';

	/**
	 * @since	1.6
	 */
	protected $view_list = 'packages';

	/**
	 * Method to add a new record.
	 *
	 * @return	boolean	True if the article can be added, false if not.
	 * @since	1.6
	 */
	public function add()
	{
		if (!parent::add()) {
			// Redirect to the return page.
			$this->setRedirect($this->getReturnPage());
		}
	}

	/**
	 * Method override to check if you can add a new record.
	 *
	 * @param	array	An array of input data.
	 *
	 * @return	boolean
	 * @since	1.6
	 */
	protected function allowAdd($data = array())
	{
		// Initialise variables.
		$user		= JFactory::getUser();
		$packageId	= JArrayHelper::getValue($data, 'packageid', JRequest::getInt('packageid'), 'int');
		$allow		= null;

		if ($packageId) {
			// If the category has been passed in the data or URL check it.
			$allow	= $user->authorise('core.create', 'com_shop.package.'.$packageId);
		}

		if ($allow === null) {
			// In the absense of better information, revert to the component permissions.
			return parent::allowAdd();
		}
		else {
			return $allow;
		}
	}

	/**
	 * Method override to check if you can edit an existing record.
	 *
	 * @param	array	$data	An array of input data.
	 * @param	string	$key	The name of the key for the primary key.
	 *
	 * @return	boolean
	 * @since	1.6
	 */
	protected function allowEdit($data = array(), $key = 'id')
	{
		// Initialise variables.
		$recordId	= (int) isset($data[$key]) ? $data[$key] : 0;
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$asset		= 'com_package.font.'.$recordId;

		// Check general edit permission first.
		if ($user->authorise('core.edit', $asset)) {
			return true;
		}

		// Fallback on edit.own.
		// First test if the permission is available.
		if ($user->authorise('core.edit.own', $asset)) {
			// Now test the owner is the user.
			$ownerId	= (int) isset($data['created_by']) ? $data['created_by'] : 0;
			if (empty($ownerId) && $recordId) {
				// Need to do a lookup from the model.
				$record		= $this->getModel()->getItem($recordId);

				if (empty($record)) {
					return false;
				}

				$ownerId = $record->created_by;
			}

			// If the owner matches 'me' then do the test.
			if ($ownerId == $userId) {
				return true;
			}
		}

		// Since there is no asset tracking, revert to the component permissions.
		return parent::allowEdit($data, $key);
	}

	/**
	 * Method to cancel an edit.
	 *
	 * @param	string	$key	The name of the primary key of the URL variable.
	 *
	 * @return	Boolean	True if access level checks pass, false otherwise.
	 * @since	1.6
	 */
	public function cancel($key = 'a_id')
	{
		parent::cancel($key);

		// Redirect to the return page.
		$this->setRedirect($this->getReturnPage());
	}

	/**
	 * Method to edit an existing record.
	 *
	 * @param	string	$key	The name of the primary key of the URL variable.
	 * @param	string	$urlVar	The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	 *
	 * @return	Boolean	True if access level check and checkout passes, false otherwise.
	 * @since	1.6
	 */
	public function edit($key = null, $urlVar = 'a_id')
	{
		$result = parent::edit($key, $urlVar);

		return $result;
	}

	/**
	 * Method to get a model object, loading it if required.
	 *
	 * @param	string	$name	The model name. Optional.
	 * @param	string	$prefix	The class prefix. Optional.
	 * @param	array	$config	Configuration array for model. Optional.
	 *
	 * @return	object	The model.
	 * @since	1.5
	 */
	public function &getModel($name = 'form', $prefix = '', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}

	public function ajaxBuyFont() {
		$font_id = JRequest::getInt("font_id");
		if ($font_id == 0) {
			echo "Phông không hợp lệ";
			return null;
		}

		require_once JPATH_COMPONENT.'/helpers/cart.php';
		$cartInfo = ShopHelperCart::getShopCartInfo();
		$fontMap = $cartInfo["fonts"];
		if ($fontMap == null) {
			$fontMap = array();
		}
		if (!isset($fontMap[$font_id])) {
			$fontMap[$font_id] = 1;
			$font = JTable::getInstance('Font', 'ShopTable');
			$font->load($font_id);
			ShopHelperCart::addFontToCart($font);

			$this->_ajaxReturn("Phông được đặt thành công");
		} else {
			$this->_ajaxReturn("Phông đã được đặt");
		}
	}

	function ajaxRenderSample() {
		$fontIdsStr = JRequest::getString("fontIds");
		if ($fontIdsStr == "") {
			return null;
		}

		require JPATH_COMPONENT . DS . "helpers" . DS . "font.php";
		$text = JRequest::getString("text");
		$thumbs = array();
		$fontIds = explode(",", $fontIdsStr);
		$fontTbl = JTable::getInstance("Font", "ShopTable");
		foreach ($fontIds as $fontId) {
			$fontId = intval($fontId);
			if ($fontId == 0) {
				continue;
			}

			if ($fontTbl->load($fontId)) {
				$file_path = $fontTbl->file_path;
				if (empty($file_path)) {
					continue;
				}

				$font_file = JPATH_SITE . DS . $file_path;
				if (!file_exists($font_file)) {
					continue;
				}

				$thumbUrl = JURI::base() . ShopHelperFont::render($fontId, $font_file, $text);
				if (!empty($thumbUrl)) {
					$thumbs[$fontId] = $thumbUrl;
				}
			}
		}

		echo json_encode($thumbs);
		JApplication::close();
	}

	private function _ajaxReturn($code) {
		echo $code;
		JApplication::close();
	}

}
