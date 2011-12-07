<?php
/**
 * @version		$Id: edit.php 21020 2011-03-27 06:52:01Z infograf768 $
 * @package		Joomla.Administrator
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
$canDo = ShopHelper::getActions();

// Get the form fieldsets.
$fieldsets = $this->form->getFieldsets();
$fonts = $this->item->fonts;
$packages = $this->item->packages;
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task == 'order.cancel' || document.formvalidator.isValid(document.id('user-form'))) {
			Joomla.submitform(task, document.getElementById('user-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_shop&layout=edit&id='.(int) $this->item->id); ?>"
		method="post" name="adminForm" id="user-form" class="form-validate">
	<fieldset class="adminform">
		<legend><?php echo JText::_('COM_SHOP_ORDER_DETAIL'); ?></legend>
		<ul class="adminformlist">
			<li><?php echo $this->form->getLabel('state'); ?>
			<?php echo $this->form->getInput('state'); ?></li>
			<li><label>Total</label><span><?php echo number_format($this->item->total, 0, '', "."); ?> VNĐ</span></li>
		</ul>
		<div class="clr"></div>
	</fieldset>

	<?php if (!empty($fonts)): ?>
	<fieldset class="adminform">
		<legend>Fonts</legend>
		<ul class="adminformlist">
			<?php foreach ($fonts as $font): ?>
			<li><a href="<?php echo JRoute::_("index.php?option=com_shop&task=font.edit&font_id=" . $font->font_id); ?>">
					<?php echo $font->font_name; ?></a><li>
			<?php endforeach; ?>
		</ul>
		<div class="clr"></div>
	</fieldset>
	<?php endif; ?>

	<?php if (!empty($packages)): ?>
	<fieldset class="adminform">
		<legend>Packages</legend>
		<ul class="adminformlist">
			<?php foreach ($packages as $package): ?>
			<li><a href="<?php echo JRoute::_("index.php?option=com_shop&task=package.edit&package_id=" . $package->package_id); ?>">
					<?php echo $package->package_name; ?></a><li>
			<?php endforeach; ?>
		</ul>
		<div class="clr"></div>
	</fieldset>
	<?php endif; ?>

	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
