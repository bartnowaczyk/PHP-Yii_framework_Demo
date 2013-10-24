<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><span class="required">*</span> - pole obowiązkowe.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'initialPasswd'); ?>
		<?php echo $form->passwordField($model,'initialPasswd',array('size'=>60,'maxlength'=>100, 'value'=>'')); ?>
		<?php echo $form->error($model,'initialPasswd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'newHaslo'); ?>
		<?php echo $form->passwordField($model,'newHaslo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'newHaslo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Zapisz' : 'Zapisz'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
