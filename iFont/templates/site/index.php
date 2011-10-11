<?php
/**
 * @version		$Id: index.php 17268 2010-05-25 20:32:21Z a.radtke $
 * @package		Joomla.Site
 * @subpackage	Templates.beez5
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// check modules
/* $showRightColumn	= ($this->countModules('position-3') or $this->countModules('position-6') or $this->countModules('position-8'));
 $showbottom			= ($this->countModules('position-9') or $this->countModules('position-10') or $this->countModules('position-11'));
$showleft			= ($this->countModules('position-4') or $this->countModules('position-7') or $this->countModules('position-5'));

if ($showRightColumn==0 and $showleft==0) {
$showno = 0;
} */

JHtml::_('behavior.framework', true);

// get params
$app			= JFactory::getApplication();
$doc			= JFactory::getDocument();
$templateparams	= $app->getTemplate(true)->params;
?>
<?php if(!$templateparams->get('html5', 0)): ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php else: ?>
<?php echo '<!DOCTYPE html>'; ?>
<?php endif; ?>
<html xmlns="http://www.w3.org/1999/xhtml"
	xml:lang="<?php echo $this->language; ?>"
	lang="<?php echo $this->language; ?>"
	dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/site/css/style.css" type="text/css" />
	<?php if($templateparams->get('html5', 0)) { ?>
	<!--[if lt IE 9]>
	<![endif]-->
	<?php } ?>
</head>
<body>
	<div id="container" class="clearfix">
		<div id="coleft">
			<div id="toolsleft">
				<jdoc:include type="modules" name="position-7" />
			</div>
			<div id="contactbox">
				<jdoc:include type="modules" name="position-4" />
			</div>
		</div>
		<div id="coright">
			<div id="topbar">
				<jdoc:include type="modules" name="position-6" />
			</div>
			<div id="toplogo">
				<jdoc:include type="modules" name="position-8" />
			</div>
			<div id="main">
				<jdoc:include type="component" />
			</div>
			<div id="footer">
				<p>Copyright &copy; 2011 vf.vn - All Rights Reserved.</p>
			</div>
		</div>
	</div>
</body>
</html>
