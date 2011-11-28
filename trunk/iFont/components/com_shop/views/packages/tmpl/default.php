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
?>
<div class="categories-list<?php echo $this->pageclass_sfx;?>">
<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<div class="heading_bderbot">
		<h3 class="textright"><?php echo $this->escape($this->params->get('page_heading')); ?></h3>
	</div>
<?php endif; ?>
	<div id="search_font">
		<div class="bg_gray">
			<form method="get" action="">
				<div class="fl mg_left25px relative">
					<div class="bg_white">
						<input type="text" class="tf_01"
							onblur="if(this.value=='') {this.value='Nhập chữ để xem ví dụ'}"
							onfocus="if(this.value=='Nhập chữ để xem ví dụ') {this.value=''}"
							value="Nhập chữ để xem ví dụ" name="" id="txtSamplePackageText" />
					</div>
					<span class="ajax-loading absolute hide"></span>
				</div>
				<div class="fl mg_left25px">
					<div class="txt fl">Sắp xếp</div>
					<div class="bg_white fl sort" id="divSortPackages">
						<a href="javascript:;" class="sort-text" id="lnkSortPackages"><?php echo $this->filterOrder->text; ?></a>
						<span class="sort-dropdown hide" id="sortDropdown">
							<ul>
								<li><a href="javascript:;" onclick="onSortPackages(<?php echo ShopModelPackages::SORT_BY_DATE_NEWEST; ?>)">Mới nhất</a></li>
								<li><a href="javascript:;" onclick="onSortPackages(<?php echo ShopModelPackages::SORT_BY_DATE_OLDEST; ?>)">Cũ nhất</a></li>
								<li><a href="javascript:;" onclick="onSortPackages(<?php echo ShopModelPackages::SORT_BY_ALPHABET; ?>)">ABC</a></li>
								<li><a href="javascript:;" onclick="onSortPackages(<?php echo ShopModelPackages::SORT_BY_ORDER_TIMES; ?>)">Mua nhiều</a></li>
							</ul>
						</span>
					</div>
				</div>
				<div class="fl">
					<div class="txt fl">Kiểu</div>
					<div class="bg_white fl sort" id="divTypes">
						<a href="javascript:;" class="sort-text" id="lnkFilterTypes"><?php echo $this->filterType->text; ?></a>
						<span class="sort-dropdown hide" id="typeDropdown">
							<ul>
								<li><a href="javascript:;" onclick="onChgFilterType(0)">Tất cả</a></li>
								<?php foreach ($this->types as $type): ?>
								<li><a href="javascript:;" onclick="onChgFilterType(<?php echo $type->value; ?>)"><?php echo $type->text; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</span>
					</div>
				</div>
			</form>
		</div>
	</div>

	<?php if (!empty($this->items)): ?>
	<?php foreach ($this->items as $item): ?>
	<?php
		$this->item = &$item;
		echo $this->loadTemplate('item');
	?>
	<?php endforeach; ?>

	<?php // Add pagination links ?>
	<?php if (!empty($this->items)) : ?>
		<?php if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
		<div class="pagination">
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
		<?php endif; ?>
	<?php  endif; ?>
	<?php else: ?>
	<div class="no-result">
	Không có gói phông nào.
	</div>
	<?php endif; ?>
</div>

<form id="shopForm" action="<?php echo JRoute::_("index.php?option=com_shop&view=packages"); ?>" method="post">
	<input type="hidden" name="option" value="com_shop" />
	<input type="hidden" name="view" value="packages" />
	<input type="hidden" name="filter_order" id="txtFilterOrder" value="<?php echo $this->filterOrder->value; ?>" />
	<input type="hidden" name="filter_type" id="txtFilterType" value="<?php echo $this->filterType->value; ?>" />
	<input type="hidden" name="limitstart" id="txtFilterType" value="<?php echo $this->pagination->limitstart; ?>" />
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
</form>

<script type="text/javascript">
$(document).ready(function() {
	$("#divSortPackages").mouseover(function() {
		showObject('#sortDropdown');
	})
	.mouseout(function() {
		hideObject('#sortDropdown');
	});

	$("#divTypes").mouseover(function() {
		showObject('#typeDropdown');
	})
	.mouseout(function() {
		hideObject('#typeDropdown');
	});

	$("input#txtSamplePackageText").keyup(function() {
		onRenderSamplePackagesText();
	});

	onRenderSamplePackagesText("ABCDEFGHIJKLMNOPQRSTUVXYZW");

	$(".pagination").find("a").unbind("click").bind("click", function() {
		var limitstart = getQueryVariableValue(this.href, "limitstart");
		if (limitstart == null) {
			limitstart = 0;
		}
		$("#txtLimitStart").val(limitstart);
		$("#shopForm").submit();
	});
});

function onChgFilterType(type_id) {
	$("#txtFilterType").val(type_id);
	$("#txtLimitStart").val(0);
	$("#shopForm").submit();
}
</script>