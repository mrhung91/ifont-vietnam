<?php
class SiteModule {
	public static function loadModulesByName($name, $style) {
		$document	= JFactory::getDocument();
		$renderer	= $document->loadRenderer('module');
		$modules	= JModuleHelper::getModules($name);
		$params		= array('style' => $style);
		ob_start();
		foreach ($modules as $module) {
			echo $renderer->render($module, $params);
		}
		$result = ob_get_clean();
		return $result;
	}
}
?>