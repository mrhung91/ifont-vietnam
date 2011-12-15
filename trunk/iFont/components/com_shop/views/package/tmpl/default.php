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

require_once JPATH_COMPONENT .'/helpers/package.php';
$package_id = $this->package->package_id;
$num_fonts = ShopHelperPackage::getNumFonts($package_id);
setlocale(LC_MONETARY, 'en_US');
?>
<div class="package<?php echo $this->pageclass_sfx;?>">

	<div class="heading_bderbot">
		<h3 class="fl textright">
			<a href="javascript:;" onclick="history.go(-1);" class="shop-back"></a>
			<span class="package-name"><?php echo $this->package->name;?></span>
		</h3>
		<div class="headindex fr">
			<ul class="right package-detail">
				<li class="fix_txt"><?php echo $num_fonts; ?> kiểu&nbsp;|
					&nbsp;<?php echo number_format($this->package->price, 0, '', "."); ?> VNĐ</li>
				<?php if (!ShopHelperCart::isPackageAdded($package_id)): ?>
				<li class="btn_buy"><a id="lnkBuyPackage" href="javascript:;"
						onclick="buyPackage(this, <?php echo $package_id; ?>)">Mua trọn bộ</a></li>
				<?php else: ?>
				<li class="btn_bought">ĐÃ MUA</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>

	<?php if ($this->pagination->limitstart == 0): ?>
	<div class="txt01 mg_bot30px">
		<div id="secDescription">
			<?php echo JHtml::_('content.prepare', $this->package->introtext); ?>
			<?php if (!empty($this->package->fulltext)): ?>
			<span id="fulltext" class="hide"><?php echo $this->package->fulltext; ?></span>
			<a href="javascript:;" id="lnkToggleDesc" style="display: none;" class="blue">Xem thêm</a>
			<?php endif; ?>
		</div>
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
			<div class="fl mg_left25px">
				<div class="txt fl">Sắp xếp</div>
				<div class="bg_white fl sort" id="divSortFonts">
					<a href="javascript:;" class="sort-text" id="lnkSortFonts"><?php echo $this->filterOrder; ?></a>
					<span class="sort-dropdown hide" id="sortDropdown">
						<ul>
							<li><a href="javascript:;" onclick="onSortFonts(<?php echo ShopModelPackage::SORT_BY_DATE_NEWEST; ?>)">Mới nhất</a></li>
							<li><a href="javascript:;" onclick="onSortFonts(<?php echo ShopModelPackage::SORT_BY_DATE_OLDEST; ?>)">Cũ nhất</a></li>
							<li><a href="javascript:;" onclick="onSortFonts(<?php echo ShopModelPackage::SORT_BY_ALPHABET; ?>)">ABC</a></li>
							<li><a href="javascript:;" onclick="onSortFonts(<?php echo ShopModelPackage::SORT_BY_ORDER_TIMES; ?>)">Mua nhiều</a></li>
						</ul>
					</span>
				</div>
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
		action="<?php echo JRoute::_("index.php?option=com_shop&view=package&id=" . $package_id . "&Itemid=" . $this->Itemid); ?>">
	<input type="hidden" name="option" value="com_shop" />
	<input type="hidden" name="view" value="package" />
	<input type="hidden" name="id" value="<?php echo $package_id; ?>" />
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
	<input type="hidden" name="limitstart" id="txtFilterType" value="<?php echo $this->pagination->limitstart; ?>" />
	<input type="hidden" name="filter_order" id="txtFilterOrder" value="" />
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

	$("#lnkToggleDesc").show().click(function() {
		if ($("#fulltext").hasClass("hide")) {
			$(this).html("Thu gọn");
			$("#fulltext").removeClass("hide", 5000);
		} else {
			$(this).html("Xem thêm");
			$("#fulltext").addClass("hide", 5000);
		}
	});
});
</script>
