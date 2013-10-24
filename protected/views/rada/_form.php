<?php
/* @var $this RadaController */
/* @var $model Rada */
/* $var $settings Settings */
/* @var $form CActiveForm */
?>

<?php
Yii::app()->clientScript->registerCoreScript('jquery'); // Rejestrowanie biblioteki jquery
Yii::app()->clientScript->registerCoreScript('jquery.ui'); //Rejestrowanie jquery ui
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/hide.js'); //Dodanie pliku javascript 
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rada-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note"> <span class="required">*</span> - pola wymagane.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row tooltip" title='Podaj nazwę pod którą rada będzie widoczna dla wszystkich użytkowników. Możesz wpisać dowolną nazwę, na przykład "Rada konsultacyjna w Gdańsku"'>
		<?php echo $form->labelEx($model,'nazwa'); ?>
		<?php echo $form->textField($model,'nazwa',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'nazwa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gmina'); ?>
		<?php echo $form->textField($model,'gmina',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'gmina'); ?>
	</div>

	<div class="row tooltip" title='Tu możesz wpisać krótki opis swojej rady, na przykład gdzie się spotyka, jaki ma skład itp.'>
		<?php echo $form->labelEx($model,'dodatkoweInfo'); ?>
		<?php echo $form->textArea($model,'dodatkoweInfo',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'dodatkoweInfo'); ?>
	</div>
	
	Ustawienie domyślne dla rady (można ustawić inne dla poszczególnych głosowań):
	
	<div class="row tooltip" title='Podaj czy PESEL osoby głosującej ma być zapiswany w czasie głosowania.'>
		<?php echo $form->labelEx($settings,'czyPesel'); ?>
		<?php echo CHtml::activeDropDownList($settings, 'czyPesel', array(1 => 'TAK', 0=>'NIE'),  array('class'=>'czyP',)); ?>
		<?php echo $form->error($settings,'czyPesel'); ?>
	</div>
	
<div class="row tooltip" id="ilePP" title='Podaj ile liczb numeru PESEL ma być zapisywanych (maksymalnie 11).'>
		<?php echo $form->labelEx($settings,'ilePesel'); ?>
		<?php echo $form->textArea($settings,'ilePesel',array('rows'=>1, 'cols'=>4, 'class'=>'ileP')); ?>
		<?php echo $form->error($settings,'ilePesel'); ?>
	</div>
	
	<div class="row tooltip" title='Podaj czy imię osoby głosującej ma być zapisywane w czasie głosowania.'>
		<?php echo $form->labelEx($settings,'czyImie'); ?>
		<?php echo CHtml::activeDropDownList($settings, 'czyImie', array(1 => 'TAK', 0=>'NIE')); ?>
		<?php echo $form->error($settings,'czyImie'); ?>
	</div>

	<div class="row tooltip" title='Podaj czy nazwisko osoby głosującej ma być zapisywane w czasie głosowania.'>
		<?php echo $form->labelEx($settings,'czyNazwisko'); ?>
		<?php echo CHtml::activeDropDownList($settings, 'czyNazwisko', array(0 => 'NIE', 1=>'TAK')); ?>
		<?php echo $form->error($settings,'czyNazwisko'); ?>
	</div>

	<div class="row tooltip" title='Podaj czy w czasie głosowania będzie zapisywany dodatkowy dokument indentyfikujące osobę głosującą. Może to być na przykład legitymacja szkolna dla osób niepełnoletnich, które będą dopuszczone do głosowania. '>
		<?php echo $form->labelEx($settings,'czyDokument'); ?>
		<?php echo CHtml::activeDropDownList($settings, 'czyDokument', array(0 => 'NIE', 1=>'TAK')); ?>
		<?php echo $form->error($settings,'czyDokument'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Zapisz' : 'Zapisz'); ?>
	</div>


<?php $this->endWidget(); ?>


</div><!-- form -->
