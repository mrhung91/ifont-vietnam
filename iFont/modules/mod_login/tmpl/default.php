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
?>
<?php if ($type == 'logout') : ?>
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
<?php else : ?>
<div class="boxlogin">
	<a href="<?php echo JRoute::_("index.php?option=com_users&view=login&Itemid=183"); ?>">Đăng nhập</a>
	<span>|</span>
	<a href="<?php echo JRoute::_("index.php?option=com_users&view=registration&Itemid=184"); ?>">Đăng ký</a></div>
<?php endif; ?>
