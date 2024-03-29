<?php
/**
 * @version		$Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	mod_search
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<div class="boxsearch<?php echo $moduleclass_sfx ?>">
	<form action="<?php echo JRoute::_('index.php?option=com_shop&view=search');?>" method="post"
			id="searchForm">
		<a href="javascript:;" onclick="doSearch();"></a>
		<?php
			$output = '<input name="filter-search" id="mod-search-searchword" maxlength="'.$maxlength.'"  class="tf_search'.$moduleclass_sfx.'" type="text" value="'.$text.'"  onblur="if (this.value==\'\') this.value=\''.$text.'\';" onfocus="if (this.value==\''.$text.'\') this.value=\'\';" />';

			if ($button) :
				if ($imagebutton) :
					$button = '<input type="image" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" src="'.$img.'" onclick="this.form.searchword.focus();"/>';
				else :
					$button = '<input type="submit" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" onclick="this.form.searchword.focus();"/>';
				endif;
			endif;

			switch ($button_pos) :
				case 'top' :
					$button = $button.'<br />';
					$output = $button.$output;
					break;

				case 'bottom' :
					$button = '<br />'.$button;
					$output = $output.$button;
					break;

				case 'right' :
					$output = $output.$button;
					break;

				case 'left' :
				default :
					$output = $button.$output;
					break;
			endswitch;

			echo $output;
		?>
	<input type="hidden" name="view" value="search" />
	<input type="hidden" name="option" value="com_shop" />
	<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
	</form>
</div>

<script type="text/javascript">
function doSearch() {
	$("#searchForm").submit();
}
</script>
