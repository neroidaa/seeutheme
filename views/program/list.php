<?php $this->layout = 'left-column'; ?>

<?php if($this->page != null): ?>
	<h1><?php echo $this->page->page_title ?></h1>
	<?php echo $this->page->content ?>
<?php else: ?>
	<h1><?php echo Yii::t('programme', 'Academic Programmes') ?></h1>
<?php endif; ?>

<?php
$cycles = array(
	'Undergraduate' => Yii::t('programme','Undergraduate Studies'),
	'Postgraduate' => Yii::t('programme','Postgraduate Studies'),
	'PhD' => Yii::t('programme','Doctoral Studies'),
);
?>

<div id="programme-list">
<?php foreach($departments as $i => $department): ?>
	
	<div class="department">
		<?php if(count($departments)) :?>
		<h4 class="department-name">
			<i class="icon-th-large icon-white"></i> <?php echo $department->name ?>
		</h4>
		<?php endif; ?>
		
			<?php foreach($cycles as $cycleKey => $cycleName): ?>
			<?php
				$criteria = new CDbCriteria;
				$criteria->condition = "department_id={$department->id}";
				$criteria->addCondition("cycle='$cycleKey'");
				$criteria->addCondition("code!=''");
				$criteria->addCondition("active='1'");

				//$criteria->order = 'cycle DESC';
				$programmes = AcProgram::model()->localized()->findAll($criteria);
			?>
			<?php if(count($programmes)): ?>
			<div class="well well-small" style="background: #fff; border-radius: 0;">
				<h5><?php echo $cycleName ?></h5>
				<ul class="facultylist">
				<?php foreach($programmes as $i => $programme): ?>
					<a class="programme-link" href="<?php echo Yii::app()->createUrl(':'.$_GET['nav'],array('id'=>$programme->id))?>">
					<li class="programme">
							<i class="icon-ok-sign"></i> <?php if($programme->code != '') { echo '['.$programme->code.']'; } ?> <strong><?php echo $programme->name ?><br />
							
							<?php if(!empty($programme->subname)) { ?>
							<span class="label label-info" style="font-size: 0.9em">
							<?php echo $programme->subname ?></span>
							<?php } ?>
							</strong>
						
						<span>
						</span>
					</li>
					</a>
				<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php endforeach; ?>
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