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
$tplUrl			= $this->baseurl . "/templates/site";
$user			= JFactory::getUser();
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
	<link rel="stylesheet" href="<?php echo $tplUrl; ?>/css/style.css" type="text/css" />
	<?php if($templateparams->get('html5', 0)) { ?>
	<!--[if lt IE 9]>
	<![endif]-->
	<?php } ?>
	<script type="text/javascript" src="<?php echo $tplUrl; ?>/javascript/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="<?php echo $tplUrl; ?>/javascript/main.js"></script>
</head>
<body>
	<div id="container">
		<div class="panel_left">
			<div class="menu">
				<jdoc:include type="modules" name="position-7" />
			</div>
			<div class="contact">
				<jdoc:include type="modules" name="position-4" />
			</div>
		</div>
		<div class="panel_right">
			<div id="header">
				<div class="left">
					<div class="logo">
						<a href="<?php echo $this->baseurl; ?>">
							<img src="<?php echo $tplUrl; ?>/images/logo.png" width="108" height="77" />
						</a>
					</div>
				</div>
				<div class="right">
					<div class="nav_menuTop">
						<jdoc:include type="modules" name="position-6" />
					</div>
				</div>
			</div>
			<div id="content">
				<jdoc:include type="component" />
				<jdoc:include type="modules" name="position-5" />
			</div>
			<div id="footer">&copy; 2011 vf.vn - All Rights Reserved.</div>
		</div>
		<div id="ads">
			<jdoc:include type="modules" name="position-13" />
		</div>
	</div>
	 <div id="overlay" style="display: none;"></div>
	 <?php if ($user == null): ?>
	 <div id="dlgLogin" style="display: none;">
	 	<div class="box_login" id="login">
			<h3>Đăng nhập</h3>
		    <form id="formLogin" name="formLogin" action="">
		    	<h5>Thông tin đăng nhập</h5>
		        <ul>
			        <li class="w195">Email đăng nhập</li>
			        <li class="bg_tflogin"><input type="text" class="tf_login" name="email" id="txtLoginEmail"></li>
			        <div class="clr hg10px"></div>
			        <li class="w195">Mật khẩu</li>
			        <li class="bg_tflogin"><input type="text" class="tf_login" name="password" id="txtLoginPassword" ></li>
			        <div class="clr hg10px"></div>
			        <li class="italic"><a href="#">Quên mật khẩu?</a>|<a href="#">Đăng ký</a></li>
			        <div class="clr hg20px"></div>
			        <li class="button_login"><input type="button" class="btn" value="Đăng nhập"></li>
		        </ul>
		    </form>
		    <div class="ico_close"><a href="javascript:;" onlick="closeLoginBox();"></a></div>
		</div>
	 </div>
	 <?php endif; ?>
</body>
</html>
