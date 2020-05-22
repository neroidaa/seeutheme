<?php echo $record->authors?>.
<strong><?php echo $record->title?></strong>.


<?php if(!empty($record->collection)): ?>
	In <em><?php echo $record->collection . (!empty($record->pages) ? ', pp. '.$record->pages : '')?></em>.
<?php endif; ?>

<?php if(!empty($record->publisher)): ?>
	<?php echo $record->publisher?>,
<?php endif; ?>

<?php if(!empty($record->location)): ?>
	<?php echo $record->location?>,
<?php endif; ?>

<?php if($record->month > 0): ?>
	<?php echo $record->month?> /
<?php endif; ?>


<?php echo $record->year?>.


<?php if(!empty($record->isbn)): ?>
	ISBN <?php echo $record->isbn?>.
<?php endif; ?>
