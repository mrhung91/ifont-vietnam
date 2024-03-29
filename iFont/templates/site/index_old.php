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
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
	<head>
		<jdoc:include type="head" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<?php if($templateparams->get('html5', 0)) { ?>
		<!--[if lt IE 9]>
		<![endif]-->
<?php } ?>
	</head>

	<body>

<div id="all">
	<div id="back">
	<?php if(!$templateparams->get('html5', 0)): ?>
		<div id="header">
			<?php else: ?>
		<header id="header">
			<?php endif; ?>
				<div class="logoheader">
					<h1 id="logo">

					<?php if ($logo != null ): ?>
					<img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($logo); ?>" alt="<?php echo htmlspecialchars($templateparams->get('sitetitle'));?>" />
					<?php else: ?>
					<?php echo htmlspecialchars($templateparams->get('sitetitle'));?>
					<?php endif; ?>
					<span class="header1">
					<?php echo htmlspecialchars($templateparams->get('sitedescription'));?>
					</span></h1>
				</div><!-- end logoheader -->

					<ul class="skiplinks">
						<li><a href="#main" class="u2"><?php echo JText::_('TPL_BEEZ5_SKIP_TO_CONTENT'); ?></a></li>
						<li><a href="#nav" class="u2"><?php echo JText::_('TPL_BEEZ5_JUMP_TO_NAV'); ?></a></li>
						<?php if($showRightColumn ):?>
						<li><a href="#additional" class="u2"><?php echo JText::_('TPL_BEEZ5_JUMP_TO_INFO'); ?></a></li>
						<?php endif; ?>
					</ul>
					<h2 class="unseen"><?php echo JText::_('TPL_BEEZ5_NAV_VIEW_SEARCH'); ?></h2>
					<h3 class="unseen"><?php echo JText::_('TPL_BEEZ5_NAVIGATION'); ?></h3>
					<jdoc:include type="modules" name="position-1" />
					<div id="line">
					<div id="fontsize"></div>
					<h3 class="unseen"><?php echo JText::_('TPL_BEEZ5_SEARCH'); ?></h3>
					<jdoc:include type="modules" name="position-0" />
					</div> <!-- end line -->
		<div id="header-image">
			<jdoc:include type="modules" name="position-15" />
			<?php if ($this->countModules('position-15')==0): ?>
				<img src="<?php echo $this->baseurl ?>/templates/beez5/images/fruits.jpg"  alt="<?php echo JText::_('TPL_BEEZ5_LOGO'); ?>" />
			<?php endif; ?>
		</div>
		<?php if (!$templateparams->get('html5', 0)): ?>
			</div><!-- end header -->
		<?php else: ?>
			</header><!-- end header -->
		<?php endif; ?>
		<div id="<?php echo $showRightColumn ? 'contentarea2' : 'contentarea'; ?>">
					<div id="breadcrumbs">

							<jdoc:include type="modules" name="position-2" />

					</div>

					<?php if ($navposition=='left' AND $showleft) : ?>

						<?php if(!$this->params->get('html5', 0)): ?>
							<div class="left1 <?php if ($showRightColumn==NULL){ echo 'leftbigger';} ?>" id="nav">
						<?php else: ?>
							<nav class="left1 <?php if ($showRightColumn==NULL){ echo 'leftbigger';} ?>" id="nav">
						<?php endif; ?>

								<jdoc:include type="modules" name="position-7" style="beezDivision" headerLevel="3" />
								<jdoc:include type="modules" name="position-4" style="beezHide" headerLevel="3" state="0 " />
								<jdoc:include type="modules" name="position-5" style="beezTabs" headerLevel="2"  id="3" />

						<?php if(!$this->params->get('html5', 0)): ?>
							</div><!-- end navi -->
						<?php else: ?>
							</nav>
						<?php endif; ?>

					<?php endif; ?>

					<div id="<?php echo $showRightColumn ? 'wrapper' : 'wrapper2'; ?>" <?php if (isset($showno)){echo 'class="shownocolumns"';}?>>

						<div id="main">

						<?php if ($this->countModules('position-12')): ?>
							<div id="top"><jdoc:include type="modules" name="position-12"   />
							</div>
						<?php endif; ?>

							<jdoc:include type="message" />
							<jdoc:include type="component" />

						</div><!-- end main -->

					</div><!-- end wrapper -->

				<?php if ($showRightColumn) : ?>
					<h2 class="unseen">
						<?php echo JText::_('TPL_BEEZ5_ADDITIONAL_INFORMATION'); ?>
					</h2>
					<div id="close">
						<a href="#" onclick="auf('right')">
							<span id="bild">
								<?php echo JText::_('TPL_BEEZ5_TEXTRIGHTCLOSE'); ?></span></a>
					</div>

				<?php if (!$templateparams->get('html5', 0)): ?>
					<div id="right">
				<?php else: ?>
					<aside id="right">
				<?php endif; ?>

						<a id="additional"></a>
						<jdoc:include type="modules" name="position-6" style="beezDivision" headerLevel="3"/>
						<jdoc:include type="modules" name="position-8" style="beezDivision" headerLevel="3"  />
						<jdoc:include type="modules" name="position-3" style="beezDivision" headerLevel="3"  />

				<?php if(!$templateparams->get('html5', 0)): ?>
					</div><!-- end right -->
				<?php else: ?>
					</aside>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ($navposition=='center' AND $showleft) : ?>

				<?php if (!$this->params->get('html5', 0)): ?>
					<div class="left <?php if ($showRightColumn==NULL){ echo 'leftbigger';} ?>" id="nav" >
				<?php else: ?>
					<nav class="left <?php if ($showRightColumn==NULL){ echo 'leftbigger';} ?>" id="nav">
				<?php endif; ?>

						<jdoc:include type="modules" name="position-7"  style="beezDivision" headerLevel="3" />
						<jdoc:include type="modules" name="position-4" style="beezHide" headerLevel="3" state="0 " />
						<jdoc:include type="modules" name="position-5" style="beezTabs" headerLevel="2"  id="3" />

				<?php if (!$templateparams->get('html5', 0)): ?>
					</div><!-- end navi -->
				<?php else: ?>
					</nav>
				<?php endif; ?>
			<?php endif; ?>

					<div class="wrap"></div>

				</div> <!-- end contentarea -->

			</div><!-- back -->

		</div><!-- all -->

		<div id="footer-outer">

		<?php if ($showbottom) : ?>
			<div id="footer-inner">

				<div id="bottom">
					<?php if ($this->countModules('position-9')): ?>
					<div class="box box1"> <jdoc:include type="modules" name="position-9" style="beezDivision" headerlevel="3" /></div>
					<?php endif; ?>
					   <?php if ($this->countModules('position-10')): ?>
					<div class="box box2"> <jdoc:include type="modules" name="position-10" style="beezDivision" headerlevel="3" /></div>
					<?php endif; ?>
					<?php if ($this->countModules('position-11')): ?>
					<div class="box box3"> <jdoc:include type="modules" name="position-11" style="beezDivision" headerlevel="3" /></div>
					<?php endif ; ?>
				</div>
			</div>
		<?php endif ; ?>

			<div id="footer-sub">

			<?php if (!$templateparams->get('html5', 0)): ?>
				<div id="footer">
			<?php else: ?>
				<footer id="footer">
			<?php endif; ?>

					<jdoc:include type="modules" name="position-14" />
					<p>
						<?php echo JText::_('TPL_BEEZ5_POWERED_BY');?> <a href="http://www.joomla.org/">Joomla!&#174;</a>
					</p>

			<?php if (!$templateparams->get('html5', 0)): ?>
				</div><!-- end footer -->
			<?php else: ?>
				</footer>
			<?php endif; ?>

			</div>

		</div>
		<jdoc:include type="modules" name="debug" />
	</body>
</html>
