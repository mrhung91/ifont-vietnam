<?php
/**
 * @version		$Id: default.php 21518 2011-06-10 21:38:12Z chdemko $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params		= $this->item->params;
$canEdit	= $this->item->params->get('access-edit');
$user		= JFactory::getUser();
$item_id = $this->item->font_id;
$baseUrl	= JURI::base();
?>
<div class="item-page<?php echo $this->pageclass_sfx?>">
	<div class="heading_bderbot">
		<h3 class="fl textright">
			<a class="shop-back" onclick="history.go(-1);" href="javascript:;"></a>
			<span class="package-name"><?php echo $this->escape($this->params->get('page_heading')); ?></span>
		</h3>
		<div class="headindex fr">
			<ul class="right package-detail">
				<li class="fix_txt"><?php echo number_format($this->item->price, 0, '', "."); ?> VNĐ</li>
				<?php if (!$this->item->isFontAdded) : ?>
				<li class="btn_buy">
					<a id="lnkBuyFont<?php echo $item_id; ?>" href="javascript:;"
						onclick="buyFont(this, <?php echo $item_id; ?>)">MUA</a>
				</li>
				<?php else: ?>
				<li class="btn_bought">ĐÃ MUA</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>

	<?php if (!empty($this->item->thumbnails)) : ?>
	<div class="font-thumbnails">
		<?php foreach ($this->item->thumbnails as $thumbnail): ?>
		<div class="ofh mg_bot30px">
			<div class="font-size"><?php echo $thumbnail->size; ?> px</div>
			<div class="show_img_font">
				<img src="<?php echo $baseUrl . $thumbnail->url; ?>" />
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
</div>