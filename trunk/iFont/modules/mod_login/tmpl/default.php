<?php
/**
 * @version		$Id: default.php 21322 2011-05-11 01:10:29Z dextercowley $
 * @package		Joomla.Site
 * @subpackage	mod_login
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
require_once JPATH_SITE . '/components/com_shop/helpers/cart.php';
$cartInfo = ShopHelperCart::getShopCartInfo();
$num_fonts = isset($cartInfo['fonts']) ? count($cartInfo['fonts']) : 0;
$num_packages = isset($cartInfo['packages']) ? count($cartInfo['packages']) : 0;
$cartUrl = JRoute::_("index.php?option=com_shop&view=cart&Itemid=185");
?>
<?php if ($type == 'logout') : ?>
<div class="welcome">
	<div class="user-info clearfix">
		<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form">
		<?php if ($params->get('greeting')) : ?>
			<div class="login-greeting">
			<?php if($params->get('name') == 0) : {
				echo JText::sprintf('MOD_LOGIN_HINAME', $user->get('name'));
			} else : {
				echo JText::sprintf('MOD_LOGIN_HINAME', $user->get('username'));
			} endif; ?>
			</div>
		<?php endif; ?>
			<div class="logout-button">
				<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGOUT'); ?>" />
				<input type="hidden" name="option" value="com_users" />
				<input type="hidden" name="task" value="user.logout" />
				<input type="hidden" name="return" value="<?php echo $return; ?>" />
				<?php echo JHtml::_('form.token'); ?>
			</div>
		</form>
	</div>
	<div class="cart-info">
		<a href="<?php echo $cartUrl; ?>">Giỏ hàng</a>:&nbsp;
		<span id="lblNumCartFonts"><?php echo $num_fonts; ?></span> phông,
		<span id="lblNumCartPackages"><?php echo $num_packages; ?></span> gói phông
	</div>
</div>
<?php else : ?>
<div class="newletter">
	<a id="lnkLogin" class="dialog" href="#" rel="loginDlg">Đăng nhập</a>|<a
		  id="lnkRegister" class="dialog" href="#" rel="registerDlg">Đăng ký</a>
</div>
<?php endif; ?>