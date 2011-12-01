<?php
/**
 * @version		$Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

setlocale(LC_MONETARY, 'en_US');
?>
<div class="search<?php echo $this->pageclass_sfx;?>">
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
		<div class="heading_bderbot">
			<h3 class="textright"><?php echo $this->escape($this->params->get('page_heading')); ?></h3>
		</div>
	<?php endif; ?>
	<div id="search_font">
		<div class="bg_gray">
			<div class="fl mg_left25px relative">
				<div class="bg_white">
					<input type="text" class="tf_01"
						onblur="if(this.value=='') {this.value='Nhập chữ để xem ví dụ'}"
						onfocus="if(this.value=='Nhập chữ để xem ví dụ') {this.value=''}"
						value="Nhập chữ để xem ví dụ" name="" id="txtSampleText" />
				</div>
				<span class="ajax-loading absolute hide"></span>
			</div>
		</div>
	</div>

	<div class="package-items">
	<?php foreach ($this->items as $index => $item): ?>
	<?php
		$this->item = $item;
		echo $this->loadTemplate('item');
	?>
	<?php endforeach; ?>
	</div>

	<?php // Add pagination links ?>
	<?php if (!empty($this->items)) : ?>
		<?php if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
		<div class="pagination">
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
		<?php endif; ?>
	<?php  endif; ?>
</div>

<form id="shopForm" method="post"
		action="<?php echo JRoute::_("index.php?option=com_shop&view=search&Itemid=" . $this->Itemid); ?>">
	<input type="hidden" name="option" value="com_shop" />
	<input type="hidden" name="view" value="search" />
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
	<input type="hidden" name="limitstart" id="txtFilterType" value="<?php echo $this->pagination->limitstart; ?>" />
	<input type="hidden" name="filter_order" id="txtFilterOrder" value="" />
	<input type="hidden" name="filter-search" id="txtFilterSearch" value="<?php echo $this->filterSearch; ?>" />
</form>

<script type="text/javascript">
$(document).ready(function() {
	$("#divSortFonts").mouseover(function() {
		showObject('#sortDropdown');
	})
	.mouseout(function() {
		hideObject('#sortDropdown');
	});

	$("input#txtSampleText").keyup(function() {
		onRenderSampleFontsText();
	});

	onRenderSampleFontsText("ABCDEFGHIJKLMNOPQRSTUVXYZW");

	$(".pagination").find("a").unbind("click").bind("click", function() {
		var limitstart = getQueryVariableValue(this.href, "limitstart");
		if (limitstart == null) {
			limitstart = 0;
		}
		$("#txtLimitStart").val(limitstart);
		$("#shopForm").submit();
	});
});
</script>
