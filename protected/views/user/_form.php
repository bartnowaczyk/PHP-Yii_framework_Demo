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

	<div class="row tooltip" title="Podaj nazwę użytkownika. Będzie ona używana do zalogowania się do systemu. ">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="row tooltip" title="Podaj hasło.">
		<?php echo $form->labelEx($model,'haslo'); ?>
		<?php echo $form->passwordField($model,'haslo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'haslo'); ?>
	</div>

	<div class="row tooltip" title="Podaj imię użytkownika.">
		<?php echo $form->labelEx($model,'imie'); ?>
		<?php echo $form->textField($model,'imie',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'imie'); ?>
	</div>

	<div class="row tooltip" title="Podaj nazwisko użytkownika.">
		<?php echo $form->labelEx($model,'nazwisko'); ?>
		<?php echo $form->textField($model,'nazwisko',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nazwisko'); ?>
	</div>

	<div class="row tooltip" title="Podaj adres e-mail użytkownika (nieobowiązkowe).">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
<? 
	if(Yii::App()->user->getState('rada')!=null && Yii::App()->user->getState('role')==1) {?>
	<div class="row">
			<?php echo $form->hiddenField($model, 'rada_id', array('value'=>Yii::App()->user->getState('rada'))); ?>
	</div>
	<div class="row tooltip" title="Wybierz jaką rolę dla użytkownika. <ul><li>Administrator ma pełne uprawnienia w zakresie administracji radą i jej członkami, głosowaniami, komisjami i ich cżłonkami. Może również dodawać głosy w czasie głosowań i sprawdzać uprawnienie do głosowania. .</li><li>Członek rady może administrować głosowaniami, komisjami, członkami komisji. Może również sprawdzać uprawnienia do głosowania. </li><li>Członek komisji może sprawdzć uprawnienia do głosowania i dodawać nowe głosy. Uwaga! Członek komisji może przyjmować głosy w róznych komisjach. </li></ul>">
			<?php echo $form->labelEx($model,'rola');?>
			<?php echo $form->dropDownList($model, 'rola', array('1'=>'Administrator', '2' => 'Członek Rady', '3'=>'Członek komisji')); ?>
			<?php echo $form->error($model,'rola'); ?>
	 </div>
<?php
	}
	else if(Yii::App()->user->getState('rada')!=null && Yii::App()->user->getState('role')==2) {?>
	<div class="row">
			<?php echo $form->hiddenField($model, 'rada_id', array('value'=>Yii::App()->user->getState('rada'))); ?>
	</div>
	<div class="row tooltip" title="Członek komisji może sprawdzć uprawnienia do głosowania i dodawać nowe głosy. Uwaga! Członek komisji może przyjmować głosy w róznych komisjach. ">
			<?php echo $form->labelEx($model,'rola');?>
			<?php echo $form->dropDownList($model, 'rola', array('3'=>'Członek komisji')); ?>
			<?php echo $form->error($model,'rola'); ?>
	 </div>
<?php
	}
	else {
?>
	<div class="row">
			<?php echo $form->hiddenField($model, 'rola', array('value'=>'5')); ?>
	</div>
<?
}
?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Zapisz' : 'Zapisz'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
