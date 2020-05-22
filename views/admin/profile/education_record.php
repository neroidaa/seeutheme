<strong><?php
	if($record->start_month > 0) echo date("M", mktime(0, 0, 0, $record->start_month, 1, 2000)).' ';
	echo $record->start_year;
?>
 -
<?php
	if($record->end_month > 0) echo date("M", mktime(0, 0, 0, $record->end_month, 1, 2000)).' ';
	echo $record->end_year;
?>: <?php echo $record->title ; ?>
</strong>
<br />

<?php if(!empty($record->faculty)): ?>
	Faculty: <?php echo $record->faculty ?><br />
<?php endif; ?>

<?php if(!empty($record->institution_url)): ?>
	<a href="<?php echo $record->institution_url?>" target="_blank"><em><?php echo $record->institution ?></em></a>, <?php echo $record->place ?>
<?php else: ?>
	<em><?php echo $record->institution ?></em>, <?php echo $record->place ?>
<?php endif; ?>


<?php if(!empty($record->specialty)): ?>
	<br /><em>Specialty:</em>
	<?php echo $record->specialty ?>
<?php endif; ?>

<?php if(!empty($record->thesis)): ?>
	<br /><strong>Thesis:</strong>
	<?php if(!empty($record->thesis_url)): ?>
		"<a target="_blank" href="<?php echo $record->thesis_url?>"><?php echo $record->thesis ?></a>"
	<?php else: ?>
		"<?php echo $record->thesis ?>"
	<?php endif; ?>
<?php endif; ?>
