<?php
/* @var $this GlosController */
/* @var $model Glos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'glosowanieId'); ?>
		<?php echo $form->textField($model,'glosowanieId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'glosujacyId'); ?>
		<?php echo $form->textField($model,'glosujacyId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'komisjaId'); ?>
		<?php echo $form->textField($model,'komisjaId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data'); ?>
		<?php echo $form->textField($model,'data'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'czlonekId'); ?>
		<?php echo $form->textField($model,'czlonekId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->