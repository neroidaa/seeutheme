<?php
	if($this->page != null) {
		if($this->page->level == 1)
			$this->layout = 'no-column';
		elseif($this->page->level == 2)
			$this->layout = 'right-column';
		else
			$this->layout = 'both-columns';
	} else {
		$this->layout = 'main';
	}
?>

<?php
$this->pageTitle = Yii::app()->name . ' - '.$page->title;
?>

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

<div class="container-fluid">
<?php if(count($children)): ?>
	<div class="row-fluid">
		<?php foreach($children as $i => $subpage): ?>
			<?php $url = Yii::app()->createUrl(':'.$subpage->id); ?>
			<div class="span6" style="margin: 0 0 10px 0; padding: 0 10px;">
				
				<table>
					<tr>
						<td valign="top" width="100" style="padding-right: 5px;">
					<?php if(!empty($subpage->teaser) && file_exists(YiiBase::getPathOfAlias('webroot.images.pages.teaser').'/'.$subpage->teaser)): ?>
				<a class="image" href="<?php echo $url?>">
					<img style="float: left; margin: 0 15px 0 0;" width="100" height="100" alt="<?php echo $subpage->title?>" src="/images/pages/teaser/<?php echo $subpage->teaser?>" />
				</a>
				<?php endif; ?>
			</td>
						<td valign="top" style="padding-top: 5px;">
							<a class="page-title" style="font-size: 0.9em" href="<?php echo $url?>"><?php echo $subpage->page_title; ?></a>
				<br />
				<span class="sitegroupdesc"><?php echo $subpage->description ?></span>
						</td>
					</tr>
				</table>
				
				
			</div>
			<?php if($i % 2 == 1): ?>
			</div>
			<div class="row-fluid">
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
</div>
