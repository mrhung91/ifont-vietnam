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
$doc			= JFactory::getDocument();
$doc->addScript($doc->baseurl.'/templates/site/javascript/jquery.form.js', 'text/javascript', true);
?>
<form id="contact-form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate">
	<h3>LIÊN HỆ</h3>
	<input name="jform[contact_name]" id="txtContactName" value="Tên" type="text" class="text" />
	<input name="jform[contact_email]" id="txtContactEmail" value="Địa chỉ thư" type="text" class="text" />
	<textarea name="jform[contact_message]" id="txtContactContent">Nội dung</textarea>
	<a class="button" href="javascript:;" onclick="submitContact(this);">&nbsp;</a>

	<input type="hidden" name="option" value="com_contact" />
	<input type="hidden" name="task" value="contact.ajaxSubmit" />
	<input type="hidden" name="return" value="<?php echo JURI::current();?>" />
	<input type="hidden" name="id" value="<?php echo $contact_id; ?>" />
	<input type="hidden" name="jform[contact_subject]" value="Liên hệ" />
	<?php echo JHtml::_( 'form.token' ); ?>
</form>

<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("#contact-form").find("input.text,textarea").each(function() {
		this.defaultValue = jQuery(this).val();
		jQuery(this).focus(function() {
			if (this.defaultValue == jQuery(this).val()) {
				jQuery(this).val("");
			}
		});
	});
});
function submitContact(btSubmit) {
	btSubmit.disabled = true;
	jQuery("#contact-form").ajaxSubmit({
		beforeSubmit: function() {
			jQuery("#contact-form").find("input.text,textarea").each(function() {
				jQuery(this).val(jQuery.trim(jQuery(this).val()));
			});
			var name = jQuery("#txtContactName").val();
			if (name == "" || name == "Tên") {
				alert("Vui lòng nhập tên của bạn");
				jQuery("#txtContactName").focus();
				return false;
			}
			var email = jQuery("#txtContactEmail").val();
			if (email == "" || email == "Địa chỉ thư") {
				alert("Vui lòng nhập địa chỉ thư của bạn");
				jQuery("#txtContactEmail").focus();
				return false;
			}
			var content = jQuery("#txtContactContent").val();
			if (content == "" || content == "Nội dung") {
				alert("Vui lòng nhập nội dung liên hệ");
				jQuery("#txtContactContent").focus();
				return false;
			}
			return true;
		},
		success: function() {
			btSubmit.disabled = false;
		}
	});
}
</script>