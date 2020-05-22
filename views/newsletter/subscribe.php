<?php if($page != null): ?>
	<h1><?php echo $page->page_title ?></h1>
<?php else: ?>
	<h1><?php echo Yii::t('newsletter', 'Subscribe to the SEEU Newsletter')?></h1>
<?php endif; ?>

<?php if(!empty($page->introduction)): ?>
	<p class="introduction"><?php echo $page->introduction ?></p>
<?php endif; ?>

<?php if(!empty($page->picture) && file_exists(YiiBase::getPathOfAlias('webroot.images.pages').'/'.$page->picture)): ?>
<img style="width: 100%" src="/images/pages/<?php echo $page->picture?>" />
<?php endif; ?>


<?php if(Yii::app()->user->hasFlash('subscribe')): ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo Yii::app()->user->getFlash('subscribe'); ?>
	</div>
<?php else: ?>

	<?php if($page != null): ?>
		<?php echo $page->content ?>
	<?php endif; ?>

	<div class="form well">
	<?php $form=$this->beginWidget('CActiveForm'); ?>

		<div class="row-fluid">
			<div class="span12">
				<?php echo $form->labelEx($formModel,'email'); ?>
				<?php echo $form->textField($formModel,'email', array('class'=>'span6', 'size'=>40,'maxlength'=>255)); ?>
				<?php echo $form->error($formModel,'email'); ?>
			</div>
		</div>

		<?php if(extension_loaded('gd')): ?>
		<div class="row-fluid">
			<div class="span12">
				<?php echo $form->labelEx($formModel,'verifyCode'); ?>
				<div>
				<?php $this->widget('CCaptcha'); ?>
				<?php echo $form->textField($formModel,'verifyCode'); ?>
				<?php echo $form->error($formModel,'verifyCode'); ?>
				</div>
			</div>
		</div>
		<div class="hint"><?php echo Yii::t('newsletter','Enter the letters as they are shown in the image above. Letters are not case-sensitive.')?></div>
		<?php endif; ?>

		<div class="row-fluid buttons">
			<?php echo CHtml::submitButton(Yii::t('newsletter','Subscribe'), array('class'=>'btn btn-primary')); ?>
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

<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/bootstrap/js/bootstrap-alert.js');
