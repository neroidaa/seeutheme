<?php $this->layout = 'left-column'; ?>

<?php if($page != null): ?>
	<h1><?php echo $page->page_title ?></h1>
<?php else: ?>
	<h1><?php echo Yii::t('newsletter', 'Unsubscribe from the SEEU Newsletter?')?></h1>
<?php endif; ?>

<?php if($page != null && !empty($page->picture) && file_exists(YiiBase::getPathOfAlias('webroot.images.pages').'/'.$page->picture)): ?>
<img style="width: auto; max-width: 480px; margin: 10px 0" src="/images/pages/<?php echo $page->picture?>" />
<?php endif; ?>


<?php if(Yii::app()->user->hasFlash('unsubscribe')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('unsubscribe'); ?>
</div>

<?php else: ?>

<?php if($page != null): ?>
	<?php echo $page->content ?>
<?php endif; ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm'); ?>

	<div class="row">
		<?php echo $form->labelEx($formModel,'email'); ?>
		<?php echo $form->textField($formModel,'email', array('size'=>40,'maxlength'=>255)); ?>
		<?php echo $form->error($formModel,'email'); ?>
	</div>

	<?php if(extension_loaded('gd')): ?>
	<div class="row">
		<?php echo $form->labelEx($formModel,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($formModel,'verifyCode'); ?>
		<?php echo $form->error($formModel,'verifyCode'); ?>
		</div>
	</div>
	<div class="hint">Please enter the letters as they are shown in the image above.
	<br/>Letters are not case-sensitive.</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Unsubscribe'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>

<style type="text/css">
	#NewsletterSubscribeForm_verifyCode {
		margin: 10px 0;
		display:block;
		clear:left;
		width: 250px;
	}
	div.hint {
		color: #666;
		font-style: italic;
		margin-bottom: 20px;
	}
	div.errorMessage {
		color: #f00;
		font-weight: bold;
	}
	input.error {
		border: 2px solid red;
	}
</style>