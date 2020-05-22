<span class="authors"><?php echo $record->authors ?></span>.
<strong><span class="title"><?php echo $record->title ?></span></strong>.

<span class="collection">
<?php if(!empty($record->collection)): ?>
	In <em><?php echo $record->collection . (!empty($record->pages) ? ', pp. '.$record->pages : '')?></em>.
<?php endif; ?>
</span>

<span class="publisher">
<?php if(!empty($record->publisher)): ?>
	<?php echo $record->publisher?>,
<?php endif; ?>
</span>

<span class="location">
<?php if(!empty($record->location)): ?>
	<?php echo $record->location?>,
<?php endif; ?>
</span>

<span class="month">
<?php if($record->month > 0): ?>
	<?php echo $record->month?> /
<?php endif; ?>
</span>

<span class="year"><?php echo $record->year?></span>.

<span class="isbn">
<?php if(!empty($record->isbn)): ?>
	ISBN <?php echo $record->isbn?>.
<?php endif; ?>
</span>

<span class="url">
<?php if(!empty($record->url)): ?>
	(<a target="_blank" href="<?php echo $record->url?>">Download</a>)
<?php endif; ?>
</span>