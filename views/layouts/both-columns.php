<?php $this->beginContent('//layouts/main'); ?>
	<?php echo $content; ?>
	<div class="clear"></div>
	<?php include_once(dirname(__FILE__).'/content-bottom.php'); ?>
<?php $this->endContent(); ?>