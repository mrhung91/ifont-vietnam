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
						<a href="javascript:;" class="sort-text" id="lnkSortPackages"><?php echo $this->filterOrder; ?></a>
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
				<!-- <div class="fl">
					<div class="txt fl">Kiểu</div>
					<div class="bg_white fl">
						<input type="text" class="tf_03"
							onblur="if(this.value=='') {this.value='Sans - Serif'}"
							onfocus="if(this.value=='Sans - Serif') {this.value=''}"
							value="Sans - Serif" name="">
					</div>
				</div>
				 -->
			</form>
		</div>
	</div>


<?php foreach ($this->items as $item): ?>
<?php
	$this->item = &$item;
	echo $this->loadTemplate('item');
?>
<?php endforeach; ?>
</div>

<form id="shopForm" action="<?php echo JRoute::_("index.php?option=com_shop&view=packages"); ?>" method="get">
	<input type="hidden" name="option" value="com_shop" />
	<input type="hidden" name="view" value="packages" />
	<input type="hidden" name="filter_order" id="txtFilterOrder" value="" />
	<input type="hidden" name="filter_type" id="txtFilterType" value="" />
</form>

<script type="text/javascript">
$(document).ready(function() {
	$("#divSortPackages").mouseover(function() {
		showObject('#sortDropdown');
	})
	.mouseout(function() {
		hideObject('#sortDropdown');
	});

	$("input#txtSamplePackageText").keyup(function() {
		onRenderSamplePackagesText();
	});

	onRenderSamplePackagesText("ABCDEFGHIJKLMNOPQRSTUVXYZW");
});
</script>