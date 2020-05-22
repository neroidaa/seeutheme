<?php if(!empty($page)): ?>
	<h1><?php echo $page->page_title ?></h1>
<?php else: ?>
	<h1><?php echo Yii::t('app','Contact Us')?></h1>
<?php endif; ?>

<?php if(!empty($page->introduction)): ?>
	<p class="introduction"><?php echo $page->introduction ?></p>
<?php endif; ?>


<?php if(!empty($page->picture) && file_exists(YiiBase::getPathOfAlias('webroot.images.pages').'/'.$page->picture)): ?>
<img style="width: 100%" src="/images/pages/<?php echo $page->picture?>" />
<?php endif; ?>

<div id="contactaddress" class="span6">
<address class="address">
				<strong style="color: #00AFEF;border-bottom: 2px solid #00AFEF;"><?php echo Yii::t('app','Tetovo')?></strong><br>
				<?php echo Yii::t('app','Ilindenska n.335')?><br>
				1200 <?php echo Yii::t('app','Tetovo')?><br>
				<?php echo Yii::t('app','Tel')?>: +389 44 356 000<br>
				<?php echo Yii::t('app','Fax')?>: +389 44 356 001<br>
			</address>
			<address class="address">
				<strong style="color: #00AFEF;border-bottom: 2px solid #00AFEF;"><?php echo Yii::t('app','Skopje')?></strong><br>
				<?php echo Yii::t('app','Arhiepiskop Angelarij, nr.1')?><br>
				1000 <?php echo Yii::t('app','Skopje')?><br>
				<?php echo Yii::t('app','Tel')?>: +389 44 356 396<br>
				<?php echo Yii::t('app','Tel')?>: +389 44 356 397<br>
			</address>
			<address class="address">
				<strong style="color: #00AFEF;border-bottom: 2px solid #00AFEF;">Webmaster</strong><br>
				<?php echo Yii::t('app','E-mail')?> <a href="mailto:web@seeu.edu.mk" target="_blank">web@seeu.edu.mk</a><br>
			</address>
</div>
<div class="span6" style="background-color: #00AFEF;color: #fff;padding: 10px;">
<?php if(Yii::app()->user->hasFlash('contact')): ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo Yii::app()->user->getFlash('contact'); ?>
	</div>
<?php else: ?>

<div>

<?php $form=$this->beginWidget('CActiveForm'); ?>
	<?php echo $form->errorSummary($contact); ?>

	<?php if($contactInfo): ?>
	<div class="contact-details" style="background-color: #fff; color: #019BD4; padding: 10px; font-size: 1.5em;font-weight: bold;">
	<?php echo "<p class=name>".$contactInfo->first_name; ?>
	<?php echo $contactInfo->last_name."</p>"; ?>
	<?php echo "<p class=role>".$contactInfo->role."</p>"; ?>
	</div>
	<?php endif; ?>

	<div class="row-fluid">
		<?php echo Yii::t('contactform','Name')?>
		<?php echo $form->textField($contact,'name', array('size'=>60,'maxlength'=>255,'style'=>'width: 95%')); ?>
	</div>

	<div class="row-fluid">
		<?php echo Yii::t('contactform','E-mail')?>
		<?php echo $form->textField($contact,'email', array('size'=>60,'maxlength'=>255,'style'=>'width: 95%')); ?>
	</div>

	<div class="row-fluid">
		<?php echo Yii::t('contactform','Subject')?>
		<?php echo $form->textField($contact,'subject',array('size'=>60,'maxlength'=>255,'style'=>'width: 95%')); ?>
	</div>

	<div class="row-fluid">
		<?php echo Yii::t('contactform','Body')?>
		<?php echo $form->textArea($contact,'body',array('rows'=>6, 'cols'=>65,'style'=>'width: 95%')); ?>
	</div>

	<?php if(extension_loaded('gd')): ?>
	<div class="row-fluid">
		<?php echo Yii::t('contactform','Verify')?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($contact,'verifyCode', array('style'=>'width: 95%')); ?>
		</div>
		<div class="hint"><?php echo Yii::t('contactform','Enterletters')?></div>
	</div>
	<?php endif; ?>

	<div class="row-fluid buttons">
		<?php echo CHtml::submitButton(Yii::t('app','Submit'), array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
</div>
<style type="text/css">
	img#yw1 {
	}

	#ContactMail_verifyCode {
		margin: 10px 0;
		display:block;
		clear:left;
		width: 250px;
	}
	div.hint {
		margin-bottom: 20px;
	}
</style>

<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/bootstrap/js/bootstrap-alert.js');
