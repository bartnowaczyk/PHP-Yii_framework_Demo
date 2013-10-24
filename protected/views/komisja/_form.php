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

<?php echo "Dodaj nową komisję wyborczą. Aktualna rada: " . Rada::Model()->findByPk(Yii::App()->user->getState('rada'))->nazwa ; ?>

	<p class="note"><span class="required">*</span> - pola wymagane.</p>

	<?php echo $form->errorSummary($model, "Popraw następujące błędy:"); ?>

	<div class="row tooltip" title="Podaj nazwę komisji (np. Komisja Centralna lub Komisja w Szkole Podstawowej nr 25 w Bydgoszczy)">
		<?php echo $form->labelEx($model,'nazwa'); ?>
		<?php echo $form->textField($model,'nazwa',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nazwa'); ?>
	</div>
	
	<div class="row tooltip" title="Podaj adres komisji ">
		<?php echo $form->labelEx($adres,'miejscowosc'); ?>
		<?php echo $form->textField($adres,'miejscowosc'); ?>
		<?php echo $form->error($adres,'miejscowosc'); ?>
		<?php echo $form->labelEx($adres,'ulica'); ?>
		<?php echo $form->textField($adres,'ulica'). " nr domu " . $form->textField($adres,'dom', array('size'=>'6px')) . " / " . $form->textField($adres,'lokal', array('size'=>'6px')) ; ?>	
		<?php echo $form->error($adres,'dom'); ?>
		<?php echo $form->error($adres,'lokal'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'radaId', array('value'=>Yii::App()->user->getState('rada'))); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Zapisz' : 'Zapisz'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->	
