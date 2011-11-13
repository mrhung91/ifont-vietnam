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
<div class="heading">Liên hệ</div>
<div class="form_contact">
	<form id="contact-form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate">
		<div class="bg_white">
			<input name="jform[contact_name]" id="txtContactName" value="Tên" type="text" class="tf_contact" />
		</div>
		<div class="bg_white">
			<input name="jform[contact_email]" id="txtContactEmail" value="Địa chỉ thư" type="text" class="tf_contact" />
		</div>
		<div class="bg_white">
			<div class="mg_bot15px">
				<textarea name="jform[contact_message]" id="txtContactContent" class="ta_contact">Nội dung</textarea>
			</div>
			<div class="fix01 mg_bbot15px">
				<input type="button" class="btn_send" value="gửi" onclick="submitContact(this);" />
			</div>
		</div>

		<input type="hidden" name="option" value="com_contact" />
		<input type="hidden" name="task" value="contact.ajaxSubmit" />
		<input type="hidden" name="return" value="<?php echo JURI::current();?>" />
		<input type="hidden" name="id" value="<?php echo $contact_id; ?>" />
		<input type="hidden" name="jform[contact_subject]" value="Liên hệ" />
		<?php echo JHtml::_( 'form.token' ); ?>
	</form>
</div>

<script type="text/javascript">
$inputs = jQuery("#contact-form").find("input.tf_contact,textarea");
jQuery(document).ready(function() {
	$inputs.each(function() {
		this.defaultValue = jQuery(this).val();
		jQuery(this).focus(function() {
			if (this.defaultValue == jQuery(this).val()) {
				jQuery(this).val("");
			}
		}).blur(function() {
			if ("" == jQuery(this).val()) {
				jQuery(this).val(this.defaultValue);
			}
		});
	});
});
function submitContact(btSubmit) {
	btSubmit.disabled = true;

	jQuery("#contact-form").ajaxSubmit({
		beforeSubmit: function() {
			$inputs.each(function() {
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
			$inputs.val("");
		}
	});
}
</script>