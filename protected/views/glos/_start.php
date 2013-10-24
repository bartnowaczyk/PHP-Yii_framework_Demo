<?php
/* @var $this GlosController */
/* @var $data Glos */
?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'glos-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><span class="required">*</span> pola wymagane.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php 
	if (count($glosowania)!=0){ 	
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'glosowanieId'); ?>
		<?php echo $form->dropDownList($model,'glosowanieId', CHtml::listData($glosowania, 'id', 'nazwa')); ?>
		<?php echo $form->error($model,'glosowanieId'); ?>
		
	</div>
	<?php 
	}
	else{
		    Yii::app()->user->setFlash('danger', '<strong>Nie masz żadnego glosowania! '. CHtml::link('Dodaj', array('glosowanie/create')) . '</strong>');
    $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'×', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
    'danger'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
    ),
    ));
		
	}
	
	if (count($komisje)!=0){ 	
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'komisjaId'); ?>
		<?php echo $form->dropDownList($model,'komisjaId', CHtml::listData($komisje, 'id', 'nazwa')); ?>
		<?php echo $form->error($model,'komisjaId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	
	<?php
	}
	else {
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
$this->endWidget(); ?>



</div>
