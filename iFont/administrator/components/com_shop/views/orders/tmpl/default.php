<?php
/**
 * @version		$Id: default.php 21595 2011-06-21 02:51:29Z dextercowley $
 * @package		Joomla.Administrator
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

$canDo 		= ShopHelper::getActions();
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$loggeduser = JFactory::getUser();
?>

<form action="<?php echo JRoute::_('index.php?option=com_shop&view=orders');?>" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('COM_SHOP_SEARCH_USERS'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_SHOP_SEARCH_USERS'); ?>" />
			<button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_RESET'); ?></button>
		</div>
		<div class="filter-select fltrt">
			<label for="filter_state">
				<?php echo JText::_('COM_SHOP_FILTER_LABEL'); ?>
			</label>

			<select name="filter_state" class="inputbox" onchange="this.form.submit()">
				<option value="-1"><?php echo JText::_('COM_SHOP_FILTER_STATE');?></option>
				<?php echo JHtml::_('select.options', ShopHelper::getOrderStateOptions(), 'value', 'text', $this->state->get('filter.state'));?>
			</select>
		</div>
	</fieldset>
	<div class="clr"> </div>

	<table class="adminlist">
		<thead>
			<tr>
				<th width="1%">
					<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
				</th>
				<th class="left">
					<?php echo JHtml::_('grid.sort', 'User', 'a.author_name', $listDirn, $listOrder); ?>
				</th>
				<th class="left" width="10%">
					Edit
				</th>
				<th class="left" width="10%">
					<?php echo JHtml::_('grid.sort', 'Total', 'a.total', $listDirn, $listOrder); ?>
				</th>
				<th class="left" width="10%">
					<?php echo JHtml::_('grid.sort', 'Created Date', 'a.created', $listDirn, $listOrder); ?>
				</th>
				<th class="left" width="10%">
					<?php echo JHtml::_('grid.sort', 'Modified Date', 'a.modified', $listDirn, $listOrder); ?>
				</th>
				<th class="nowrap" width="5%">
					<?php echo JHtml::_('grid.sort', 'State', 'a.state', $listDirn, $listOrder); ?>
				</th>
				<th class="nowrap" width="3%">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="15">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item) :
			$canEdit	= $canDo->get('core.edit');
			$canChange	= $loggeduser->authorise('core.edit.state',	'com_shop');
		?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center">
					<?php if ($canEdit) : ?>
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					<?php endif; ?>
				</td>
				<td>
					<?php if ($canEdit) : ?>
					<a href="<?php echo JRoute::_('index.php?option=com_users&task=user.edit&id='.(int) $item->created_by); ?>" title="Edit User">
						<?php echo $this->escape($item->author_name); ?></a>
					<?php else : ?>
						<?php echo $this->escape($item->author_name); ?>
					<?php endif; ?>
				</td>
				<td>
					<?php if ($canEdit) : ?>
					<a href="<?php echo JRoute::_('index.php?option=com_shop&task=order.edit&id='.$item->id); ?>" title="Edit Order">
						Detail</a>
					<?php endif; ?>
				</td>
				<td>
					<?php echo number_format($item->total, 0, '', "."); ?> VNĐ</a>
				</td>
				<td>
					<?php echo $item->created; ?></a>
				</td>
				<td>
					<?php echo $item->modified; ?></a>
				</td>
				<td class="center">
					<?php if ($canChange) : ?>
						<?php echo JHtml::_('jgrid.state', ShopHelper::getJGridOrderStates(), $item->state, $i, 'orders.');?>
					<?php else : ?>
						<?php echo JText::_('COM_SHOP_STATUS_' . $item->state); ?>
					<?php endif; ?>
				</td>
				<td class="center">
					<?php echo (int) $item->id; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
