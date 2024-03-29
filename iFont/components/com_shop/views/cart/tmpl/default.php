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

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');
$fonts = $this->items["fonts"];
$packages = $this->items["packages"];
$total = 0;

jimport("site.util.module");
$content = SiteModule::loadModulesByName("position-12", "xhtml");
?>
<div class="cart-info">
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<div class="heading_bderbot">
		<h3 class="textright">
			<a href="javascript:;" onclick="history.go(-1);" class="shop-back"></a>
			<?php echo $this->escape($this->params->get('page_heading')); ?></h3>
	</div>
	<?php endif; ?>

	<?php if (count($fonts) > 0 || count($packages) > 0) : ?>
	<div class="table font-list">
		<?php foreach ($fonts as $index => $item): ?>
		<?php
			$this->item = $item;
			echo $this->loadTemplate('item');
			$total += $item->price;
		?>
		<?php endforeach; ?>
		<?php foreach ($packages as $index => $item): ?>
		<?php
			$this->item = $item;
			echo $this->loadTemplate('package');
			$total += $item->price;
		?>
		<?php endforeach; ?>
	</div>
	<div class="ofh fix02">
		<div class="link_green fl">
			<a href="<?php echo JURI::base(); ?>">Chọn thêm phông</a> &gt;&gt;
		</div>
		<div class="fr">
			Tổng<span class="price"><?php echo number_format($total, 0, '', "."); ?> VNĐ</span>
		</div>
	</div>

	<div id="payment-type">
		<?php echo $content; ?>
		<input type="checkbox" id="chkPaymentConfirm" />&nbsp;
		<label for="chkPaymentConfirm">Tôi đã hiểu cách thanh toán.</label>
	</div>

	<div class="fix03">
		<a class="btn_buy_big" href="javascript:;" onclick="checkOutCart()">MUA</a>
	</div>

	<form id="cartForm" name="cartForm" method="post"
			action="<?php echo JRoute::_("index.php?option=com_shop&task=cart.checkout"); ?>">
		<?php echo JHtml::_('form.token'); ?>
	</form>

	<script type="text/javascript">
	function checkOutCart() {
		if ($("#chkPaymentConfirm:checked").length == 0) {
			alert("Vui lòng xác nhận bạn đã hiểu cách thanh toán");
			return;
		}
		$("#cartForm").submit();
	}
	</script>
	<?php else: ?>
	<div class="no-result">Không có phông nào trong giỏ hàng.</div>
	<?php endif; ?>
</div>