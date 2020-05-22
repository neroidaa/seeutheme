<?php
	$fileName = $model->first_name.'-'.$model->last_name.'-SEEU-CV.pdf';
?>

<section itemscope itemtype="http://data-vocabulary.org/Person">

	<a class="pull-right" href="<?php echo Yii::app()->createUrl('staff/view',array('slug'=>$model->slug)).'/'.$fileName?>">
		<img style="background: transparent; border: none; padding: 0; margin: 0" src="<?php echo Yii::app()->theme->baseUrl ?>/img/icons/pdf.png" border="0"
			width="32" height="32"><?php echo Yii::t('profile','Export')?>
	</a>

	<h1>
		<span itemprop="name">
			<?php if(!empty($model->first_name) && !empty($model->last_name)): ?>
				<?php echo $model->first_name?> <?php echo $model->last_name?>
			<?php else: ?>
				<?php echo $model->full_name?>
			<?php endif; ?>
		</span>

		<?php if(!empty($model->linkedin)): ?>
			<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>
			<script type="IN/MemberProfile" data-id="<?php echo $model->linkedin?>" data-format="hover"></script>
		<?php endif; ?>
	</h1>

	<div class="row-fluid">

		<div class="span3">
			<?php if(!empty($model->picture) && file_exists(YiiBase::getPathOfAlias('webroot.images.staff').'/'.$model->picture)):?>
				<img hspace="4" vspace="4" src="/images/staff/<?php echo $model->picture?>" />
			<?php else: ?>
				<img hspace="4" vspace="4" src="/images/staff/profile-picture-seeu.jpg" />
			<?php endif; ?>
		</div>

		<div class="span6">
			<?php
				$engagements = array('full' => Yii::t('profile','Full time'), 'part' => Yii::t('profile','Part time'));
				$engagement = ($model->engagement != null) ? $engagements[$model->engagement] : '';
			?>
			<div>
				<?php if($model->department_id != 0 && null != ($department = Department::model()->localized()->findByPk($model->department_id))): ?>
					<?php if($department->type=='academic'): ?>
						<?php echo Yii::t('profile','Faculty') ?> : <b><?php echo Department::model()->localized()->findByPk($model->department_id)->name ?></b><br />
					<?php else: ?>
						<?php echo Yii::t('profile','Department') ?> : <b><?php echo Department::model()->localized()->findByPk($model->department_id)->name ?></b><br />
					<?php endif; ?>
				<?php endif; ?>
				<?php if($model->position_id != 0 && null != ($position = StaffPosition::model()->localized()->findByPk($model->position_id))): ?>
					<?php echo Yii::t('profile','Position') ?> : <b itemprop="title"><?php echo $position->title?></b><br />
				<?php endif; ?>
				<?php echo Yii::t('profile','Engagement type') ?> : <b><?php echo $engagement ?></b><br />
			</div>
			<div>
				<h5><?php echo Yii::t('profile','Personal data') ?></h5>
				<?php if($model->birthday_format == 2): ?>
					<?php echo Yii::t('profile','Date of birth') ?> : <b><?php echo $this->_mylocale->dateFormatter->format('d MMMM yyyy',strtotime($model->birthday)); ?></b><br />
				<?php elseif($model->birthday_format == 1): ?>
					<?php echo Yii::t('profile','Date of birth') ?> : <b><?php echo $this->_mylocale->dateFormatter->format('d MMMM',strtotime($model->birthday)); ?></b><br />
				<?php endif; ?>
				<?php
					$slug = str_replace('@seeu.edu.mk', '', $model->email);
				?>
				E-mail : <strong><a href="#" onclick="this.href='mai' + 'lto:' + '<?php echo $slug?>' + '@' + 'seeu.edu.mk' ; return true;"><?php echo $slug?><!-- @x.x -->@<!-- @x.x -->seeu<!-- -->.<!-- -->edu<!-- -->.<!-- -->mk</a></strong><br />
				<?php if(!empty($model->address)): ?>
					<?php echo Yii::t('profile','Address') ?> : <b itemprop="address" itemscope
    itemtype="http://data-vocabulary.org/Address"><?php echo $model->address ?></b><br />
				<?php endif; ?>
				<?php if(!empty($model->tel)): ?>
					<?php echo Yii::t('profile','Telephone') ?> : <b><?php echo $model->tel ?></b><br />
				<?php endif; ?>
				<?php if(!empty($model->fax)): ?>
					<?php echo Yii::t('profile','Fax') ?> : <b><?php echo $model->fax ?></b><br />
				<?php endif; ?>
				<?php if(!empty($model->mob)): ?>
					<?php echo Yii::t('profile','Mobile') ?> : <b><?php echo $model->mob ?></b><br />
				<?php endif; ?>
			</div>
			<?php if(count($model->languages)): ?>
			<div class="languages">
				<h5><?php echo Yii::t('profile','Languages') ?>
					<span style="margin-left:20px;">(
					<a target="blank" href="http://en.wikipedia.org/wiki/Common_European_Framework_of_Reference_for_Languages#Common_reference_levels"><?php echo Yii::t('profile','Self-evaluated') ?></a>
					)</span>
				</h5>
				<?php foreach($model->languages as $record): ?>
					<div class="language">
						<?php $this->renderPartial('/admin/profile/language_record', array('record'=>$record)); ?>
					</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>

	</div>
	<?php
		$educations 	= $model->educations;
		$experiences 	= $model->experiences;
		$publications 	= $model->publications;
	?>

	<div class="staff-records">

	<?php if(count($educations)): ?>
	<h3><?php echo Yii::t('profile','Education') ?></h3>
	<ul>
		<?php foreach($educations as $record): ?>
			<li>
				<?php $this->renderPartial('/admin/profile/education_record', array('record'=>$record)); ?><br/><br/>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>

	<?php if(count($publications)): ?>
	<h3><?php echo Yii::t('profile','Publications') ?></h3>
	<ul>
		<?php foreach($publications as $record): ?>
			<li>
				<?php $this->renderPartial('/admin/profile/publication_record', array('record'=>$record)); ?><br/><br/>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>

	<?php if(count($experiences)): ?>
	<h3><?php echo Yii::t('profile','Work Experience') ?></h3>
	<ul>
		<?php foreach($experiences as $record): ?>
			<li>
				<?php $this->renderPartial('/admin/profile/experience_record', array('record'=>$record)); ?><br/><br/>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>

	</div>

</section>

<style type="text/css">
	.main .wrap section.content p, .main .wrap section.content li {
		margin-bottom: 0;
	}
	.staff-records h3 {
		border-bottom: 1px solid #777;
	}
	.language div {
		float: left;
	}
	.language div.grid_2 {
		width: 160px;
		clear: left;
	}
	.language div.grid_4 {
		font-style: italic;
	}
</style>