<?php
/* @var $this GlosowanieController */
/* @var $model Glosowanie */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCoreScript('jquery'); // Rejestrowanie biblioteki jquery
Yii::app()->clientScript->registerCoreScript('jquery.ui'); //Rejestrowanie jquery ui
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/hideGlosowanie.js'); //Dodanie pliku javascript

?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'glosowanie-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note"></p> <span class="required">*</span> - pola obowiązkowe.</p>

	<?php echo $form->errorSummary(array($model, $settings)); ?>

	<div class="row">
		<?php echo $form->hiddenField($model, 'radaId', array('value'=>Yii::App()->user->getState('rada'))); ?>
	</div>
	
	<div class="row tooltip" title='Podaj nazwę głosowania, dzięki której będzie można je zidentyfikować (np. "Budżet 2013" lub "Głosowanie uzupłniające lipiec 2013") '>
		<?php echo $form->labelEx($model,'nazwa'); ?>
		<?php echo $form->textField($model,'nazwa',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'nazwa'); ?>
	</div>

	<div class="row tooltip" title='Podaj dodatkowe inormacje na temat głosowania (opcjonalne)'>
		<?php echo $form->labelEx($model,'opis'); ?>
		<?php echo $form->textArea($model,'opis',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'opis'); ?>
	</div>

	<div class="row tooltip" title='Podaj datę rozpoczęcia głosowania'>
		<?php echo $form->labelEx($model,'dataOd'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array('name'=>'dataOd', 'model'=>$model, 'attribute'=>'dataOd','value'=>'dataOd','options'=>array(
        'showAnim'=>'fold','dateFormat'=>'yy-mm-dd')));	?>
		<?php echo $form->error($model,'dataOd'); ?>
	</div>
 
	<div class="row tooltip" title='Podaj datę zakończenia głosowania'>
		<?php echo $form->labelEx($model,'dataDo'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array('name'=>'dataDo', 'model'=>$model, 'attribute'=>'dataDo','value'=>'dataDo','options'=>array(
        'showAnim'=>'fold','dateFormat'=>'yy-mm-dd')));	?>
		<?php echo $form->error($model,'dataDo'); ?>
	</div>
	<div class="row">
			<?php echo $form->hiddenField($model,'settingsId', array('id'=>'setId')); ?>
	</div>
<?
	$model->settingsId==null? $checked=true: $checked=false;

if ($model->voted!=true) {	
	
?>
	
	<div class="row">
		<?php echo CHtml::label('Czy użyć ustawienia domyślne dla rady?', 'domyslne'); ?>

		<?php echo $form->CheckBox($model, 'domyslne', array('id'=>'domyslne', 'checked'=>$checked, 'class'=>'tooltip', 'title'=>'Odznacz jeśli chcesz podać dla tego głosowania ustawienia inne niż domyślne')); ?>
	</div>
	
	
	<div id="settings">
	<P>Podaj ustawienia dla tego głosowania. Będą one obowiązywać tylko dla niego i nie zmienią ustawień domyślnych dla innych głosowań. </P>	
	
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


	</div>
<?
 }
?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Zapisz' : 'Zapisz'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->	
