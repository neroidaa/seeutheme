<?php $this->layout = 'left-column'; ?>

<div class="row-fluid">
	<div class="span8">
		<?php if($page != null): ?>
			<h1><?php echo $page->page_title ?></h1>
			<?php echo $page->content ?>
		<?php else: ?>
			<h1><?php echo Yii::t('programme', 'Study programmes') ?></h1>
		<?php endif; ?>

	<?php if(count($result)): ?>
	<div id="programme-list">
	<?php foreach($result as $i => $department): ?>
		<div class="department well well-small" style="background: #fff; border-radius: 0;">
					<h3 class="department-name">
						<i class="icon-th-large icon-white"></i> <?php echo $department['name'] ?>
					</h3>
											<?php  
											if(!empty($ects)) {
										switch($ects)
										{
											//case '180' : $ects = array( '180' => '180 ects'); break;
											case '120' : $ects = array( '120' => 'Model: 3+2 (120 ECTS)'); break;
											case '60' : $ects = array( '60' => 'Model: 4+1 (60 ECTS)'); break;
										}
									} else {
										$ects = array(
											//'180' => '180 ects',
											'120' => Yii::t('programme','Model: 3+2 (120 ECTS)'),
											'60' => Yii::t('programme','Model: 4+1 (60 ECTS)'),
										);
									}
					?>				
							
							<?php foreach($department['cycles'] as $cycleKey => $cycle): ?>
								
									<?php if($bothCycles): ?>
										<h5><?php echo $cycle['name'] ?></h5>
									<?php endif; ?>
									<ul class="facultylist">

									<?php foreach ($ects as $ectsKey => $ectsName): ?>	
									<?php 
									if($cycleKey == 'Postgraduate') {
										echo '<span style="margin-top: 8px;" class="label label-inverse">'.$ectsName.' </span> '; 
									}
									?>
								


									<?php foreach($cycle['programmes'] as $i => $programme): ?>
										<?php if($ectsKey == $programme->ects && $cycleKey == 'Postgraduate'): ?>
										<a class="programme-link" href="<?php echo Yii::app()->createUrl(':'.$_GET['nav'],array('id'=>$programme->id))?>">
										<li class="programme">
											<i class="icon-ok-sign"></i> 
											<?php if($programme->code) { 
											echo '['.$programme->code.']'; 
											} ?>
												<strong><?php echo $programme->name ?></strong>
												<br />
												<?php if(!empty($programme->subname)) { ?>
												<span class="label label-info" style="font-size: .8em">
												<?php echo $programme->subname ?></span>
												<?php } ?>
											<span>
											</span>
										</li>
										</a>
										<?php endif; ?>
									<?php endforeach; ?>
									<?php endforeach; ?>

									<?php foreach($cycle['programmes'] as $i => $programme): ?>
								<?php if($cycleKey == 'Undergraduate' || $cycleKey == 'PhD' ): ?>
									
								<a class="programme-link" href="<?php echo Yii::app()->createUrl(':'.$_GET['nav'],array('id'=>$programme->id))?>">
								<li class="programme">
									<i class="icon-ok-sign"></i> 
									<?php if($programme->code) { 
											echo '['.$programme->code.']'; 
											} ?>
										<strong><?php echo $programme->name ?></strong>
										<br />
							
							<?php if(!empty($programme->subname)) { ?>
							<span class="label label-info" style="font-size: .8em">
							<?php echo $programme->subname ?></span>
							<?php } ?>
									
									<span>
									</span>
								</li></a>

							<?php endif; ?>

							<?php endforeach; ?>


									</ul>
								
							<?php endforeach; ?>								
				</div>
		<?php endforeach; ?>
			</div>							
	<?php else: ?>
			<p><?php echo Yii::t('programme', 'No programmes were found.') ?></p>
		<?php endif; ?>

	</div>
	<div class="span4">
		<div class="programme-filter well well-small">
			<h1><?php echo Yii::t('programme', 'Search by Faculty'); ?></h1>
			<?php
			$form = $this->beginWidget('CActiveForm', array(
				'id'=>'programme-filter-form',
				'enableAjaxValidation'=>false,
			));

			$cs = Yii::app()->getClientScript();
			$cs->registerScript("tabs","
				$('.filter-change').change(function(){
					$('#programme-filter-form').submit();
				});
			");

			$criteria = new CDbCriteria;
			$criteria->order = 't.name ASC';
			$criteria->condition = "t.type = 'academic'";
			$faculties = array(0=>'') + CHtml::listData(Department::model()->localized()->findAll($criteria), 'id', 'name');
			$cycles = array(
				''=>'',
				'Undergraduate'=>Yii::t('programme','Undergraduate Studies'),
				'Postgraduate'=>Yii::t('programme','Postgraduate Studies'),
				'PhD'=>Yii::t('programme','PhD Studies'),
			);
			$locations = array(
				''=>'',
				'tetovo' => Yii::t('programme','Tetovo'),
				'skopje' => Yii::t('programme','Skopje'),
			);
			$language = array(
				''=>'',
				'en' => 'Offered in English',
			);
			$distance = array(
				'all' => Yii::t('programme', 'All programmes'),
				'regular' => Yii::t('programme', 'Only regular study programmes'),
				'distance' => Yii::t('programme', 'Only distance learning programmes'),
			);
			?>

				<?php echo Yii::t('programme', 'Faculty'); ?>:<br/>
				<?php echo $form->dropDownList($filter, 'faculty', $faculties, array('class'=>'filter-change span12')); ?>

				<?php echo Yii::t('programme', 'Cycle'); ?>:<br/>
				<?php if($bothCycles): ?>
					<?php echo $form->dropDownList($filter, 'cycle', $cycles, array('class'=>'filter-change span12')); ?>
				<?php else: ?>
					<?php echo $form->dropDownList($filter, 'cycle', $cycles, array('class'=>'filter-change span12', 'disabled'=>'disabled')); ?>
				<?php endif; ?>

				<?php echo Yii::t('programme', 'Location'); ?>:<br/>
				<?php echo $form->dropDownList($filter, 'location', $locations, array('class'=>'filter-change span12')); ?>
				<br />
				<br />

				<?php echo Yii::t('programme', 'Offered in English'); ?>:
				<?php echo $form->checkBox($filter, 'language', array('class'=>'filter-change span12')); ?>
				
				<br /><br />

				<?php echo Yii::t('programme', 'Type'); ?>:<br/>
				<?php echo $form->dropDownList($filter, 'distance', $distance, array('class'=>'filter-change span12')); ?>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>




<?php
$cs = Yii::app()->getClientScript();
$cs->registerScript('programme/index:show-programme-description', "
	$('a.programme-link').hover(function(){
		$('div.programme-description').hide();
		$(this).parent().find('div.programme-description').slideDown();
	});
");