<?php
/**
 * @version		$Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	mod_banners
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<form id="contact-form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate">
	<h3>LIÊN HỆ</h3>
	<input name="name" value="Tên" type="text" />
	<input name="email" value="Địa chỉ thư" type="text" />
	<textarea>Nội dung</textarea>
	<a class="button" href="#">&nbsp;</a>

	<input type="hidden" name="option" value="com_contact" />
	<input type="hidden" name="task" value="contact.submit" />
	<input type="hidden" name="return" value="<?php echo JURI::current();?>" />
	<input type="hidden" name="id" value="<?php echo $contact_id; ?>" />
	<?php echo JHtml::_( 'form.token' ); ?>
</form>