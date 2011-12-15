<?php

/**
 * @version		$Id: default_items.php 20788 2011-02-20 05:54:44Z infograf768 $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$doc = JFactory::getDocument();
$package_id = $this->item->id;
?>
<div class="ofh mg_bot30px">
	<div class="headindex">
		<ul class="left">
			<li class="fix_txt"><a href="<?php echo ShopHelperRoute::getPackageRoute($package_id); ?>">
				<?php echo $this->item->name; ?></a></li>
			<li>
				<?php if ($this->item->is_vietnamese): ?>
				<span class="ico01 os" title="Hỗ trợ tiếng Việt"> </span>
				<?php endif; ?>
				<?php if ($this->item->is_mac): ?>
				<span class="ico02 os" title="Hỗ trợ Mac OS"> </span>
				<?php endif; ?>
				<?php if ($this->item->is_windows): ?>
				<span class="ico03 os" title="Hỗ trợ Windows"> </span>
				<?php endif; ?>
			</li>
		</ul>
		<ul class="right">
			<li class="fix_txt"><?php echo $this->item->num_fonts; ?> kiểu&nbsp;|
					&nbsp;<?php echo number_format($this->item->price, 0, '', "."); ?> VNĐ</li>
			<?php if (!$this->item->isPackageAdded) : ?>
			<li class="btn_buy"><a href="javascript:;"
				onclick="buyPackage(this, <?php echo $package_id; ?>)">MUA</a></li>
			<?php else: ?>
			<li class="btn_bought">ĐÃ MUA</li>
			<?php endif; ?>
		</ul>
	</div>
	<div class="show_img_font" id="package-sample-<?php echo $package_id; ?>">
		<img />
	</div>
</div>
