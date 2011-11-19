<?php
/**
 * @package     Joomla.Platform
 *
 * @copyright   Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

class JSiteMenu {
	public static function getMenuUrl($menu_id) {
		$items = &JSite::getMenu();
		$row = $items->getItems("id", $menu_id, true);
		if($row){
			$result= JRoute::_($row->link.'&Itemid='.$row->id);
			return $result;
		}
		return null;
	}
}