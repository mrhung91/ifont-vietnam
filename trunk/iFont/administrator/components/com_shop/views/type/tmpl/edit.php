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
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'user.cancel' || document.formvalidator.isValid(document.id('type-form'))) {
			Joomla.submitform(task, document.getElementById('type-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_shop&layout=edit&id='.(int) $this->item->id); ?>"
		method="post" name="adminForm" id="type-form" class="form-validate">
	<fieldset class="adminform">
		<legend><?php echo JText::_('COM_SHOP_FONT_DETAIL'); ?></legend>
		<ul class="adminformlist">
			<li><?php echo $this->form->getLabel('title'); ?>
			<?php echo $this->form->getInput('title'); ?></li>
		</ul>
		<div class="clr"></div>
		<?php echo $this->form->getLabel('description'); ?>
		<div class="clr"></div>
		<?php echo $this->form->getInput('description'); ?>
	</fieldset>

	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
