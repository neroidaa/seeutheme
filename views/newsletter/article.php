<article itemscope itemtype="http://schema.org/Article">
	<h1 itemprop="name"><?php echo $article->title ?></h1>

	<?php if(!empty($article->introduction)): ?>
		<p itemprop="articleSection" class="introduction">
			<?php echo $article->introduction?>
		</p>
	<?php endif; ?>

	<div style="padding-bottom: 30px;"><?php $this->renderPartial('//layouts/addthis'); ?></div>

	<?php if(file_exists(YiiBase::getPathOfAlias('webroot.images.newsletters').'/'.$article->getPictureName())):?>
		<img itemprop="image" style="float: right" src="/images/newsletters/<?php echo $article->getPictureName() ?>">
	<?php endif; ?>

	<div itemprop="articleBody" class="body"><?php echo 
	preg_replace('#&nbsp;+#', ' ', preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', $article->content));
	?></div>

	<?php $criteria 				= new CDbCriteria;
		$criteria->condition 	= "newsletter_id={$model->id}";
		$articles = NewsletterContent::model()->localized()->findAll($criteria);
	?>

	<?php if(count($articles)): ?>
	<div class="more-news">
		<h4><?php echo Yii::t('newsletter','In this newsletter')?></h4>
		<ul>
			<?php foreach($articles as $article): ?>
			<li><a href="<?php echo Yii::app()->createUrl('/information/newsletter') . '?nid='.$model->id.'&id='.$article->id?>"><?php echo $article->title?></a></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	</div>
</article>
