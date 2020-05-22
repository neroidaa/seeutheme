<?php
	$this->breadcrumbs = array(
		array(
			'link' => Yii::t('navigation','Home'),
			'url' => Yii::app()->createUrl('/'),
		),
		array(
			'link' => Yii::t('navigation','Sitemap'),
			// 'url' => Yii::app()->createUrl('/featured'),
		),
	);
?>

<?php if(!empty($page)): ?>
	<h1><?php echo $page->page_title ?></h1>
<?php else: ?>
	<h1><?php echo Yii::t('navigation','Sitemap')?></h1>
<?php endif; ?>

<?php if(!empty($page->introduction)): ?>
	<p class="introduction"><?php echo $page->introduction ?></p>
<?php endif; ?>


<?php if(!empty($page->picture) && file_exists(YiiBase::getPathOfAlias('webroot.images.pages').'/'.$page->picture)): ?>
<img style="width: 100%" src="/images/pages/<?php echo $page->picture?>" />
<?php endif; ?>

<?php
	$root = Page::model()->findByPk(1);
?>

<div class="row-fluid sitemap">
	<?php foreach($root->children()->localized()->findAll() as $i => $level1): ?>
		<?php if($i < 7): ?>
			<div class="span3">
				<h3><a href="<?php echo Yii::app()->createUrl(':'.$level1->id)?>"><?php echo $level1->title ?></a></h3>
				<ul>
					<?php foreach($level1->children()->localized()->findAll() as $j=>$level2): ?>
						<li><a href="<?php echo Yii::app()->createUrl(':'.$level2->id)?>"><?php echo $level2->title ?></a></li>
					<?php endforeach; ?>
				</ul>
				<div class="clear"></div>
			</div>
			<?php if($i % 4 == 3): ?>
			</div><div class="row-fluid">
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
	<div class="span3">
		<h3><?php echo Yii::t('navigation','Contact')?> &amp; <?php echo Yii::t('navigation','Feedback')?></a></h3>
		<ul>
			<li><a href="<?php echo Yii::app()->createUrl('/contact').'?id=55'?>"><?php echo Yii::t('navigation','Feedback')?></a></li>
			<li><a href="<?php echo Yii::app()->createUrl('/contact')?>"><?php echo Yii::t('navigation','Contact')?></a></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>

<style type="text/css">
.main .wrap section.content li {margin-bottom: 5px; line-height: 1em}
</style>
