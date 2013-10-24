<?php
/* @var $this KomisjaController */
/* @var $model Komisja */
/* @var $form CActiveForm */
?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'komisja-form',
	'enableAjaxValidation'=>true,
)); ?>

	<div class="row">
	<?php echo $form->label($model,'id'); ?>
	<?php echo $form->dropDownList($model,'id', CHtml::listData($komisje, 'id', 'nazwa')); ?>
	<?php echo $form->error($model,'id'); ?>
	</div>	
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Wróć do głosowania' : 'Wróć do głosowania'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->	
