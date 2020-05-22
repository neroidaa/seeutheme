<?php if(!empty($page)): ?>
        <h1><?php echo $page->page_title ?></h1>
<?php endif; ?>

<?php if(!empty($page->introduction)): ?>
        <p class="introduction"><?php echo $page->introduction ?></p>
<?php endif; ?>


<?php if(!empty($page->picture) && file_exists(YiiBase::getPathOfAlias('webroot.images.pages').'/'.$page->picture)): ?>
<img style="width: 100%" src="/images/pages/<?php echo $page->picture?>" />
<?php endif; ?>


<div id="page-content">
<?php echo 
        preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#u', '', $page->content);
?>
</div>

<?php
$count = count($departments);
?>

<?php foreach($departments as $department): ?>

	<?php if($count): ?>
		<h2 class="staff-list"><?php echo $department->name ?></h2>
	<?php endif; ?>

	<div class="staff-list" style="margin-top: 30px;">

		<?php
			$criteria = new CDbCriteria;
			$criteria->order = '`order` ASC';
			$positions = StaffPosition::model()->localized()->findAll($criteria);

			$engagements = array('full' => Yii::t('profile','Full time staff'), 'part' => Yii::t('profile','Part time staff'));
		?>

		<?php foreach($engagements as $engagementType => $engagement): ?>
			<h3 style="background-color: #00AFEF;padding: 8px;color: #fff;"><?php echo $engagement ?></h3>
<hr style="border-style: dotted;"/>
			<?php
				$i = 1;
			?>

			<div class="row-fluid">
				<?php foreach($positions as $position): ?>
					<?php
						$criteria= new CDbCriteria;
						$criteria->condition = 'active=1';
						$criteria->addCondition('department_id='.$department->id);
						$criteria->addCondition('position_id='.$position->id);
						$criteria->addCondition('engagement="'.$engagementType.'"');
						$criteria->order = 't.engagement ASC, t.first_name ASC, t.last_name ASC';
					?>

					<?php foreach(Staff::model()->localized()->findAll($criteria) as $staff): ?>
						<?php
							if(!empty($staff->picture) && file_exists(YiiBase::getPathOfAlias('webroot.images.staff').'/'.$staff->picture)) {
								$picture = $staff->picture;
							} else {
								$picture = 'profile-picture-seeu.jpg';
							}
						?>

						<div class="span4" style="float: left">
							<img style="margin: 0 10px 30px 0; float: left; width: 80px; height: 80px;" border="0" src="/images/staff/<?php echo $picture?>">
							<a href="<?php echo Yii::app()->createUrl('/staff/view',array('slug'=>$staff->slug))?>" class="full-name">
								<?php echo !empty($staff->first_name)  ? $staff->first_name.' '.$staff->last_name : $staff->full_name ?></a>
							<br>

							<?php if($staff->position_id != 0 && null != ($position = StaffPosition::model()->localized()->findByPk($staff->position_id))): ?>
								<small class="title"><?php echo $position->title?></small>
							<?php endif; ?>
						</div>

						<?php if($i++ % 3 === 0): ?>
						</div>
						<div class="row-fluid">
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>

<?php endforeach; ?>
