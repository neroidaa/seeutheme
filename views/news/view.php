<article itemscope itemtype="http://schema.org/Article">
	<h1 itemprop="name"><?php echo $model->title ?></h1>

	<span style="text-transform: capitalize;" itemprop="datePublished" content="<?php echo $model->date?>"><?php echo $this->formatMysqlDate($model->date); ?></span>

	<?php if(!empty($model->subtitle)): ?>
		<p itemprop="articleSection" class="introduction">
			<?php echo $model->subtitle?>
		</p>
	<?php endif; ?>
	<?php if(!empty($model->picture) && file_exists(YiiBase::getPathOfAlias('webroot.images.news').'/'.$model->picture)):?>
		<a href="/images/news/<?php echo $model->picture ?>" target="_blank"><img itemprop="image" class="news-image" src="/images/news/<?php echo $model->picture ?>"></a>
	<?php endif; ?>
	<div itemprop="articleBody" class="body"><?php echo 
	preg_replace('#&nbsp;+#', ' ', preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', $model->body));
	?>

<!-- <?php if(!empty($model->uploadFile)): ?>
	<br />
	<div style="padding: 19px 20px 20px; margin-top: 20px; margin-bottom: 20px;background-color: #fff;border: 2px solid #e5e5e5;">
		
		
			<table>
				<tr>
					<td style="padding: 8px;"><img src="/uploads/img/document-icon.png" /></td><td><h4 style="font-weight: bold; line-height: 15px;"><a href="/uploads/konkurse/<?php echo $model->uploadFile; ?>"><?php echo $model->uploadFile; ?></a></h4></td>
				</tr>
			</table>

	
	</div>
		<br />
			<?php endif; ?> -->
</div>
	<?php
		$criteria 				= new CDbCriteria;
		$criteria->condition 	= "category_id={$model->category_id}";
		$criteria->addCondition ("id<>{$model->id}");
		$criteria->order 		= "date DESC";
		$criteria->limit 		= 7;
		$moreNews = News::model()->localized()->findAll($criteria);

		$baseUrl = isset($_GET['nav']) && $_GET['nav'] > 0 ? ":{$_GET['nav']}" : '/news/view';
	?>
	<div style="clear: left"></div>
	<div class="breadcrumbshow"><?php $this->renderPartial('//layouts/addthis'); ?></div>
	<div style="clear: left"></div>

	<?php if(count($moreNews)): ?>

	<div class="more-news bottom-module">
		<h4 style="font-weight: bold;color: #1788CC;"><?php echo Yii::t('news','More news')?></h4>
		<ul style="padding: 0;margin-left: 17px;list-style-type: square;font-size: 14px;">
			<?php foreach($moreNews as $news) if(!empty($news->title)): ?>
			<li style="margin: 0px;"><a href="<?php echo Yii::app()->createUrl($baseUrl, array('id'=>$news->id))?>"><?php echo $news->title?></a></li>
			<?php endif; ?>
		</ul>
	<?php endif; ?>
	</div>
</article>
