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
<div class="col">
	<div class="row1 row-font-info">
		<a class="row-package" href="<?php echo $this->item->link; ?>" title="Xem gói phông">
			<?php echo $this->item->package_name; ?></a>
		<?php echo $this->item->name; ?>
	</div>
	<div class="row2">
		<a href="javascript:;" onclick="removeFontFromCart(this, <?php echo $this->item->id; ?>);">Bỏ chọn</a>
	</div>
	<div class="row3"><?php echo number_format($this->item->price, 0, '', "."); ?> VNĐ</div>
</div>
