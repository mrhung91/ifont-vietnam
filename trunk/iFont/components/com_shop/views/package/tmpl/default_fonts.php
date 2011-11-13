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
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::core();

$params		= &$this->item->params;
?>
<?php if (empty($this->items)) : ?>
	<p><?php echo JText::_('COM_SHOP_NO_FONTS'); ?></p>
<?php else : ?>
	<ul class="fonts-list">
	<?php foreach ($this->items as $i => $font) : ?>
		<div class="font">
			<p>
				<a href="index.php?option=com_shop&amp;view=package&amp;id=2" class="font-title">
					<?php echo $font->name; ?></a>
				<span class="price"><?php echo $font->price; ?></span>
			</p>
			<div class="boximg">
				<img src="<?php echo $doc->baseurl . $font->thumb; ?>" />
			</div>
		</div>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>


<?php // Add pagination links ?>
<?php if (!empty($this->items)) : ?>
	<?php if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
	<div class="pagination">

		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
		 	<p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		<?php endif; ?>

		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>
</form>
<?php  endif; ?>
