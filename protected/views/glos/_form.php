<?php
/* @var $this GlosController */
/* @var $model Glos */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerCoreScript('jquery'); // Rejestrowanie biblioteki jquery
Yii::app()->clientScript->registerCoreScript('jquery.ui'); //Rejestrowanie jquery ui
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/addGlos.js'); //Dodanie pliku javascript
	$model->glosowanieId=$glosowanie->id;	
		
	if ($glosowanie->settingsId!=null)
		$settings = Settings::model()->findByPk($glosowanie->settingsId);
	else {
		$settings = Settings::model()->findByPk(Rada::model()->findByPk(Yii::app()->user->getState('rada'))->settingsId);
	}
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'glos-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Uwaga! Wszystkie pola są obowiązkowe!</p>

	<?php echo $form->errorSummary($model); ?>
<?
	$wybKm=Yii::app()->user->getState('wybKm');

	if ($wybKm==null && count($komisje)==0){
		Yii::app()->user->setFlash('danger', '<strong>Nie masz żadnej komisji! '. CHtml::link('Dodaj', array('komisja/create')) . '</strong>');
		$this->widget('bootstrap.widgets.TbAlert', array(
		'block'=>true, // display a larger alert block?
		'fade'=>true, // use transitions?
		'closeText'=>'×', // close link text - if set to false, no close link is displayed
		'alerts'=>array( // configurations per alert type
		'danger'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
		),
		));
	}
	
	if ($wybKm==null && count($komisje)!=0) {
?>

	<div class="row">
	<?php echo $form->labelEx($model,'komisjaId'); ?>
	<?php echo $form->dropDownList($model,'komisjaId', CHtml::listData($komisje, 'id', 'nazwa')); ?>
	<?php echo $form->error($model,'komisjaId'); ?>
	</div>
<?php
	}
	else {
		echo $form->hiddenField($model,'komisjaId', array('value'=>$wybKm)); 
	}
?>
	<div class="row">
		<?php echo $form::hiddenField($model, 'glosowanieId', array('id'=>'glosowanieId')); ?>
		<?php echo $form->hiddenField($settings, 'ilePesel', array('id'=>'ilePesel'))?>
	</div>
<?php 
	if($settings->czyPesel==true){
?>

	<?php echo $form->hiddenField($settings, 'ilePesel', array('id'=>'ilePesel'))?>

 	<div class="row" id="pesel">
		<?php echo $form->labelEx($glosujacy, 'pesel'); ?>
		<?php echo	$form->textField($glosujacy, 'pesel', array('id'=>'peselInput', 'class'=>'tooltip', 'title'=>'Wpisz ' . $settings->ilePesel . ' cyfr numeru Pesel.')) ?>
		<?php echo	$form->error($glosujacy, 'pesel') ?>
		<div id="peselErr" class="ErrRed">PESEL musi składać się z <?php echo $settings->ilePesel ?> cyfr!</div>
		<div id="peselok" class="okGreen">OK!</div>
	</div>
<?
}
	if($settings->czyImie==true){
?>
	<div class="row" id="imie">
		<?php echo $form->labelEx($glosujacy, 'imie'); ?>
		<?php echo $form->textField($glosujacy, 'imie', array('id'=>'imieInput', 'class'=>'tooltip', 'title'=>'Wpisz imię osoby głosującej.')) ?>
		<?php echo $form->error($glosujacy, 'imie') ?>
		<div id="imieErr" class="ErrRed">Imię może się składać tylko z liter!</div>
		<div id="imieOk" class="okGreen">OK!</div>
	</div>
<?
}
	if($settings->czyNazwisko==true){
?>

	<div class="row" id="nazwisko">
		<?php echo $form->labelEx($glosujacy, 'nazwisko'); ?>
		<?php echo	$form->textField($glosujacy, 'nazwisko', array('id'=>'nazwiskoInput', 'class'=>'tooltip', 'title'=>'Wpisz nazwisko osoby głosującej.')) ?>
		<?php echo	$form->error($glosujacy, 'nazwisko') ?>
		<div id="nazwiskoErr" class="ErrRed">Nazwisko może składać się z małych i wielkich liter oraz łącznika (-)!</div>
		<div id="nazwiskoOk" class="okGreen">OK!</div>
	</div>
<?
}
	if($settings->czyDokument==true){
?>
	
	<div class="row" id="dokument">
		<?php echo $form->labelEx($glosujacy, 'nrDokumentu'); ?>
		<?php echo	$form->textField($glosujacy, 'nrDokumentu', array('id'=>'dokumentInput', 'class'=>'tooltip', 'title'=>'Wpisz numer wybranego dokumentu.')) ?>
		<?php echo	$form->error($glosujacy, 'nrDokumentu') ?>
		<div id="dokumentErr" class="ErrRed"> Dozwolne są małe i wielkie litery oraz łącznik (-) i ukośnik	(/)!</div>
		<div id="dokumentOk" class="okGreen">OK!</div>
	</div>
<?
}
?>
	<div id="alert"></div>

<?
	if ($wybKm==null && count($komisje)==0){

	}
	else {
?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Zapisz' : 'Zapisz'); ?>
	</div>
<?
}
?>
<?php $this->endWidget(); ?>

</div><!-- form -->
