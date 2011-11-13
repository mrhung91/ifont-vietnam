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
?>
<div class="ofh mg_bot30px">
	<div class="headindex">
		<ul class="left">
			<li class="fix_txt"><a href="<?php echo ShopHelperRoute::getPackageRoute($this->item->id); ?>">
				<?php echo $this->item->name; ?></a>&nbsp;|&nbsp;đăng bởi <?php echo $this->item->user; ?></li>
			<li><span class="ico01 os"></span> <span class="ico02 os"></span><span class="ico03 os"></span>
			</li>
		</ul>
		<ul class="right">
			<li class="fix_txt"><?php echo $this->item->num_fonts; ?> kiểu</li>
			<li class="btn_buy"><a href="javascript:;" onclick="buyPackage(<?php echo $this->item->id; ?>)">MUA</a></li>
		</ul>
	</div>
	<div class="show_img_font">
		<img src="<?php echo $doc->baseurl . $this->item->thumb; ?>" />
	</div>
</div>
