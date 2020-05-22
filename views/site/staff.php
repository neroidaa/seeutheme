<?php $this->layout = 'left-column'; ?>

<?php if(!empty($page)): ?>
	<h1><?php echo $page->page_title ?></h1>
<?php endif; ?>

<?php if(!empty($page->picture) && file_exists(YiiBase::getPathOfAlias('webroot.images.pages').'/'.$page->picture)): ?>
	<img width="476" style="margin-top: 10px" src="/images/pages/<?php echo $page->picture?>" />
<?php endif; ?>

<?php echo $page->content ?>

<?php
$count = count($departments);

$titles = array(
	'undefined' => '',
	'full-professor' => Yii::t('staff','Full Professor'),
);
?>

<?php foreach($departments as $department): ?>

	<?php if($count): ?>
		<h2 class="staff-list"><?php echo $department->name ?></h2>
	<?php endif; ?>

	<ul class="staff-list">
	<?php
	$criteria = new CDbCriteria;
	$criteria->order = '`order` ASC';
	$positions = StaffPosition::model()->localized()->findAll($criteria);
	?>
	<?php foreach($positions as $position): ?>
		<?php
			$criteria= new CDbCriteria;
			$criteria->addCondition('department_id='.$department->id);
			$criteria->addCondition('position_id='.$position->id);
			$criteria->order = 't.full_name ASC';

			foreach(Staff::model()->localized()->findAll($criteria) as $i => $staff): ?>
			<li class="grid_4">
				<?php if(!empty($staff->picture) && file_exists(YiiBase::getPathOfAlias('webroot.images.staff').'/'.$staff->picture)):?>
					<img border="0" src="/images/staff/<?php echo $staff->picture?>" />
				<?php else: ?>
					<img border="0" src="/images/staff/profile-picture-seeu.jpg" />
				<?php endif; ?>
				<a href="<?php echo Yii::app()->createUrl('/staff/view',array('slug'=>$staff->slug))?>" class="full-name"><?php echo $staff->full_name?></a><br />

				<?php if($staff->position_id == 0): ?>
					<span class="title"><?php echo $staff->title?></span>
				<?php elseif($staff->position_id != null): ?>
					<?php $position = StaffPosition::model()->localized()->findByPk($staff->position_id); ?>
					<span class="title"><?php echo $position->title?></span>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	<?php endforeach; ?>
	</ul>

<?php endforeach; ?>
