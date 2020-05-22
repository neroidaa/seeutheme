<?php if(!empty($page)): ?>
	<h1><?php echo $page->page_title ?></h1>
	<?php echo $page->content ?>
<?php endif; ?>

<div>
<?php
$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
    'name'=>'query',
    'sourceUrl' => Yii::app()->createUrl(':'.$_GET['nav']),
    // additional javascript options for the autocomplete plugin
    'options'=>array(
        'minLength'=>'2',
		'select' => 'js:function( event, ui ) {
				window.location.href = ui.item.link;
			}',
    ),
    'htmlOptions'=>array(
        'style'=>'width:200px;'
    ),
));
?>
</div>
