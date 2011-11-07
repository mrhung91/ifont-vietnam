<?php
/**
 * JoomBlog component for Joomla
 * @version $Id: install.joomblog.php 2011-03-16 17:30:15
 * @package JoomBlog
 * @subpackage install.joomblog.php
 * @author JoomPlace Team
 * @Copyright Copyright (C) JoomPlace, www.joomplace.com
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die('Restricted access');

define( "SITE_ROOT_PATH", JPATH_ROOT );

jimport( 'joomla.filesystem.file' );
jimport( 'joomla.filesystem.folder' );
jimport( 'joomla.filesystem.archive' );

class com_shopInstallerScript
{
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	function install($parent)
	{

	}

	/**
	 * method to uninstall the component
	 *
	 * @return void
	 */
	function uninstall($parent)
	{
		$db	=& JFactory::getDBO();
		$db->setQuery("DELETE FROM #__menu WHERE path = 'joomblog' AND type = 'component' AND client_id = 1 AND menutype = 'main' AND link LIKE 'index.php?option=com_shop%' ");
		$db->query();
	}

	/**
	 * method to update the component
	 *
	 * @return void
	 */
	function update($parent)
	{
	}

	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 */
	function preflight($type, $parent)
	{

		$pathes = $files =array();

		$pathes[]= SITE_ROOT_PATH . "/administrator/components/com_shop/controllers";
		$pathes[]= SITE_ROOT_PATH . "/administrator/components/com_shop/helpers";
		$pathes[]= SITE_ROOT_PATH . "/administrator/components/com_shop/install";
		$pathes[]= SITE_ROOT_PATH . "/administrator/components/com_shop/models";
		$pathes[]= SITE_ROOT_PATH . "/administrator/components/com_shop/views";
		$pathes[]= SITE_ROOT_PATH . "/components/com_shop";

		if (sizeof($pathes))
		foreach ($pathes as $path) {
			if (JFolder::exists($path)) JFolder::delete($path);
		}

		$files[]= SITE_ROOT_PATH . "/administrator/components/com_shop/controller.php";
		$files[]= SITE_ROOT_PATH . "/administrator/components/com_shop/shop.php";

		if (sizeof($files))
		foreach ($files as $file) {
			if (is_file($file)) 	JFile::delete($file);
		}
	}

	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent)
	{
		$mainframe	=& JFactory::getApplication();

		$this->_FixMenuLinks();
		$this->_ExtractFiles();
		?>
<font style="font-size: 2em; color: #55AA55;">Shop component
	successfully installed.</font>
<br />
<br />
<table border="1" cellpadding="5" width="100%"
	style="background-color: #F7F8F9; border: solid 1px #d5d5d5; width: 100%; padding: 10px; border-collapse: collapse;">
	<tr>
		<td colspan="2"
			style="background-color: #e7e8e9; text-align: left; font-size: 16px; font-weight: 400; line-height: 18px"><strong><img
				src="<?php echo JURI::base(); ?>components/com_shop/assets/images/tick.png">
				Getting started.</strong> Helpfull links:</td>
	</tr>
</table>

<?php }

	function _FixMenuLinks()
	{
		$db	=& JFactory::getDBO();

		$query = "SELECT `extension_id` FROM #__extensions WHERE `type` = 'component' AND `element`='com_shop'";
		$db->setQuery( $query );

		$comid	= $db->loadResult();
		$query = "UPDATE #__menu SET `component_id`='$comid' WHERE `link` LIKE 'index.php?option=com_shop%'";
		$db->setQuery($query);
		$db->query();
	}


	function _ExtractFiles()
	{
		JArchive::extract(SITE_ROOT_PATH . "/administrator/components/com_shop/install/frontend.zip", SITE_ROOT_PATH . "/components/com_shop/");
		JArchive::extract(SITE_ROOT_PATH . "/administrator/components/com_shop/install/backend.zip", SITE_ROOT_PATH . "/administrator/components/com_shop/");
	}

}

?>