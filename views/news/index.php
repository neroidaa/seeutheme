<?php $this->layout = 'both-columns'; ?>

<?php if($page != null): ?>
	<?php
		$cs = Yii::app()->getClientScript();
		$cs->registerLinkTag("alternate","application/rss+xml",Yii::app()->createUrl(':'.$page->id).'?rss',null,array('title'=>Yii::t('news','South East European University').' - '.$page->page_title));
	?>

	<!-- AddThis Follow BEGIN -->
	<div class="addthis_toolbox addthis_32x32_style addthis_default_style" style="float: right;">
		<a class="addthis_button_rss_follow" addthis:userid="<?php echo Yii::app()->createUrl(':'.$page->id) ?>?rss"></a>
	</div>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-512d436577c2a560"></script>
	<!-- AddThis Follow END -->

	<h1><?php echo $page->page_title ?></h1>
	<?php echo $page->content ?>
<?php else: ?>
	<h1><?php echo Yii::t('news', 'Latest News') ?></h1>
<?php endif; ?>

<ul class="article-list" style="list-style: none; padding-left: 0; margin: 0 0 10px 0px;">
<?php foreach($news as $i => $article): ?>
	<?php $hasPicture = !empty($article->picture) && file_exists(YiiBase::getPathOfAlias('webroot.images.news').'/'.$article->picture); ?>
	<li style="background-color: #F5F5F5;box-shadow: 0px 0px 2px #d0d0d0" class="article <?php echo $hasPicture ? 'thumb' : 'no-thumb' ?>">
		<?php if($hasPicture):?>
		<div class="thumbnailnews">
			<img style="border: none;" src="/images/news/<?php echo $article->picture ?>">
		</div>
		<?php endif; ?>
		<div style="padding: 10px;">
		<h3 class="title">
			<a href="<?php echo Yii::app()->createUrl(':'.$page->id)?>?id=<?php echo $article->id?>"><?php echo $article->title ?></a>
		</h3>
		<div class="article-summary">
			<span class="date" style="font-size: 0.8em;color: #9A9A9A;">
				<?php echo Yii::t('news', '{date}', array('{date}'=>$this->formatMysqlDate($article->date)) ) ?>
			</span>
			<p style="padding: 0px 5px 0px 0px;"><?php echo $article->subtitle?></p>
			
		</div>
	</div>
		<div style="clear: left"></div>
	</li>
<?php endforeach; ?>
</ul>

<div style="margin: 15px 0">
<?php $this->widget('CLinkPager', array(
	'pages'=>$pages
)); ?>
</div>