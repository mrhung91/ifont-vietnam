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
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
	<?php if($templateparams->get('html5', 0)) { ?>
	<!--[if lt IE 9]>
	<![endif]-->
	<?php } ?>
</head>
<body>
	<div id="container" class="clearfix">
		<div id="coleft">
			<div id="toolsleft">
				<div class="toolsbar">
					<a href="#"></a>
				</div>
				<jdoc:include type="modules" name="position-7" />
			</div>
			<div id="contactbox">
				<h3>LIÊN HỆ</h3>
				<input type="text" name="name" value="Tên" /> <input type="text"
					name="email" value="Địa chỉ thư" />
				<textarea>Nội dung</textarea>
				<a class="button" href="#">&nbsp</a>
			</div>
		</div>
		<div id="coright">
			<div id="topbar">
				<div class="boxlogin">
					<a href="#">Đăng nhập</a><span>|</span><a href="#">Đăng ký</a>
				</div>
				<div class="boxsearch">
					<input type="text" name="serch" value="tìm phông" />
				</div>
			</div>
			<div id="toplogo">
				<div id="logo">
					<a rel="home" title="iFont" href="#"><img src="<?php echo $this->baseurl ?>/templates/site/images/logo.png"></a>
				</div>
			</div>
			<div id="main">
				<div id="title" class="clearfix">
					<h3>CHỌN PHÔNG</h3>
				</div>
				<div id="defautwfont" class="clearfix">
					<div class="searchbox clearfix">
						<p>
							<input type="text" class="ls" name="txexample"
								value="Nhập chữ để xem ví dụ" /> <label>Sắp xếp</label>
							<input type="text" class="nms" name="txsortby"
								value="Mới Nhất" /> <label>Kiểu</label> <input type="text"
								class="sms" name="txfont" value="Sans - Serif " />
						</p>
					</div>
					<div class="blockfont">
						<p>
							<a class="bold">Helvetica</a><span>|</span><a>đăng bởi Bachi</a><span></span>
							<a class="ico vn" href="#">&nbsp</a> <a class="ico apple"
								href="#">&nbsp</a> <a class="ico window" href="#">&nbsp</a> <span
								class="total">39 kiểu</span> <a class="button buyactive"
								href="#">&nbsp</a>
						</p>
						<div class="boximg">
							<img src="<?php echo $this->baseurl ?>/templates/site/images/font-example.png">

						</div>
					</div>
					<div id="pagination">
						<a href="#"><</a> <a href="#">01</a> <span class="current">02</span>
						<a href="#">03</a> <a href="#">04</a> <a href="#">05</a> <a
							href="#">></a>
					</div>
					<div id="footer">
						<p>Copyright � 2011 vf.vn - All Rights Reserved.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
