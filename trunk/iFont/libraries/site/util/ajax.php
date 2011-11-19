<?php
class SiteAjax {

	public static function buildJsonString($data) {
		$json = "{";
		$start = true;
		foreach ($data as $key => $value) {
			$v = is_numeric($value) ? $value : '"' . $value . '"';
			if (!$start) {
				$json .= ", ";
			}
			$json .= '"' . $key . '" : ' . $v;
			$start = false;
		}
		$json .= "}";
		return $json;
	}

}
?>