<?php
	$this->breadcrumbs = array(
		array(
			'link' => Yii::t('app','Home'),
			'url' => Yii::app()->createUrl('/'),
		),
		array(
			'link' => Yii::t('app','Features'),
			// 'url' => Yii::app()->createUrl('/featured'),
		),
	);
?>

<h1><?php echo $model->title ?></h1>

<?php if(!empty($model->introduction)): ?>
	<p class="introduction">
		<?php echo $model->introduction?>
	</p>
<?php endif; ?>



<?php if(!empty($model->picture) && file_exists(YiiBase::getPathOfAlias('webroot.images.featured').'/'.$model->picture)):?>
	<img style="margin-bottom: 20px;" src="/images/featured/<?php echo $model->picture ?>">
<?php endif; ?>

<div class="row-fluid">
	<div class="span7">

		<div class="body"><?php echo 
		preg_replace('#&nbsp;+#', ' ', preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', $model->body));
		?></div>
	</div>
	<div class="span5">
		<div style="padding-bottom: 30px;"><?php $this->renderPartial('//layouts/addthis'); ?></div>
		<?php
			$criteria 				= new CDbCriteria;
			$criteria->condition 	= "id<>{$model->id}";
			$criteria->order 		= "date DESC";
			$criteria->limit 		= 4;
			$moreFeatured = Featured::model()->localized()->findAll($criteria);

			$baseUrl = isset($_GET['nav']) && $_GET['nav'] > 0 ? ":{$_GET['nav']}" : '/featured/view';
		?>
		<?php if(count($moreFeatured)): ?>

		<div class="more-featured bottom-module">
			<h4><?php echo Yii::t('app','Current features')?></h4>
			<?php foreach($moreFeatured as $featured) if(!empty($featured->title)): ?>
			<div class="row-fluid" style="margin: 30px 0;">
				<div class="span5">
					<img style="width: 100%;" src="/images/featured/thumbs/<?php echo $featured->picture ?>">
				</div>
				<div class="span7" style="padding: 0 0 0 10px;">
					<a href="<?php echo Yii::app()->createUrl($baseUrl, array('id'=>$featured->id))?>"><?php echo $featured->title?></a>
					<p style="font-size:0.9em; line-height:1.4em; color:#666;"><?php echo $featured->subtitle?></p>
				</div>
			</div>
			<?php endif; ?>
		<?php endif; ?>
		</div>
	</div>
</div>
