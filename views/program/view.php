<?php
	$fileName = 'SEEU-Study-Programme-'.$programme->id.'.pdf';
?>
<a class="pull-right" href="<?php echo Yii::app()->createUrl('program/'.$programme->id.'/'.$fileName)?>">
	<img style="background: transparent; border: none; padding: 0; margin: 0" src="<?php echo Yii::app()->theme->baseUrl ?>/img/icons/pdf.png" border="0"
		width="32" height="32"><?php echo Yii::t('profile','Export')?>
</a>

<table>
	<tr>
		<td><h1 style="margin-bottom: 0; padding-bottom: 0; font-weight: normal"><?php echo Yii::t('programme', 'Programme'); ?>:</h1></td>
		<td><h1 style="margin-bottom: 0; padding-bottom: 0"><?php echo $programme->name?></h1></td>
	</tr>
	<?php if($programme->subname) { ?>
	<tr>
		<td colspan="2"><h5 style="margin-bottom: 0; padding-bottom: 0"><?php echo $programme->subname?></h5></td>
	</tr>
	<?php } ?>
</table>

<div class="row-fluid">
	<div class="span6">
			
<table style="margin-top: 20px; margin-bottom: 10px;">
	<tr>
		<td style="text-align: left; font-weight: bold"><?php echo Yii::t('programme', 'Study Cycle'); ?>:</td>
		<td style="padding-left: 10px;">
		<?php 

			if(($programme->cycle == 'Undergraduate') && (Yii::app()->language=='en')) {
				echo 'First Cycle (Undergraduate)';
			} elseif(($programme->cycle == 'Postgraduate') && (Yii::app()->language=='en')) {
				echo 'Second Cycle (Postgraduate)';
			} elseif(($programme->cycle == 'PhD') && (Yii::app()->language=='en')) {
				echo 'Third Cycle (Doctoral)';
			} else {
				echo Yii::t('programme',$programme->cycle);
			}
		
		?>
		</td>
	</tr>
	<tr>
		<td style="text-align: left; font-weight: bold"><?php echo Yii::t('programme', 'Faculty'); ?>:</td>
		<td style="padding-left: 10px;"><?php echo $department->name?></td>
	</tr>
<!--
	<tr>
		<td style="text-align: left; font-weight: bold"><?php echo Yii::t('programme', 'Offered in'); ?>:</td>
		<td style="padding-left: 10px;">
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
		</td>
		</tr>
	-->
</table>
	</div>
	<div class="span6">
		<div class="well" style="margin-top: 21px;">
		<table style="
    font-size: .8em;
    color: #969696;
">
			<?php if($programme->code) { ?>
			<tr>
				<td style="text-align: left; font-weight: bold"><?php echo Yii::t('programme', 'Programme Code'); ?>: </td>
				<td style="padding-left: 10px;"><?php echo $programme->code?></td>
			</tr>
			<?php } ?>
			<?php if($programme->accreditation_date) { ?>
			<tr>
				<td style="text-align: left; font-weight: bold"><?php echo Yii::t('programme', 'Academic year'); ?>:</td>
				<td style="padding-left: 10px;">
					<?php echo date('Y', strtotime($programme->accreditation_date))+1 ?>
					/
					<?php echo date('Y', strtotime($programme->accreditation_date))+2 ?>
				</td>
			</tr>
			<?php if(!($programme->academic_title1 && $programme->academic_title2) && $programme->academic_title1) { ?>
			<tr>
				<td style="text-align: left; font-weight: bold"><?php echo Yii::t('programme', 'Title'); ?>:</td>
				<td style="padding-left: 10px;"><?php echo $programme->academic_title1; ?></td>
			</tr>
			<?php } ?>
			<?php	
			}
			?>

			<?php if($programme->academic_title1 && $programme->academic_title2) { ?>
			<tr style="border-top: 1px solid #ddd">
			<?php } else { ?>
				<tr>
			<?php } ?>
				<td style="text-align: left; font-weight: bold"><?php echo Yii::t('programme', 'ECTS'); ?>:</td>
				<td style="padding-left: 10px;"><?php echo $programme->ects; ?> <span style="
			    font-size: .8em;
			    color: #444;
			    font-weight: normal
			">
				<?php 
						$ects = $programme->ects;

						switch ($ects) {
						    case '180':
						        echo Yii::t('programme', '(3 years)');
						        break;
						    case '120':
						        echo Yii::t('programme', '(2 years)');
						        break;
						    case '240':
						        echo Yii::t('programme', '(extended + 1 year)');
						        break;
						    case '60':
						        echo Yii::t('programme', '(1 year)');
						        break;
						}
				?>

			</span> 

			<?php if($programme->decision1) { ?>
				<a href="/ufiles/decision_accreditation/<?php echo $programme->decision1; ?>" target="_blank"><img src="/ufiles/ACP_PDF%202_file_document.png" style="background: none" width="20px" /></a>

				<a href="/ufiles/decision_accreditation/<?php echo $programme->decision1; ?>" target="_blank" style="font-size: .8em;color: #444;font-weight: normal;margin-left: -12px;"><?php echo Yii::t('programme', 'Accrediation'); ?></a>
			<?php } ?>
			</td>
			</tr>
			<?php if($programme->academic_title1 && $programme->academic_title2) { ?>
			<tr style="border-bottom: 1px solid #ddd">
				<td style="text-align: left; font-weight: bold"><?php echo Yii::t('programme', 'Title'); ?>:</td>
				<td style="padding-left: 10px;"><?php echo $programme->academic_title1; ?></td>
			</tr>
			<?php } ?>
			<?php if($programme->extended == 1) { ?>
			<tr>
				<td style="text-align: left; font-weight: bold"><?php echo Yii::t('programme', 'ECTS'); ?>:</td>
				<td style="padding-left: 10px;"><?php echo $programme->ectsplus; ?>
					<span style="
			    font-size: .8em;
			    color: #444;
			    font-weight: normal
			"><?php echo Yii::t('programme', '(extended + 1 year)'); ?></span> 
			<?php if($programme->decision2) { ?>
				<a href="/ufiles/decision_accreditation/<?php echo $programme->decision2; ?>" target="_blank">  
				<img src="/ufiles/ACP_PDF%202_file_document.png" style="background: none" width="20px" /></a> 

				<a href="/ufiles/decision_accreditation/<?php echo $programme->decision2; ?>" target="_blank" style="font-size: .8em;color: #444;font-weight: normal;margin-left: -12px;">
					<?php echo Yii::t('programme', 'Accrediation'); ?>
				</a>
			<?php } ?>
				</td>
			</tr>
			<?php } ?>
			<?php if($programme->academic_title1 && $programme->academic_title2) { ?>
			<tr style="border-bottom: 1px solid #ddd">
				<td style="text-align: left; font-weight: bold"><?php echo Yii::t('programme', 'Title'); ?>:</td>
				<td style="padding-left: 10px;"><?php echo $programme->academic_title2; ?></td>
			</tr>
			<?php } ?>
		</table>
		</div>	
	</div>
	
</div>

<div id="programme-tabs">

	<ul class="nav nav-tabs">
		<li class="active"><a href="#programme-courses" data-toggle="tab"><?php echo Yii::t('programme', 'List of courses'); ?></a></li>
		<li><a href="#programme-description" data-toggle="tab"><?php echo Yii::t('programme', 'Description'); ?></a></li>
		<li><a href="#programme-career" data-toggle="tab"><?php echo Yii::t('programme', 'Career'); ?></a></li>
		<li><a href="#programme-lod" data-toggle="tab"><?php echo Yii::t('programme', 'Learning outcomes'); ?></a></li>
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


		<div class="tab-pane fade" id="programme-description">
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
								'code' => $c->code,
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

		<div class="tab-pane fade in active" id="programme-courses">
			<?php foreach($semesters as $i => $semesterData):?>
				<?php if($programme->extended == 1) { ?>
				<?php 
					if($i == 7) { ?>
					<hr style="border-bottom: 2px solid #99dfff; margin-top: 33px; "/>
					<span style="
					    float: right;
					    position: relative;
					    margin-top: -28px;
					    font-size: .8em;
					    font-weight: bold;
					    color: #08c;
					"><?php echo $programme->ectsplus; ?> <?php echo Yii::t('programme', 'ECTS'); ?> <?php echo Yii::t('programme', '(extended + 1 year)'); ?><img src="/ufiles/arrow-down-xxl.png" width="35px"/></span>
				<?php
					}
				}
				?>
				<h3><?php 
				if($programme->cycle == 'PhD') {
					if($i == 3) {
						echo Yii::t('programme', 'Semester');
						echo ' '.$i.'/4';
					} elseif($i == 4) {
						echo "";
					} else {
						echo Yii::t('programme', 'Semester');
						echo ' '.$i;
					}
				} else {
					echo Yii::t('programme', 'Semester');
						echo ' '.$i;
				}
				
				 ?></h3>
				<?php foreach($semesterData as $cid => $cdata): ?>
					<?php if($cid > 0): ?>
						<table>
						<tr>
							<td style="text-transform: uppercase;font-weight: bold"><?php echo Yii::t('programme', 'Concentration'); ?>:</td>
							<td><?php echo $cdata['conc'] ?></td>
						</tr>
						<?php if($cdata['code']) { ?>
						<tr>
							<td style="text-align: right; font-weight: bold;"><?php echo Yii::t('programme', 'Code'); ?>:</td>
							<td><?php echo $cdata['code'] ?></td>
						</tr>
						<?php } ?>
						</table>
						
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
								<a href="#">
									<span style="color: #444; font-weight: normal; font-size: 0.7em;"><?php if($course->code) { ?>
									<?php echo '['.$course->code.']' ?>
									<?php	
										}
									?></span>
									<?php 
							$idprogrami = $programme->id;
							if ($idprogrami != 74 && $idprogrami != 78) { ?>
								<span style="color: #444; font-weight: normal; font-size: 0.7em">[<?php echo floor($course->ects);?> <?php echo Yii::t('programme', 'ECTS'); ?>]</span>
							<?php } ?>
								<?php echo $courseDetail->name?></a></strong>
							
							
							<div class="course-details">
								<?php if(!empty($courseDetail->description)): ?>
									<?php echo $courseDetail->description?>
								<?php endif; ?>
								<?php if($course->type == 'free-elective'): ?>
									<?php foreach(AcCatalog::model()->localized()->findAllByAttributes(array('free_elective'=>1, 'cycle'=>$programme->cycle)) as $catalog): ?>
										<h5 style="padding-left: 20px;">

										<?php echo $catalog->name ?></h5>
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
												<strong class="course-name course-name-l2"><a href="#">
												<?php if($c->code) { ?>
													<?php echo '<span style="color: #444; font-weight: normal; font-size: 0.7em;">['.$c->code.']</span>' ?>
													<?php	
														}
													?>
												<?php echo $cd->name?></a></strong>
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
