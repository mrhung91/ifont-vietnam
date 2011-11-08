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

<div id="title" class="clearfix">
	<h3>CHỌN PHÔNG</h3>
</div>
<div id="defautwfont" class="clearfix">
	<div class="searchbox clearfix">
		<p>
			<input class="ls" name="txexample" value="Nhập chữ để xem ví dụ "
				type="text"> <label>Sắp xếp</label> <input class="nms"
				name="txsortby" value="Mới Nhất" type="text"> <label>Kiểu</label> <input
				class="sms" name="txfont" value="Sans - Serif " type="text">
		</p>
	</div>
	<?php foreach ($this->items as $index => $package): ?>
	<div class="blockfont">
		<p>
			<a class="bold" href="<?php echo $doc->baseurl; ?>index.php?option=com_shop&view=package&id=<?php echo $package->id; ?>">
				<?php echo $package->name; ?></a>
			<span>|</span>đăng bởi <?php echo $package->user; ?>
			<span></span>
			<a class="ico vn" href="javascript:;">&nbsp;</a> <a class="ico apple" href="#">&nbsp;</a>
			<a class="ico window" href="#">&nbsp;</a> <span class="total"><?php echo $package->num_fonts; ?> kiểu</span>
			<a class="button buyactive" href="#">&nbsp;</a>
		</p>
		<div class="boximg">
			<img src="<?php echo $doc->baseurl . $package->thumb; ?>" />
		</div>
	</div>
	<?php endforeach; ?>
	<div id="footer">
		<p>© 2011 vf.vn - All Rights Reserved.</p>
	</div>
</div>