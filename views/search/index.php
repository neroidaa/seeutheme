<?php
	$this->breadcrumbs = array(
		array(
			'link' => Yii::t('navigation','Home'),
			'url' => Yii::app()->createUrl('/'),
		),
		array(
			'link' => Yii::t('search','Search results'),
			// 'url' => Yii::app()->createUrl('/featured'),
		),
	);
?>

<h1><?php echo Yii::t('search','Search results')?></h1>

<div id="search-results">
	<?php foreach($results as $i => $result) $this->renderPartial('search-result',array(
	'result'=>$result,
	'class'=> ($i % 2 == 0 ? 'odd' : 'even'),
	)); ?>
</div>

<style type="text/css">
	.search-result {
		padding-bottom: 15px;
	}
	.search-result h5 {
		margin-bottom: 0;
	}
</style>