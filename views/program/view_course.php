<?php

$courseDetail = AcCourseDetail::model()->localized()->findByPK($course->course_detail_id);
$courseDetail->description = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$courseDetail->description);

?>
<h1>
	<?php echo Yii::t('programme', 'Course'); ?>: <?php echo $courseDetail->name ?>
</h1>


<div class="course-details-show">
	<?php if(!empty($courseDetail->description)): ?>
		<?php echo $courseDetail->description?>
	<?php endif; ?>
	<?php if($course->type == 'free-elective'): ?>
		<?php foreach(AcCatalog::model()->localized()->findAllByAttributes(array('free_elective'=>1)) as $catalog): ?>
			<h5 style="padding-left: 20px;"><?php echo $catalog->name ?></h5>
			<ul class="course-children">
			<?php foreach(AcCourseDetail::model()->localized()->findAllByAttributes(array('catalog_id'=>$catalog->id)) as $fec): ?>
				<li class="closed">
					<strong class="course-name course-name-l2"><a href="#"><?php echo $fec->name?></a></strong>
					<div class="course-details" style="display: none;">
						<?php if(!empty($fec->description)): ?>
							<?php echo $fec->description?>
						<?php endif; ?>
					</div>
				</li>
			<?php endforeach; ?>
			</ul>
		<?php endforeach; ?>
	<?php elseif($course->type == 'elective'): ?>
		<?php if(count($course->children)): ?>
			<ul class="course-children">
			<?php foreach($course->children as $k => $c): ?>
				<?php $cd = AcCourseDetail::model()->localized()->findByPK($c->course_detail_id); ?>
				<li class="closed">
					<strong class="course-name course-name-l2"><a href="#"><?php echo $cd->name?></a></strong>
					<div class="course-details" style="display: none;">
						<?php if(!empty($cd->description)): ?>
							<?php echo $cd->description?>
						<?php endif; ?>
					</div>
				</li>
			<?php endforeach; ?>
			</ul>
		<?php elseif(($catalog = $course->catalog) != null): ?>
			<?php if(count($catalog->courseDetails)): ?>
				<ul class="course-children">
				<?php foreach(AcCourseDetail::model()->localized()->findAllByAttributes(array('catalog_id'=>$catalog->id)) as $fec): ?>
					<li class="closed">
						<strong class="course-name course-name-l2"><a href="#"><?php echo $fec->name?></a></strong>
						<div class="course-details" style="display: none;">
							<?php if(!empty($fec->description)): ?>
								<?php echo $fec->description?>
							<?php endif; ?>
						</div>
					</li>
				<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
</div>

<?php return; ?>

<h5>
	<strong><?php echo Yii::t('programme', 'Cycle'); ?>:</strong> <?php echo Yii::t('programme',$programme->cycle)?>
	<br />
	<strong><?php echo Yii::t('programme', 'Department'); ?>:</strong> <?php echo $department->name?>
	<br />
	<strong><?php echo Yii::t('programme', 'Offered in'); ?>:</strong>
	<?php
		if($programme->offered_te && $programme->offered_sk) {
			echo Yii::t('programme', 'Tetovo');
			echo " ", Yii::t('programme', 'and');
			echo " ", Yii::t('programme', 'Skopje');
		} elseif($programme->offered_sk) {
			echo Yii::t('programme', 'Skopje');
		} else {
			echo Yii::t('programme', 'Tetovo');
		}
	?>
	<?php if($programme->lang_checked): ?>
		<br />
		<strong><?php echo Yii::t('programme', 'Offered in one of these languages'); ?>:</strong>
		<?php
			$langs = array();
			if($programme->lang_en) $langs[] = Yii::t('programme', 'English');
			if($programme->lang_sq) $langs[] = Yii::t('programme', 'Albanian');
			if($programme->lang_mk) $langs[] = Yii::t('programme', 'Macedonian');
			echo implode(', ', $langs);
		?>
	<?php endif; ?>

</h5>

<div id="programme-tabs">

	<ul class="nav nav-tabs">
		<li class="active"><a href="#programme-description" data-toggle="tab"><?php echo Yii::t('programme', 'Description'); ?></a></li>
		<li><a href="#programme-career" data-toggle="tab"><?php echo Yii::t('programme', 'Career'); ?></a></li>
		<li><a href="#programme-lod" data-toggle="tab"><?php echo Yii::t('programme', 'Learning outcomes'); ?></a></li>
		<li><a href="#programme-courses" data-toggle="tab"><?php echo Yii::t('programme', 'List of courses'); ?></a></li>
	</ul>

	<?php
		// Cleanup some dirty texts
		$programme->description = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$programme->description);
		$programme->career = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$programme->career);
		$programme->lod_1 = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$programme->lod_1);
		$programme->lod_2 = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$programme->lod_2);
		$programme->lod_3 = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$programme->lod_3);
		$programme->lod_4 = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$programme->lod_4);
		$programme->lod_5 = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$programme->lod_5);
	?>

	<div id="programmeTabContent" class="tab-content">


		<div class="tab-pane fade in active" id="programme-description">
			<?php echo $programme->description?>
		</div>

		<div class="tab-pane fade" id="programme-career">
			<?php echo $programme->career?>
		</div>

		<div class="tab-pane fade" id="programme-lod">
			<h5><?php echo Yii::t('programme', 'Knowledge and understanding'); ?></h5>
			<?php echo $programme->lod_1?>
			<h5><?php echo Yii::t('programme', 'Applying knowledge and understanding'); ?></h5>
			<?php echo $programme->lod_2?>
			<h5><?php echo Yii::t('programme', 'Making judgement'); ?></h5>
			<?php echo $programme->lod_3?>
			<h5><?php echo Yii::t('programme', 'Communication skills'); ?></h5>
			<?php echo $programme->lod_4?>
			<h5><?php echo Yii::t('programme', 'Learning skills'); ?></h5>
			<?php echo $programme->lod_5?>
		</div>


		<?php
			$semesters = array();
			for($i = 1; $i <= $programme->semesters; $i++) {
				$semesters[$i] = array(
					0 => array(
						'conc' => 'Default Concentration',
						'courses'=>array(),
					),
				);
			}
			$conc = AcProgramConcentration::model()->localized()->findAllByAttributes(array('program_id'=>$programme->id));
			if(count($conc)) {
				foreach($conc as $c) {
					foreach($c->semestersArray as $s) {
						if(isset($semesters[$s]) && !isset($semesters[$s][$c->id])) {
							$semesters[$s][$c->id] = array(
								'conc' => $c->name,
								'courses'=>array(),
							);
						}
					}
				}
			}
			foreach($programme->courses as $i => $course) {
				if($course->concentration_id != null && isset($semesters[$course->semester][$course->concentration_id])) {
					$semesters[$course->semester][$course->concentration_id]['courses'][] = $course;
				} else {
					$semesters[$course->semester][0]['courses'][] = $course;
				}
			}
		?>

		<div class="tab-pane fade" id="programme-courses">
			<?php foreach($semesters as $i => $semesterData):?>
				<h3><?php echo Yii::t('programme', 'Semester');?> <?php echo $i ?></h3>
				<?php foreach($semesterData as $cid => $cdata): ?>
					<?php if($cid > 0): ?>
						<h5><?php echo Yii::t('programme','Concentration: ')?><?php echo $cdata['conc'] ?></h5>
					<?php endif; ?>
					<ul class="program-courses">
					<?php foreach($cdata['courses'] as $course): ?>
						<?php
							// Cleanup some descriptions
							$courseDetail = AcCourseDetail::model()->localized()->findByPK($course->course_detail_id);
							$courseDetail->description = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$courseDetail->description);
						?>
						<li class="closed">
							<strong class="course-name course-name-l1" style="font-size:1.05em">
								<a href="<?php echo Yii::app()->createUrl('/program/course',array('id'=>$course->id))?>"><?php echo $courseDetail->name?></a>
							</strong>
							<span class="course-credits" style="padding-left: 15px;">(<?php echo $course->ects?> ECTS)</span> 
							<div class="course-details">
								<?php if(!empty($courseDetail->description)): ?>
									<?php echo $courseDetail->description?>
								<?php endif; ?>
								<?php if($course->type == 'free-elective'): ?>
									<?php foreach(AcCatalog::model()->localized()->findAllByAttributes(array('free_elective'=>1)) as $catalog): ?>
										<h5 style="padding-left: 20px;"><?php echo $catalog->name ?></h5>
										<ul class="course-children">
										<?php foreach(AcCourseDetail::model()->localized()->findAllByAttributes(array('catalog_id'=>$catalog->id)) as $fec): ?>
											<li class="closed">
												<strong class="course-name course-name-l2"><a href="#"><?php echo $fec->name?></a></strong>
												<div class="course-details" style="display: none;">
													<?php if(!empty($fec->description)): ?>
														<?php echo $fec->description?>
													<?php endif; ?>
												</div>
											</li>
										<?php endforeach; ?>
										</ul>
									<?php endforeach; ?>
								<?php elseif($course->type == 'elective'): ?>
									<?php if(count($course->children)): ?>
										<ul class="course-children">
										<?php foreach($course->children as $k => $c): ?>
											<?php $cd = AcCourseDetail::model()->localized()->findByPK($c->course_detail_id); ?>
											<li class="closed">
												<strong class="course-name course-name-l2"><a href="#"><?php echo $cd->name?></a></strong>
												<div class="course-details" style="display: none;">
													<?php if(!empty($cd->description)): ?>
														<?php echo $cd->description?>
													<?php endif; ?>
												</div>
											</li>
										<?php endforeach; ?>
										</ul>
									<?php elseif(($catalog = $course->catalog) != null): ?>
										<?php if(count($catalog->courseDetails)): ?>
											<ul class="course-children">
											<?php foreach(AcCourseDetail::model()->localized()->findAllByAttributes(array('catalog_id'=>$catalog->id)) as $fec): ?>
												<li class="closed">
													<strong class="course-name course-name-l2"><a href="#"><?php echo $fec->name?></a></strong>
													<div class="course-details" style="display: none;">
														<?php if(!empty($fec->description)): ?>
															<?php echo $fec->description?>
														<?php endif; ?>
													</div>
												</li>
											<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						</li>
					<?php endforeach; ?>
					</ul>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</div>
    </div>

</div>

<style>
.main .wrap section.content .nav li {
	margin-bottom: 0;
}
#programme-courses li {
	margin-bottom: 7px;
}
</style>


<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/bootstrap/js/bootstrap-tab.js');
$cs->registerScript('programme-view:tabs',"
	$('#programme-tabs p, #programme-tabs div div').each(function() {
		var \$this = $(this);
		if(\$this.html().replace(/\s|&nbsp;/g, '').length == 0)
			\$this.remove();
	});
	$('strong.course-name a').click(function(){
		$(this).parent().parent().toggleClass('closed').find('> div.course-details').slideToggle();
		return false;
	});
");
