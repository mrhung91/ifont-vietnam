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
?>
<div class="ofh mg_bot30px">
	<div class="headindex">
		<ul class="left">
			<li class="fix_txt"><?php echo $this->item->name; ?></li>
		</ul>
		<ul class="right">
			<li class="fix_txt"><input name="" value="" type="checkbox"><span><?php echo number_format($this->item->price, 0, '', "."); ?></span></li>
			<li class="btn_buy"><a id="lnkBuyPackage" href="javascript:;" onclick="buyFont(<?php echo $this->item->id; ?>)">MUA</a></li>
		</ul>
	</div>
	<div class="show_img_font">
		<img src="<?php echo $doc->baseurl . $this->item->thumb; ?>" />
	</div>
</div>