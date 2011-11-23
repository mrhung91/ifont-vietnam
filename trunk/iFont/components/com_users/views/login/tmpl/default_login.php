<?php
/**
 * @version		$Id: default_login.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.5
 */

defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
?>
<div class="login<?php echo $this->pageclass_sfx?>">


<?php if ($this->params->get('show_page_heading')) : ?>
	<h1>


	<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>




	<?php endif; ?>

	<?php if ($this->params->get('logindescription_show') == 1 || $this->params->get('login_image') != '') : ?>
	<div class="login-description">
	<?php endif ; ?>

		<?php if($this->params->get('logindescription_show') == 1) : ?>
			<?php echo $this->params->get('login_description'); ?>
		<?php endif; ?>

		<?php if (($this->params->get('login_image')!='')) :?>
			<img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo JTEXT::_('COM_USER_LOGIN_IMAGE_ALT')?>"/>
		<?php endif; ?>

	<?php if ($this->params->get('logindescription_show') == 1 || $this->params->get('login_image') != '') : ?>
	</div>
	<?php endif ; ?>
</div>


<div id="login" class="box_login">
	<h3>Đăng nhập</h3>
	<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post">
		<h5>Thông tin đăng nhập</h5>
		<ul>
			<li class="w195">Email đăng nhập</li>
			<li class="bg_tflogin"><input type="text" id="username"
				name="username" class="tf_login" />
			</li>
			<div class="clr hg10px"></div>
			<li class="w195">Mật khẩu</li>
			<li class="bg_tflogin"><input type="password" id="password"
				name="password" class="tf_login" />
			</li>
			<div class="clr hg20px"></div>
			<li class="button_login"><input type="submit" value="Đăng nhập"
				class="btn" />
			</li>
		</ul>
		<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('login_redirect_url',$this->form->getValue('return'))); ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
