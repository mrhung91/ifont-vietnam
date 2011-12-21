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
 * @subpackage	com_shop
 */
class ShopControllerCart extends JControllerForm {

	const ADMIN_EMAIL = 'vietdesign81@gmail.com';

	/**
	 * @since	1.6
	 */
	protected $view_item = 'form';

	/**
	 * @since	1.6
	 */
	protected $view_list = 'carts';

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
	public function &getModel($name = 'Cart', $prefix = 'ShopModel', $config = array())
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
		if ($fontMap == null || !isset($fontMap[$font_id])) {
			$fontMap[$font_id] = 1;
			$font = JTable::getInstance('Font', 'ShopTable');
			$font->load($font_id);

			$package = JTable::getInstance('Package', 'ShopTable');
			$package->load($font->package_id);

			ShopHelperCart::addFontToCart($font, $package);

			$this->_ajaxReturn("Phông được đưa vào giỏ hàng thành công");
		} else {
			$this->_ajaxReturn("Phông đã được đặt");
		}
	}

	public function ajaxRemoveFontFromCart() {
		$font_id = JRequest::getInt("font_id");
		if ($font_id == 0) {
			echo "Phông không hợp lệ";
			return null;
		}

		require_once JPATH_COMPONENT.'/helpers/cart.php';
		$result = ShopHelperCart::removeFontFromCart($font_id);
		if ($result) {
			$this->_ajaxReturn("Phông được xóa khỏi giỏ hàng thành công");
		}
		$this->_ajaxReturn("Phông không có trong giỏ hàng");
	}

	public function ajaxBuyPackage() {
		$package_id = JRequest::getInt("package_id");
		if ($package_id == 0) {
			echo "Phông không hợp lệ";
			return null;
		}

		require_once JPATH_COMPONENT.'/helpers/cart.php';
		$cartInfo = ShopHelperCart::getShopCartInfo();
		$packageMap = $cartInfo["packages"];
		if ($packageMap == null || !isset($packageMap[$package_id])) {
			$package = JTable::getInstance('Package', 'ShopTable');
			$package->load($package_id);
			ShopHelperCart::addPackageToCart($package);

			$this->_ajaxReturn("Gói phông được đưa vào giỏ hàng thành công.");
		} else {
			$this->_ajaxReturn("Gói phông đã được đặt.");
		}
	}

	public function ajaxRemovePackageFromCart() {
		$package_id = JRequest::getInt("package_id");
		if ($package_id == 0) {
			echo "Gói phông không hợp lệ";
			return null;
		}

		require_once JPATH_COMPONENT.'/helpers/cart.php';
		$result = ShopHelperCart::removePackageFromCart($package_id);
		if ($result) {
			$this->_ajaxReturn("Gói phông được xóa khỏi giỏ hàng thành công");
		}
		$this->_ajaxReturn("Gói phông không có trong giỏ hàng");
	}

	private function _ajaxReturn($message) {
		$cartInfo = ShopHelperCart::getShopCartInfo();
		$num_fonts = count($cartInfo["fonts"]);
		$num_packages = count($cartInfo["packages"]);
		$data = array("message" => $message, "num_fonts" => $num_fonts, "num_packages" => $num_packages);
		echo json_encode($data);
		JApplication::close();
	}

	public function checkout() {
		JRequest::checkToken('post') or jexit(JText::_('JInvalid_Token'));
		require JPATH_COMPONENT . '/helpers/cart.php';
		$cartInfo = ShopHelperCart::getShopCartInfo();

		$fonts = isset($cartInfo['fonts']) ? $cartInfo['fonts'] : null;
		$packages = isset($cartInfo['packages']) ? $cartInfo['packages'] : null;

		if (empty($fonts) && empty($packages)) {
			$this->setRedirect(JURI::base());
			return;
		}

		$total = 0;
		if (!empty($fonts)) {
			foreach ($fonts as $fontInfo) {
				$total += $fontInfo->price;
			}
		}
		if (!empty($packages)) {
			foreach ($packages as $packageInfo) {
				$total += $packageInfo->price;
			}
		}

		$user = JFactory::getUser();
		$orderModel = JModel::getInstance("Order", "ShopModel");
		$data = array(
			"code" => "",
			"state" => ShopModelOrder::STATE_PENDING,
			"fonts" => $fonts,
			"packages" => $packages,
			"total" => $total
		);

		$msg = null;
		if ($orderModel->save($data)) {
			$this->_sendOrderEmail($user, $fonts, $packages);
			// Comment to reserve cart's items after checking out successed
			// $this->_clearCart();
			$msg = "Gửi đơn hàng thành công.";
		} else {
			$msg = "Gửi đơn hàng thất bại";
		}
		$this->setMessage($msg, "checkout.result");
		$this->setRedirect(JRoute::_('index.php?option=com_shop&view=cart&layout=result&id='.JFactory::getUser()->id, false),
				$msg, "checkout-result");
		return false;
	}

	private function _clearCart() {
		ShopHelperCart::clearCart();
	}

	private function _sendOrderEmail($user, $fonts, $packages) {
		$app		= JFactory::getApplication();
		$mailfrom	= $app->getCfg('mailfrom');
		$fromname	= $app->getCfg('fromname');
		$sitename	= $app->getCfg('sitename');
		$subject	= $sitename . " - Đơn hàng mua phông";
		$body		= "Đơn hàng của " . $user->username . ":\n";

		$fontTotal	= 0;
		if (!empty($fonts)) {
			$index = 0;
			$body .= "\nCác phông đã đặt:\n";
			foreach ($fonts as $fontInfo) {
				$fontTotal += $fontInfo->price;
				$body .= ++$index . ". " . $fontInfo->name . "\n";
			}
			$body .= "Cộng: " . number_format($fontTotal, 0, '', ".") . " VNĐ\n";
		}

		$packageTotal	= 0;
		if (!empty($packages)) {
			$index = 0;
			$body .= "\nCác gói phông đã đặt:\n";
			foreach ($packages as $packageInfo) {
				$packageTotal += $packageInfo->price;
				$body .= ++$index . ". " . $packageInfo->name . "\n";
			}
			$body .= "Cộng: " . number_format($packageTotal, 0, '', ".") . " VNĐ\n";
		}

		$total = $fontTotal + $packageTotal;
		$body .= "\n\nTổng cộng: " . number_format($total, 0, '', ".") . " VNĐ";

		// send an email to admin
		$result = JUtility::sendMail($mailfrom, $fromname, ShopControllerCart::ADMIN_EMAIL, $subject, $body);
		// Check for an error.
		if ($result !== true) {
			$this->_sendErrorMessage($user->id, $user->email, "");
			return false;
		}

		// send an email to user
		$result = JUtility::sendMail($mailfrom, $fromname, $user->email, $subject, $body);
		// Check for an error.
		if ($result !== true) {
			$this->_sendErrorMessage($user->id, $user->email, "");
			return false;
		}

		return true;
	}

	private function _sendErrorMessage($userid, $username, $return) {
		$this->setError(JText::_('COM_SHOP_CHECKOUT_SEND_MAIL_FAILED'));

		// Send a system message to administrators receiving system mails
		$db = JFactory::getDBO();
		$q = "SELECT id FROM #__users WHERE block = 0 AND sendEmail = 1";
		$db->setQuery($q);
		$sendEmail = $db->loadResultArray();
		if (count($sendEmail) > 0) {
			$jdate = new JDate();
			// Build the query to add the messages
			$q = "INSERT INTO `#__messages` (`user_id_from`, `user_id_to`, `date_time`, `subject`, `message`)
									VALUES ";
			$messages = array();
			foreach ($sendEmail as $userid) {
				$messages[] = "(".$userid.", ".$userid.", '".$jdate->toMySQL()."', '".JText::_('COM_SHOP_MAIL_SEND_FAILURE_SUBJECT')."', '".JText::sprintf('COM_SHOP_MAIL_SEND_FAILURE_BODY', $return, $username)."')";
			}
			$q .= implode(',', $messages);
			$db->setQuery($q);
			$db->query();
		}
	}

}
