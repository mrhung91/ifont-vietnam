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
$msgQueue = JFactory::getApplication()->getMessageQueue("checkout.result");
if (empty($msgQueue)) {
	$msg = "Bạn đã thanh toán rồi";
} else {
	$msg = $msgQueue[0]["message"];
}
?>
<div class="cart-info">
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<div class="heading_bderbot">
		<h3 class="textright"><?php echo $this->escape($this->params->get('page_heading')); ?></h3>
	</div>
	<?php endif; ?>

	<div class="result-message"><?php echo $msg; ?></div>
</div>