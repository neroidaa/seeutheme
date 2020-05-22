<div class="media search-result <?php echo $class?>">
	<?php if(!empty($result->thumbnail)): ?>
		<a class="pull-left" href="<?php echo $result->url?>">
			<img style="width: 80px;" data-src="holder.js/64x64" src="<?php echo $result->thumbnail?>">
		</a>
	<?php endif; ?>
  <div class="media-body">
	<h5 class="media-heading"><a href="<?php echo $result->url?>"><?php echo $result->title?></a></h5>
	<p>
		<?php echo $result->description?>
		<br>
		<small style="color: #999"><?php echo $result->displayUrl?></small>
	</p>
  </div>
</div>