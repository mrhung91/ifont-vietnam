<?php
class ShopHelperCart {

	public static function getShopCartInfo() {
		$session = JFactory::getSession();
		$cartInfo = $session->get('shopCart');

		$isNew = false;
		if (!isset($cartInfo["fonts"])) {
			$cartInfo["fonts"] = array();
			$isNew = true;
		}
		if (!isset($cartInfo["packages"])) {
			$cartInfo["packages"] = array();
			$isNew = true;
		}
		if ($isNew) {
			$session->set("shopCart", $cartInfo);
		}
		return $cartInfo;
	}

	public static function addFontToCart($font, $package) {
		$cartInfo = ShopHelperCart::getShopCartInfo();
		if (!isset($cartInfo["fonts"])) {
			$cartInfo["fonts"] = array();
		}
		$fontMap = $cartInfo["fonts"];

		$fontInfo = new stdClass();
		$fontInfo->id = $font->font_id;
		$fontInfo->name = $font->name;
		$fontInfo->alias = $font->alias;
		$fontInfo->price = $font->price;
		$fontInfo->package_id = $package->package_id;
		$fontInfo->package_name = $package->name;
		$fontInfo->package_alias = $package->alias;
		$fontMap[$font->font_id] = $fontInfo;
		$cartInfo["fonts"] = $fontMap;

		$session = JFactory::getSession();
		$session->set('shopCart', $cartInfo);
	}

	public static function removeFontFromCart($font_id) {
		$cartInfo = ShopHelperCart::getShopCartInfo();
		if ($cartInfo == null || !isset($cartInfo["fonts"])) {
			return false;
		}
		$fontMap = $cartInfo["fonts"];
		if (isset($fontMap[$font_id])) {
			unset($fontMap[$font_id]);
			$cartInfo["fonts"] = $fontMap;

			$session = JFactory::getSession();
			$session->set('shopCart', $cartInfo);
			return true;
		}
		return false;
	}

	public static function removePackageFromCart($package_id) {
		$cartInfo = ShopHelperCart::getShopCartInfo();
		if ($cartInfo == null || !isset($cartInfo["packages"])) {
			return false;
		}
		$packageMap = $cartInfo["packages"];
		if (isset($packageMap[$package_id])) {
			unset($packageMap[$package_id]);
			$cartInfo["packages"] = $packageMap;

			$session = JFactory::getSession();
			$session->set('shopCart', $cartInfo);
			return true;
		}
		return false;
	}

	public static function addPackageToCart($package) {
		$cartInfo = ShopHelperCart::getShopCartInfo();
		if (!isset($cartInfo["packages"])) {
			$cartInfo["packages"] = array();
		}
		$packageMap = $cartInfo["packages"];

		$packageInfo = new stdClass();
		$packageInfo->id = $package->package_id;
		$packageInfo->name = $package->name;
		$packageInfo->alias = $package->alias;
		$packageInfo->price = $package->price;
		$packageInfo->num_items = 1;
		$packageMap[$package->package_id] = $packageInfo;
		$cartInfo["packages"] = $packageMap;

		$session = JFactory::getSession();
		$session->set('shopCart', $cartInfo);
	}

	public static function isFontAdded($font_id) {
		$cartInfo = ShopHelperCart::getShopCartInfo();
		if (!isset($cartInfo["fonts"])) {
			return false;
		}

		$fontMap = $cartInfo["fonts"];
		if (isset($fontMap[$font_id])) {
			return true;
		}

		return false;
	}

	public static function isPackageAdded($package_id) {
		$cartInfo = ShopHelperCart::getShopCartInfo();
		if (!isset($cartInfo["packages"])) {
			return false;
		}

		$packageMap = $cartInfo["packages"];
		if (isset($packageMap[$package_id])) {
			return true;
		}

		return false;
	}

	public static function hasItem() {
		$cartInfo = ShopHelperCart::getShopCartInfo();
		if (isset($cartInfo["fonts"])) {
			$fontMap = $cartInfo["fonts"];
			if (!empty($fontMap)) {
				return true;
			}
		}

		if (isset($cartInfo["packages"])) {
			$packageMap = $cartInfo["packages"];
			if (!empty($packageMap)) {
				return true;
			}
		}

		return false;
	}

	public static function clearCart() {
		$cartInfo = ShopHelperCart::getShopCartInfo();
		unset($cartInfo["fonts"]);
		unset($cartInfo["packages"]);

		$session = JFactory::getSession();
		$session->set('shopCart', $cartInfo);
	}

}
?>