<?php
/**
 * @version		$Id: default_articles.php 21700 2011-06-28 04:32:41Z dextercowley $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$doc = JFactory::getDocument();

$item_id = $this->item->id;
?>
<div class="ofh mg_bot30px">
	<div class="headindex">
		<ul class="left">
			<li class="fix_txt"><a href="<?php echo ShopHelperRoute::getFontRoute($item_id, $this->item->package_id); ?>">
				<?php echo $this->item->name; ?></a></li>
		</ul>
		<ul class="right">
			<li class="fix_txt">
				<input name="" value="" type="checkbox"><span><?php echo number_format($this->item->price, 0, '', "."); ?></span>
			</li>
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
	<div class="show_img_font" id="font-sample-<?php echo $item_id; ?>">
		<img />
	</div>
</div>