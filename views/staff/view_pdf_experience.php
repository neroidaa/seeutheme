<strong><?php
	if($record->start_month > 0) echo date("M", mktime(0, 0, 0, $record->start_month, 1, 2000)).' ';
	echo $record->start_year;
?>
 -
<?php if($record->end_present): ?>
	Present
<?php else: ?>
	<?php
		if($record->end_month > 0) echo date("M", mktime(0, 0, 0, $record->end_month, 1, 2000)).' ';
		echo $record->end_year;
	?>
<?php endif; ?>
: <?php echo $record->position ; ?>
</strong>

<br />
<?php if(!empty($record->place)): ?>
	<?php echo $record->employer ?>, <?php echo $record->place ?>
<?php else: ?>
	<?php echo $record->employer ?>
<?php endif; ?>

<br />
<em>Type of business or sector: <?php echo $record->sector ?></em>

<?php if(!empty($record->responsibilities)): ?>
<br /><em>Main responsibilities:</em> <em><?php echo $record->responsibilities ?></em>
<?php endif; ?>
