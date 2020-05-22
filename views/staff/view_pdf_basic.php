<?php

	if(!empty($model->picture) && file_exists(YiiBase::getPathOfAlias('webroot.images.staff').'/'.$model->picture))
	{
		$picture = $model->picture;
	}
	else
	{
		$picture = 'profile-picture-seeu.jpg';
	}
	$staffPicture = YiiBase::getPathOfAlias('webroot.images.staff').'/'.$picture;
?>

<table cellpadding="0" cellspacing="6" border="0">
	<tr>
		<td width="120"><img src="<?php echo $staffPicture ?>" border="0" height="110" width="110" /></td>
		<td>
			<?php
				$engagements = array('full' => Yii::t('profile','Full time'), 'part' => Yii::t('profile','Part time'));
				$engagement = ($model->engagement != null) ? $engagements[$model->engagement] : '';
			?>

			<?php if($model->department_id != 0 && null != ($department = Department::model()->localized()->findByPk($model->department_id))): ?>
				<?php if($department->type=='academic'): ?>
					<?php echo Yii::t('profile','Faculty') ?> : <b><?php echo Department::model()->localized()->findByPk($model->department_id)->name ?></b><br />
				<?php else: ?>
					<?php echo Yii::t('profile','Department') ?> : <b><?php echo Department::model()->localized()->findByPk($model->department_id)->name ?></b><br />
				<?php endif; ?>
			<?php endif; ?>
			<?php if($model->position_id != 0 && null != ($position = StaffPosition::model()->localized()->findByPk($model->position_id))): ?>
				<?php echo Yii::t('profile','Position') ?> : <b><?php echo $position->title?></b><br />
			<?php endif; ?>


			<h4><?php echo Yii::t('profile','Personal data') ?></h4>
			<?php if($model->birthday_format == 2): ?>
				<?php echo Yii::t('profile','Date of birth') ?> : <b><?php echo $this->_mylocale->dateFormatter->format('d MMMM yyyy',strtotime($model->birthday)); ?></b><br />
			<?php elseif($model->birthday_format == 1): ?>
				<?php echo Yii::t('profile','Date of birth') ?> : <b><?php echo $this->_mylocale->dateFormatter->format('d MMMM',strtotime($model->birthday)); ?></b><br />
			<?php endif; ?>
			<?php
				$slug = str_replace('@seeu.edu.mk', '', $model->email);
			?>
			E-mail : <strong><?php echo $slug?>@seeu.edu.mk</strong><br />
			<?php if(!empty($model->address)): ?>
				<?php echo Yii::t('profile','Address') ?> : <b><?php echo $model->address ?></b><br />
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


			<?php if(count($model->languages)): ?>

				<h4><?php echo Yii::t('profile','Languages') ?></h4>
				<ul>
				<?php foreach($model->languages as $record): ?>
					<li class="language">
						<strong><?php echo $record->languageName ?></strong>, <?php echo $record->languageLevel ?>
					</li>
				<?php endforeach; ?>
				</ul>

			<?php endif; ?>
		</td>
	</tr>
</table>