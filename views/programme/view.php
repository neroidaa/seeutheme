<?php $this->layout = 'left-column'; ?>

<h1>
	<?php echo Yii::t('programme', 'Programme'); ?>: <?php echo $programme->name?>
</h1>
<h6>
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
	
</h6>

<div id="programme-tabs">
	<ul>
		<li><a href="#programme-description"><?php echo Yii::t('programme', 'Description'); ?></a></li>
		<li><a href="#programme-career"><?php echo Yii::t('programme', 'Career'); ?></a></li>
		<li><a href="#programme-courses"><?php echo Yii::t('programme', 'List of courses'); ?></a></li>
	</ul>

	<div id="programme-description">
			<?php
				// Cleanup some dirty texts
				$programme->description = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$programme->description);
				$programme->career = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$programme->career);
			?>
		<?php echo $programme->description?>
	</div>

	<div id="programme-career">
		<?php echo $programme->career?>
	</div>


	<div id="programme-courses">
		<table border="0" cellpadding="4" cellspacing="0" class="course-list">
		<?php for($i=1; $i <= $programme->semesters; $i++):?>
			<thead>
				<th colspan="3"><?php echo Yii::t('programme', 'Semester');?>: <?php echo $i ?></th>
				<th><?php echo Yii::t('programme', 'ECTS');?></th>
			</thead>
			<?php
				$criteria = new CDbCriteria;
				$criteria->condition = "semester=$i AND programme_id={$programme->id}";
				$criteria->order = "elective ASC";
				$courses = Course::model()->localized()->findAll($criteria);
			?>
			<?php foreach($courses as $j => $course): ?>
			<?php
				// Cleanup some descriptions
				$course->description = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$course->description);
			?>
			<tr class="<?php echo ($j%2 ? 'odd' : 'even') ?>">
				<td><?php echo ($j+1)?></td>
				<td class="closed">
					<?php if(!empty($course->description)): ?>
					<a class="course-name" href="#"><?php echo $course->name?></a>
					<?php else: ?>
					<?php echo $course->name?>
					<?php endif; ?>
				</td>
				<td><?php echo Yii::t('programme',$course->elective ? 'Elective' : 'Core')?></td>
				<td><?php echo $course->ects?></td>
			</tr>
			<?php if(!empty($course->description)): ?>
			<tr class="<?php echo ($j%2 ? 'odd' : 'even') ?>">
				<td colspan="4" class="course-description" style="padding: 0;"><div><?php echo $course->description?></div></td>
			</tr>
			<?php endif; ?>
			<?php endforeach; ?>
		<?php endfor; ?>
		</table>
	</div>
</div>

<style>
div#programme-tabs {
	margin: 20px 0;
	border: none;
	font-size: 12px;
	background: none;
	width: 100%;
}
.ui-tabs-panel, .ui-widget-content, .ui-corner-bottom {
	float: left;
}
.ui-tabs .ui-tabs-panel { padding: 5px 0;}
.ui-widget-header { border: none; border-bottom: 1px solid #0078ae; background: none; color: #eaf5f7; font-weight: bold; }
.ui-corner-all { -moz-border-radius: 0px; -webkit-border-radius: 0px; border-radius: 0px; }

/* Interaction states
----------------------------------*/
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
	border: none;
	background: none; /*#6eac2c url(/themes/jquery/start/images/ui-bg_gloss-wave_50_6eac2c_500x100.png) 50% 50% repeat-x;*/
	color: #555555;
	font-size: 13px;
}
.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited {
	color: #555555;
}
.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus {
	border: none;
	background: #778; /* url(images//themes/jquery/start/ui-bg_glass_75_79c9ec_1x400.png) 50% 50% repeat-x;*/
	color: #ffffff;
}
.ui-state-hover a, .ui-state-hover a:hover {
	color: #ffffff;
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
	border: none;
	background: #0078ae url(/themes/jquery/start/images/ui-bg_glass_45_0078ae_1x400.png) 50% 50% repeat-x;
	background: #0078ae url(/themes/seeu20/images/back-mainmenu.png) 50% 50% repeat-x;
	color: #ffffff;
}
.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited {
	color: #ffffff;
}

</style>
<?php
$cs = Yii::app()->getClientScript();
$cs->registerCssFile('/themes/jquery/start/jquery-ui-1.8.10.custom.css');
$cs->registerScriptFile('/themes/jquery/jquery-ui-1.8.10.custom.min.js');
$cs->registerScript('programme-view:tabs',"
	$('#programme-tabs').tabs();
	$('a.course-name').click(function(){
		$(this).parent().toggleClass('open','closed').parent().next().find('> td.course-description div').slideToggle();
		return false;
	});
");
