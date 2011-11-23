<?php
/**
 * @version		$Id: default.php 17137 2010-05-17 07:00:07Z infograf768 $
 * @package		Joomla.Site
 * @subpackage	Templates.beez5
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;
?>
<div class="heading_bderbot">
	<h3 class="textright"><?php echo $this->escape($this->params->get('page_heading')); ?></h3>
</div>
<div class="main-text">
	<?php echo $this->item->text; ?>

	<?php echo $this->item->event->afterDisplayContent; ?>
</div>
