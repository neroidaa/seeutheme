<?php $this->layout = 'both-columns'; ?>


<div class="row-fluid">
	<div class="span9">
		<?php if($page != null): ?>
			<h1><?php echo $page->page_title ?></h1>
			<?php echo $page->content ?>
		<?php else: ?>
			<h1><?php echo Yii::t('defence', 'Public defences') ?></h1>
		<?php endif; ?>


		<ul class="defence-list" style="list-style: none; margin-left: 0">
		<?php foreach($defences as $i => $defence): ?>
			<li style="margin-bottom: 40px;" class="defence">
				<?php
					$myTime = strtotime($defence->date);
					$day = date('d', $myTime);
				 	$month = $this->_mylocale->dateFormatter->format('MMMM',$myTime);
					$time = sprintf("%02d:%02d", $defence->hour, $defence->min);

					$department = $departments[$defence->department_id];
				?>
				<div class="calendar-date defences">
					<p style="margin-bottom: 0">
						<?php echo $day?>
						<span><?php echo $month?></span>
					</p>
					<div style="text-align: center; font-size: 1.1em; margin-top: 10px;"><?php echo $time ?></div>
				</div>

				<div style="padding-left: 90px;">
					<div style="border-bottom: 1px solid #bbb; font-size: 0.9em; margin: 0; padding: 3px 0; color: #888">
						<?= Yii::t('defence', $defence->type == 'master' ? 'Master thesis' : 'PhD thesis') ?>
					</div>

					<span><?php echo $defence->name ?></span>

					<h3 style="margin: 5px 0">
						<?php echo $defence->title ?>
					</h3>

					<div style="border-top: 1px solid #bbb; font-size: 0.9em; margin: 0; padding: 5px 0; color: #888">
						<div style="float: right">
							<?= Yii::t('defence', 'Department') ?>: <?= $department ?>
							<br>
							<?= Yii::t('defence', 'Mentor') ?>:
							<?php if (null != ($staff = Staff::model()->localized()->findByPk($defence->mentor_staff_id) )): ?>
								<a href="<?php echo Yii::app()->createUrl('/staff/view',array('slug'=>$staff->slug))?>" class="full-name">
									<?php
										$position = StaffPosition::model()->localized()->findByPk($staff->position_id);
										$prefix = $position->salutation;
										$fullName = !empty($staff->first_name)  ? $staff->first_name.' '.$staff->last_name : $staff->full_name;
									?>
									<?= $prefix . $fullName ?>
								</a>
							<?php else: ?>
								<a href="mailto:<?= $defence->email ?>"><?= $defence->mentor ?></a>
							<?php endif; ?>
						</div>
						<div>
							<?= Yii::t('defence', 'Location') ?>: <?= Yii::t('app', $defence->location == 'te' ? 'Tetovo' : 'Skopje') ?>
							<br>
							<?= Yii::t('defence', 'Room') ?>: <?= $defence->place ?>
						</div>
					</div>
				</div>

			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<div class="span3">
		<div class="programme-filter well well-small">
			<h4><?php echo Yii::t('programme', 'Search by'); ?></h4>
			<?php
			$form = $this->beginWidget('CActiveForm', array(
				'id'=>'defence-filter-form',
				'enableAjaxValidation'=>false,
			));

			$cs = Yii::app()->getClientScript();
			$cs->registerScript("tabs","
				$('.filter-change').change(function(){
					$('#defence-filter-form').submit();
				});
			");

			$criteria = new CDbCriteria;
			$criteria->order = 't.name ASC';
			$criteria->condition = "t.type = 'academic'";
			$faculties = array(0=>'') + CHtml::listData(Department::model()->localized()->findAll($criteria), 'id', 'name');
			$cycles = array(
				''=>'',
				'master'=>Yii::t('defence','Master thesis'),
				'phd'=>Yii::t('defence','PhD thesis'),
			);
			$locations = array(
				''=>'',
				'te' => Yii::t('defence','Tetovo'),
				'sk' => Yii::t('defence','Skopje'),
			);
			?>

				<?php echo Yii::t('programme', 'Faculty'); ?><br/>
				<?php echo $form->dropDownList($filter, 'faculty', $faculties, array('class'=>'filter-change span12')); ?>

				<?php echo Yii::t('programme', 'Cycle'); ?><br/>
				<?php echo $form->dropDownList($filter, 'cycle', $cycles, array('class'=>'filter-change span12')); ?>

				<?php echo Yii::t('programme', 'Location'); ?><br/>
				<?php echo $form->dropDownList($filter, 'location', $locations, array('class'=>'filter-change span12')); ?>

			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>
