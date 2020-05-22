<?php $this->layout = 'left-column'; ?>

<?php if($page != null): ?>
	<h1><?php echo $page->page_title ?></h1>
	<?php if(!empty($page->picture) && file_exists(YiiBase::getPathOfAlias('webroot.images.pages').'/'.$page->picture)): ?>
	<img style="width: auto; max-width: 480px; margin: 10px" src="/images/pages/<?php echo $page->picture?>" />
	<?php endif; ?>
	<?php echo $page->content ?>
<?php else: ?>
	<h1><?php echo Yii::t('newsletter', 'Archive') ?></h1>
<?php endif; ?>

<?php foreach($archive as $nl): ?>
	<h2 style="clear:left"><?php echo Yii::t('newsletter', 'Newsletter no.') ?> <?php echo $nl->number ?></h2>

	<ul style="list-style: none;">
	<?php $articles = NewsletterContent::model()->localized()->findAllByAttributes(array('newsletter_id'=>$nl->id)); ?>
	<?php foreach($articles as $i => $article): ?>
		<?php $hasPicture = file_exists(YiiBase::getPathOfAlias('webroot.images.newsletters.thumbs').'/'.$article->getPictureName()); ?>
		<li style="clear: left; padding-top: 20px; margin-bottom: 0" class="article <?php echo $hasPicture ? 'thumb' : 'no-thumb' ?>">
			<?php if($i == 0 && $hasPicture):?>
				<img style="float:left; max-width: 200px" src="/images/newsletters/<?php echo $article->getPictureName() ?>" alt="" />
				<a href="<?php echo Yii::app()->createUrl(':'.$page->id)?>?nid=<?php echo $nl->id?>&id=<?php echo $article->id?>"><?php echo $article->title ?></a>
				<p><?php echo $article->introduction ?></p>
			<?php else: ?>
				<a href="<?php echo Yii::app()->createUrl(':'.$page->id)?>?nid=<?php echo $nl->id?>&id=<?php echo $article->id?>"><?php echo $article->title ?></a>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
	</ul>

<?php endforeach; ?>

<h2 style="clear:left"><?php echo Yii::t('newsletter', 'Newsletter no.') ?> 12</h2>
<ul>
<li><a href="/files/newsletter/newsletter-12.pdf"><?php echo Yii::t('newsletter', 'Download the PDF file') ?></a></li>
</ul>

