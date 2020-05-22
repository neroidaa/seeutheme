<?php $this->layout = 'left-column'; ?>

<?php if($page != null): ?>
	<h1><?php echo $page->page_title ?></h1>
	<?php echo $page->content ?>
<?php else: ?>
	<h1><?php echo Yii::t('programme', 'Academic Programmes') ?></h1>
<?php endif; ?>

<?php
	$locations = array(
		'te' => Yii::t('programme','Tetovo'),
		'sk' => Yii::t('programme','Skopje'),
	);
	$cycles = array(
		'Undergraduate' => Yii::t('programme','Undergraduate Studies'),
		'Postgraduate' => Yii::t('programme','Postgraduate Studies'),
	);
?>

<?php foreach($locations as $lc => $location): ?>
	<h3 class="location-name" style="border-bottom: 1px solid #009"><?php echo $page->page_title ?> - <?php echo $location ?></h3>
	<div class="programme-list">
	<?php foreach($departments as $i => $department): ?>
		<?php
			$number = AcProgram::model()->countByAttributes(array('department_id'=>$department->id, 'active'=>1, 'distance_'.$lc=>1));
		?>
		<?php if($number > 0): ?>
		<div class="department">
			<h3 class="department-name"><?php echo $department->name ?></h3>

			<ul class="programme-cycles">
				<?php foreach($cycles as $cycleKey => $cycleName): ?>
				<?php
					$criteria = new CDbCriteria;
					$criteria->condition = "department_id={$department->id}";
					$criteria->addCondition("cycle='$cycleKey'");
					$criteria->mergeWith($filterCriteria);

					//$criteria->order = 'cycle DESC';
					$programmes = AcProgram::model()->localized()->findAll($criteria);
				?>
				<?php if(count($programmes)): ?>
				<li>
					<h5><?php echo $cycleName ?></h5>
					<ul class="programme-list">
					<?php foreach($programmes as $i => $programme): ?>
						<li class="programme">
							<a class="programme-link" href="<?php echo Yii::app()->createUrl(':'.$_GET['nav'],array('id'=>$programme->id))?>">
								<strong><?php echo $programme->name ?></strong>
							</a>
							<span>
							</span>
						</li>
					<?php endforeach; ?>
					</ul>
				</li>
				<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
	<?php endforeach; ?>
	</div>

<?php endforeach; ?>

<?php
$cs = Yii::app()->getClientScript();
$cs->registerScript('programme/index:show-programme-description', "
	$('a.programme-link').hover(function(){
		$('div.programme-description').hide();
		$(this).parent().find('div.programme-description').slideDown();
	});
");