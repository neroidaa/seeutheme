<?php $this->beginContent('//layouts/main'); ?>
	<div class="grid_16 main-middle">
		<?php echo $content; ?>
		<div class="clear"></div>
		<?php include_once(dirname(__FILE__).'/content-bottom.php'); ?>
	</div>
<?php $this->endContent(); ?>