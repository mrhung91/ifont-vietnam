<?php // no direct access
defined('_JEXEC') or die('Restricted access');


?>

<div class="sticky<?php echo $params->get( 'moduleclass_sfx' ) ?>">

	<?php if ($headerText) : ?>
		<div class="bannerheader"><?php echo $headerText ?></div>
	<?php endif; ?>


	<div class="sticky-content">
		<?php echo $item->introtext . $item->fulltext; ?>
	</div>

	<?php if ($footerText) : ?>
		<div class="bannerfooter<?php echo $parameters->get( 'moduleclass_sfx' ) ?>">
			 <?php echo $footerText ?>
		</div>
	<?php endif; ?>
</div>