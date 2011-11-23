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
				<?php echo $this->item->name; ?></a>&nbsp;|&nbsp;đăng bởi <?php echo $this->item->user; ?></li>
			<li><span class="ico01 os"></span> <span class="ico02 os"></span><span class="ico03 os"></span>
			</li>
		</ul>
		<?php if (!$this->item->isPackageAdded) : ?>
		<ul class="right">
			<li class="fix_txt"><?php echo $this->item->num_fonts; ?> kiểu</li>
			<li class="btn_buy"><a href="javascript:;"
				onclick="buyPackage(this, <?php echo $package_id; ?>)">MUA</a></li>
		</ul>
		<?php endif; ?>
	</div>
	<div class="show_img_font" id="package-sample-<?php echo $package_id; ?>">
		<img src="<?php echo $doc->baseurl . $this->item->thumb; ?>" />
	</div>
</div>
