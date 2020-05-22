<div style="font-family: Helvetica, Arial, sans-serif; font-size: 12px">

	<?php if(isset($email)): ?>
	<p style="float: right;">
		Read online in:
		<a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/en/newsletter/index/id/<?php echo $model->id?>">english</a>,
		<a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/sq/newsletter/index/id/<?php echo $model->id?>">albanian</a>,
		or
		<a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/mk/newsletter/index/id/<?php echo $model->id?>">macedonian</a>
	</p>
	<?php endif; ?>

	<div class="nl-newsletter" style="clear: both; width:730px; margin: 10px auto;border: 1px solid #ccc;">

		<table width="730" border="0" cellpadding="0" cellspacing="0" bgcolor="#253a5e" style="border-bottom: 10px solid #d8d9d9">
		<tr style="background-color: #253a5e">
			<td valign="top" width="530">
				<img align="left" src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/<?php echo Yii::app()->theme->baseUrl?>/images/newsletter-left.png" width="458" height="120" />
			</td>
			<td valign="top" width="150" style="text-align: center; color: #fff;">
				<div style="width: 100%; font-size: 55px; line-height: 60px; border-bottom: 3px solid #fff; padding: 10px 0 0 0;">
					<?php echo $model->number ?>
				</div>
				<?php
					$mylocale = Yii::app()->getLocale(Yii::app()->language);
					$monthNames = $mylocale->getMonthNames('abbreviated', $standAlone=false)
				?>
				<div style="width: 100%; padding-top: 7px; font-size: 14px; line-height: 16px;">
					<?php echo $monthNames[$model->start_month] ?>
					<?php echo $model->end_month !=$model->start_month && $model->end_month > 0 ? ' - '.$monthNames[$model->end_month] : '' ?>
					<?php echo $model->year ?>
				</div>
			</td>
			<td valign="top" width="50">
				<img align="right" src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/<?php echo Yii::app()->theme->baseUrl?>/images/newsletter-right.png" width="50" height="120" />
			</td>
		</tr>
		</table>

		<div style="padding: 15px;">

			<?php
				$criteria = new CDbCriteria;
				$criteria->condition = '`newsletter_id` = '.$model->id;
				$criteria->addCondition('`type` = "main"');
				$article = NewsletterContent::model()->localized()->find($criteria);
			?>
			<?php
				$criteria = new CDbCriteria;
				$criteria->condition = '`newsletter_id` = '.$model->id;
				$criteria->addCondition('`type` = "short"');
				$shortArticles = NewsletterContent::model()->localized()->findAll($criteria);
			?>
			<?php
				$criteria = new CDbCriteria;
				$criteria->condition = '`newsletter_id` = '.$model->id;
				$criteria->addCondition('`type` = "link"');
				$linkArticles = NewsletterContent::model()->localized()->findAll($criteria);
			?>
			<?php
				$criteria = new CDbCriteria;
				$criteria->condition = 'number < ' . $model->number;
				$criteria->order = 'number DESC';
				$criteria->limit = 5;
				$past = Newsletter::model()->findAll($criteria)
			?>


			<table width="710" border="0" cellpadding="0" cellspacing="0" style="margin-top: 5px;">
			<tr>
				<td valign="top" class="nl-article nl-article-main" colspan="3">
					<h3 style="margin: 0; padding: 0; font-size: 22px; font-weight: normal;">
						<a target="_blank" href="http://<?php echo $_SERVER['SERVER_NAME'] ?><?php echo Yii::app()->createUrl('/information/newsletter') . '?nid='.$model->id.'&id='.$article->id?>"><?php echo $article->title?></a>
					</h3>
					<?php if(!empty($article->picture)): ?>
					<img align="left" style="border: 1px solid #77b; border-bottom: 5px solid #77b; padding: 0; margin: 5px 10px 5px 0;" src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/images/newsletters/<?php echo $article->picture ?>" width="266" height="177" />
					<?php endif; ?>
					<p><strong><?php echo $article->introduction ?></strong></p>
					<p><?php echo $article->content ?></p>
					<div style="clear: both;"></div>
				</td>
			</tr>
			<tr>
				<td valign="top" width="535">
					<table width="535" border="0">
						<tr>
							<?php foreach($shortArticles as $i => $article): ?>
								<td valign="top" width="165" class="nl-article nl-article-short">
									<?php if(!empty($article->picture)): ?>
									<img style="margin: 0 0 5px 0; border: 1px solid #77b; border-bottom: 5px solid #77b; padding: 0;"
										src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/images/newsletters/<?php echo $article->picture ?>" width="165" />
									<?php endif; ?>
									<h3 style="clear: both; margin: 0; padding: 0; font-size: 14px;">
										<a target="_blank" href="http://<?php echo $_SERVER['SERVER_NAME'] ?><?php echo Yii::app()->createUrl('/information/newsletter') . '?nid='.$model->id.'&id='.$article->id?>"><?php echo $article->title?></a>
									</h3>
									<p><?php echo $article->introduction ?></p>
									<p><a target="_blank" href="http://<?php echo $_SERVER['SERVER_NAME'] ?><?php echo Yii::app()->createUrl('/information/newsletter') . '?nid='.$model->id.'&id='.$article->id?>">
									<?php echo Yii::t('newsletter', 'Read more'); ?> ...
									</a></p>
								</td>
						<?php if(($i+1) % 3 == 0): ?>
							</tr>
							<tr>
						<?php else: ?>
							<td width="20"></td>
						<?php endif; ?>
							<?php endforeach; ?>
						</tr>
					</table>
				</td>
				<td width="10" rowspan="2"></td>
				<td valign="top" width="165" rowspan="2" style="background-color: #eee; padding: 5px;">
					<h4 style="margin: 0; padding: 0;"><?php echo Yii::t('newsletter','Past editions'); ?></h4>
					<ul style="padding-left: 20px;">
						<?php foreach($past as $nl): ?>
							<li><a target="_blank" href="http://<?php echo $_SERVER['SERVER_NAME'] ?><?php echo Yii::app()->createUrl('/information/newsletter') . '?nid='.$nl->id?>"><?php echo Yii::t('newsletter','Newsletter no.') ?> <?php echo $nl->number ?></a></li>
						<?php endforeach; ?>
						<li><a href="/files/newsletter/newsletter-12.pdf"><?php echo Yii::t('newsletter', 'Newsletter no.') ?> 12</a></li>
					</ul>
				</td>
			</tr>
			<tr>
				<td valign="top" style="border-top: 1px solid #ddd; padding-top: 10px">
					<?php if(count($linkArticles)): ?>
					<h3 style="margin: 0; padding: 0;"><?php echo Yii::t('newsletter','Other articles'); ?></h3>
						<ul style="padding-left: 20px;">
						<?php foreach($linkArticles as $article): ?>
							<li style="padding-top: 10px;">
								<a target="_blank" href="http://<?php echo $_SERVER['SERVER_NAME'] ?><?php echo Yii::app()->createUrl('/information/newsletter') . '?nid='.$model->id.'&id='.$article->id?>"><?php echo $article->title?></a>
							</li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</td>
			</tr>
			</table>

		</div>

		<div class="nl-footer" style="padding: 10px; background-color: #253a5e; border-top: 5px solid #d8d9d9; color: #eee;">
			&copy; 2011 - <?php echo date('Y') ?>. <?php echo Yii::t('app','South East European University'); ?>.<br />
		</div>
	</div>

	<?php if(isset($email) && $email !== false): ?>
	<p style="text-align: center;">
		<small>Unsubscribe</small>
	</p>
	<?php endif; ?>

</div>