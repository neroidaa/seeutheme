<?php $this->layout = 'left-column'; ?>

<?php if(false && $page != null): ?>
	<?php
		$cs = Yii::app()->getClientScript();
		$cs->registerLinkTag("alternate","application/rss+xml",Yii::app()->createUrl(':'.$page->id).'?rss',null,array('title'=>Yii::t('news','South East European University').' - '.$page->page_title));
	?>

	<ul id="social" style="float: right;">
		<li><a id="rss" title="<?php echo Yii::t('navigation','RSS Channel')?>" href="<?php echo Yii::app()->createUrl(':'.$page->id)?>?rss"></a></li>
	</ul>

	<h1><?php echo $page->page_title ?></h1>
	<?php echo $page->content ?>
<?php else: ?>
	<h1><?php echo Yii::t('newsletter', 'Newsletter no.') ?> <?php echo $model->number ?></h1>
<?php endif; ?>

<ul class="article-list" style="list-style: none; padding: 0">
<?php $articles = CcNewsletterContent::model()->localized()->findAllByAttributes(array('newsletter_id'=>$model->id)); ?>
<?php foreach($articles as $i => $article): ?>
	<?php $hasPicture = file_exists(YiiBase::getPathOfAlias('webroot.images.newsletters').'/'.$article->getPictureName()); ?>
	<li style="margin-bottom: 30px;" class="article <?php echo $hasPicture ? 'thumb' : 'no-thumb' ?>">
		<?php if($hasPicture):?>
			<img style="max-width: 200px; float: left; margin: 0 10px 10px 0" src="/images/newsletters/<?php echo $article->getPictureName() ?>" alt="" />
		<?php endif; ?>
		<h3><a href="<?php echo Yii::app()->createUrl(':'.$page->id)?>?nid=<?php echo $model->id?>&id=<?php echo $article->id?>"><?php echo $article->title ?></a></h3>
		<p><?php echo $article->introduction ?></p>
		<div style="clear: left"></div>
	</li>
<?php endforeach; ?>
</ul>
