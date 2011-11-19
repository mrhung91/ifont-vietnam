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
	<link rel="stylesheet" href="<?php echo $tplUrl; ?>/javascript/jquery.simpledialog.0.1.css" type="text/css" />
	<?php if($templateparams->get('html5', 0)) { ?>
	<!--[if lt IE 9]>
	<![endif]-->
	<?php } ?>
	<script type="text/javascript" src="<?php echo $tplUrl; ?>/javascript/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="<?php echo $tplUrl; ?>/javascript/jquery.simpledialog.0.1.pack.js"></script>
	<script type="text/javascript" src="<?php echo $tplUrl; ?>/javascript/jquery.form.js"></script>
	<script type="text/javascript" src="<?php echo $tplUrl; ?>/javascript/main.js"></script>
</head>
<body>
	<div id="container" class="clearfix">
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
						<a href="<?php echo JURI::base(); ?>">
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
	<?php if ($user->id == 0): ?>
	<div id="loginDlg" style="display: none;">
		<div class="box_login" id="login">
			<h3>Đăng nhập</h3>
			<form id="formLogin" name="formLogin" onsubmit="return submitAjaxLogin();"
					action="<?php echo JRoute::_('index.php?option=com_users&task=user.ajaxLogin'); ?>" method="post">
				<h5>Thông tin đăng nhập</h5>
				<ul>
					<li class="w195">Email đăng nhập</li>
					<li class="bg_tflogin"><input type="text" class="tf_login"
						name="username" id="txtLoginEmail">
					</li>
					<div class="clr hg10px"></div>
					<li class="w195">Mật khẩu</li>
					<li class="bg_tflogin"><input type="password" class="tf_login"
						name="password" id="txtLoginPassword">
					</li>
					<div class="clr hg10px"></div>
					<li class="italic"><a href="#">Quên mật khẩu?</a>|<a href="#">Đăng
							ký</a></li>
					<div class="clr hg20px"></div>
					<li class="button_login"><input type="submit" class="btn" value="Đăng nhập" />
					</li>
				</ul>
		        <?php echo JHtml::_('form.token'); ?>
		    </form>
			<div class="ico_close"><a href="#" class="close"></a></div>
		</div>
	</div>
	<div id="registerDlg" style="display: none;">
		<div class="box_login">
			<h3>Đăng ký</h3>
			<form id="formRegister" onsubmit="return submitAjaxRegister();"
					action="<?php echo JRoute::_('index.php?option=com_users&task=registration.ajaxRegister'); ?>"
					method="post" class="form-validate">
				<h5>Thông tin đăng nhập</h5>
				<ul>
					<li class="w195">Email đăng nhập</li>
					<li class="bg_tfregister">
						<input type="text" class="tf_register email validate-email required" name="jform[email1]"
							id="txtRegEmail" />
					</li>
					<li class="check_error"></li>
					<div class="clr hg10px"></div>

					<li class="w195">Mật khẩu</li>
					<li class="bg_tfregister">
						<input type="password" class="tf_register validate-password required" name="jform[password1]"
							id="txtRegPassword1" />
					</li>
					<li class="check_error"></li>
					<div class="clr hg10px"></div>

					<li class="w195">Nhập lại mật khẩu</li>
					<li class="bg_tfregister">
						<input type="password" class="tf_register validate-password required" name="jform[password2]"
							id="txtRegPassword2" />
					</li>
					<li class="check_error"></li>
					<div class="clr hg10px"></div>

					<li class="italic">(Email đăng nhập cũng sẽ là email dùng để chuyển phông).</li>
					<div class="clr hg10px"></div>
					<li class="w195">Số điện thoại</li>
					<li class="bg_tfregister">
						<input type="text" class="tf_register" name="jform[phone]" id="txtRegPhone" />
					</li>
					<li class="check_error"></li>
					<div class="clr hg10px"></div>

					<li class="italic">(Số điện thoại sẽ dùng để xác nhận việc mua  phông).</li>
					<div class="clr hg20px"></div>

					<li class="button_login mg_left10px"><input type="button" class="btn close close" value="Hủy bỏ" name=""></li>
					<li class="button_login"><input type="submit" class="btn" value="Đăng ký" name=""></li>
				</ul>
				<?php echo JHtml::_('form.token');?>
				<input type="hidden" name="jform[name]" id="txtRegName" />
				<input type="hidden" name="jform[username]" id="txtRegUsername" />
			</form>
			<div class="ico_close"><a href="#" class="close"></a></div>
		</div>
	</div>
	<?php endif; ?>
</body>
</html>
