<?php $this->layout = 'left-column'; ?>

<?php if($page != null): ?>
	<h1><?php echo $page->page_title ?></h1>
	<?php echo $page->content ?>
<?php else: ?>
	<h1><?php echo Yii::t('programme', 'Academic Programmes') ?></h1>
<?php endif; ?>

<div class="programme-filter">
	<h4><?php echo Yii::t('programme', 'Filter'); ?></h4>
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
	$faculties = array(0=>'') + CHtml::listData(Department::model()->localized()->findAll($criteria), 'id', 'name');
	$cycles = array(
		''=>'',
		'Undergraduate'=>Yii::t('programme','Undergraduate Studies'),
		'Postgraduate'=>Yii::t('programme','Postgraduate Studies'),
	);
	$locations = array(
		''=>'',
		'tetovo' => Yii::t('programme','Tetovo'),
		'skopje' => Yii::t('programme','Skopje'),
	);
	$distance = array(
		'all' => Yii::t('programme', 'All programmes'),
		'regular' => Yii::t('programme', 'Regular study programmes'),
		'distance' => Yii::t('programme', 'Part-time study programmes'),
	);
	?>
	<div class="row">
		<?php echo Yii::t('programme', 'by Faculty'); ?><br/>
		<?php echo $form->dropDownList($filter, 'faculty', $faculties, array('class'=>'filter-change')); ?>
	</div>
	<?php if($bothCycles): ?>
	<div class="row">
		<?php echo Yii::t('programme', 'by Cycle'); ?><br/>
		<?php echo $form->dropDownList($filter, 'cycle', $cycles, array('class'=>'filter-change')); ?>
	</div>
	<?php endif;?>
	<div class="row">
		<?php echo Yii::t('programme', 'by Location'); ?><br/>
		<?php echo $form->dropDownList($filter, 'location', $locations, array('class'=>'filter-change')); ?>
	</div>
	<div class="row">
		<?php echo Yii::t('programme', 'by Type'); ?><br/>
		<?php echo $form->radioButtonList($filter, 'distance', $distance, array('class'=>'filter-change')); ?>
	</div>
	<?php $this->endWidget(); ?>
</div>


<div class="programme-list">
<?php foreach($departments as $i => $department): ?>
	<div class="department">
		<?php if(count($departments)) :?>
		<h4 class="department-name">
			<?php echo $department->name ?>
		</h4>
		<?php endif; ?>
		<?php
			if(!empty($cycle)) {
				$cycles = ($cycle == 'Undergraduate') ?
				  array( 'Undergraduate' => Yii::t('programme','Undergraduate Studies'))
				: array( 'Postgraduate' => Yii::t('programme','Postgraduate Studies'));
			} else {
				$cycles = array(
					'Undergraduate' => Yii::t('programme','Undergraduate Studies'),
					'Postgraduate' => Yii::t('programme','Postgraduate Studies'),
				);
			}
		?>
		<ul class="programme-cycles">
			<?php foreach($cycles as $cycleKey => $cycleName): ?>
			<?php
				$criteria = new CDbCriteria;
				$criteria->condition = "department_id={$department->id}";
				$criteria->addCondition("cycle='$cycleKey'");

				$criteria->mergeWith($filterCriteria);

				//$criteria->order = 'cycle DESC';
				$programmes = Programme::model()->localized()->findAll($criteria);
			?>
			<?php if(count($programmes)): ?>
			<li>
				<?php if($bothCycles): ?>
				<h5><?php echo $cycleName ?></h5>
				<?php endif; ?>
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
<?php endforeach; ?>
</div>

<?php
$cs = Yii::app()->getClientScript();
$cs->registerScript('programme/index:show-programme-description', "
	$('a.programme-link').hover(function(){
		$('div.programme-description').hide();
		$(this).parent().find('div.programme-description').slideDown();
	});
");