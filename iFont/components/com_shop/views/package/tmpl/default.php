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
$num_fonts = ShopHelperPackage::getNumFonts($this->package->package_id);
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
				<li class="btn_buy"><a id="lnkBuyPackage" href="javascript:;"
						onclick="buyPackage(this, <?php echo $this->package->package_id; ?>)">Mua trọn bộ</a></li>
			</ul>
		</div>
	</div>

	<div class="txt01 mg_bot30px">
		<strong>Giới thiệu:</strong>
		<p><?php echo JHtml::_('content.prepare', $this->package->description); ?></p>
	</div>

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
				<div class="bg_white fl">
					<input type="text" class="tf_02"
						onblur="if(this.value=='') {this.value='Mới nhất'}"
						onfocus="if(this.value=='Mới nhất') {this.value=''}"
						value="Mới nhất" name="" />
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
	</form>
	<?php  endif; ?>
</div>
