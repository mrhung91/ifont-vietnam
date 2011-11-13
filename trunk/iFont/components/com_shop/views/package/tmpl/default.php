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
$doc = JFactory::getDocument();
?>
<div class="package-list<?php echo $this->pageclass_sfx;?>">

	<?php if ($this->params->get('show_page_heading', 0)) : ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>

	<?php if ($this->params->get('show_package_title', 1)) : ?>
	<h2 class="title clearfix">
		<span class="title-label"><?php echo $this->package->name;?></span>
		<span class="title-info">
			<?php echo $this->pagination->total; ?> <?php echo JText::_("Types"); ?>
			&nbsp;|&nbsp;
			<?php echo number_format($this->package->price, 0, ",", "."); ?> VNĐ
			<span>Mua trọn bộ</span>
		</span>
	</h2>
	<?php endif; ?>

	<div class="package-desc">
		<?php echo JText::_("Introduction"); ?>
		<?php echo $this->package->description; ?>
		<div class="clr"></div>
	</div>

	<div class="package-items">
		<?php echo $this->loadTemplate('fonts'); ?>
	</div>
</div>
