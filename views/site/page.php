<?php if(!empty($page)): ?>
	<h1><?php echo $page->page_title ?></h1>
<?php endif; ?>

<?php if(!empty($page->introduction)): ?>
	<p class="introduction"><?php echo $page->introduction ?></p>
<?php endif; ?>


<?php if(!empty($page->picture) && file_exists(YiiBase::getPathOfAlias('webroot.images.pages').'/'.$page->picture)): ?>
<img style="width: 100%; border-bottom: 3px solid #00AFEF; padding: 0; margin-bottom: 10px;" src="/images/pages/<?php echo $page->picture?>" />
<?php endif; ?>


<div id="page-content">
<?php echo 
	preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#u', '', $page->content);
?>
</div>

