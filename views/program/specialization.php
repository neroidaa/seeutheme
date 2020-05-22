<?php $this->layout = 'left-column'; ?>

<div class="row-fluid">
	<div class="span12">
		<?php if($page != null): ?>
			<h1><?php echo $page->page_title ?></h1>
			<?php echo $page->content ?>
		<?php else: ?>
			<h1><?php echo Yii::t('programme', 'Study programmes') ?></h1>
		<?php endif; ?>

		<div id="programme-list">

			<?php foreach($departments as $i => $department): ?>

				<?php
							$criteriaa = new CDbCriteria;
							$criteriaa->condition = "department_id={$department->id}";
							$criteriaa->addCondition("cycle='Postgraduate'");
							$criteriaa->addCondition("code IS NOT NULL");
							$criteriaa->addCondition("code !=''");
							//$criteria->addCondition("active='1'");
							//$criteria->addCondition("specialization='1'");
							//$criteria->addCondition("specialization IS NULL");
							//$criteria->addCondition("specialization =0", 'OR');
							$criteriaa->mergeWith($filterCriteria);

							$criteriaa->order = 'ects DESC';
							$programmess = AcProgram::model()->localized()->findAll($criteriaa);
						?>

				<?php if(count($programmess)>0): ?>		
				<div class="department well well-small" style="background: #fff; border-radius: 0;">

					<?php if(count($departments)) :?>

					<h3 class="department-name">
						<i class="icon-th-large icon-white"></i> <?php echo $department->name ?> 
					</h3>
					<?php endif; ?>
					<?php
						if(!empty($cycle)) {
							switch($cycle)
							{
								case 'Undergraduate' : $cycles = array( 'Undergraduate' => Yii::t('programme','Undergraduate Studies')); break;
								case 'Postgraduate' : $cycles = array( 'Postgraduate' => Yii::t('programme','Postgraduate Studies')); break;
								//case 'PhD' : $cycles = array( 'PhD' => Yii::t('programme','Doctoral Studies')); break;
							}
						} else {
							$cycles = array(
								'Undergraduate' => Yii::t('programme','Undergraduate Studies'),
								'Postgraduate' => Yii::t('programme','Postgraduate Studies'),
								//'PhD' => Yii::t('programme','Doctoral Studies'),
							);
						}

							
					?>
					
						<?php foreach($cycles as $cycleKey => $cycleName): ?>
						<?php
							$criteria = new CDbCriteria;
							$criteria->condition = "department_id={$department->id}";
							$criteria->addCondition("cycle='$cycleKey'");
							$criteria->addCondition("code IS NOT NULL");
							$criteria->addCondition("code !=''");
							//$criteria->addCondition("active='1'");
							//$criteria->addCondition("specialization='1'");
							//$criteria->addCondition("specialization IS NULL");
							//$criteria->addCondition("specialization =0", 'OR');
							$criteria->mergeWith($filterCriteria);

							$criteria->order = 'ects DESC';
							$programmes = AcProgram::model()->localized()->findAll($criteria);
						?>
						<?php if(count($programmes)): ?>
							<?php if($bothCycles): ?>
								
								<h5><?php echo $cycleName ?></h5>
							<?php endif; ?>

							<ul class="facultylist">

							<?php foreach($programmes as $i => $programme): ?>
								
								<a class="programme-link" href="<?php echo Yii::app()->createUrl(':'.$_GET['nav'],array('id'=>$programme->id))?>">
								<li class="programme">
									<i class="icon-ok-sign"></i>
									<?php if($programme->code) { 
											echo '['.$programme->code.']'; 
											} ?>

										<strong><?php echo $programme->name ?></strong>
							
										<?php if(!empty($programme->subname)) { ?>
										<span class="" style="font-size: .9em">
										<?php echo '['.$programme->subname.']' ?></span>
										<?php } ?>
									
									<span>
									</span>
								</li></a>

							<?php endforeach; ?>

							</ul>
						<?php endif; ?>
						<?php endforeach; ?>
				
				</div>
			<?php endif; ?>
			<?php endforeach; ?>
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
