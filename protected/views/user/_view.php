<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('imie')); ?>:</b>
	<?php echo CHtml::encode($data->imie); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nazwisko')); ?>:</b>
	<?php echo CHtml::encode($data->nazwisko); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rola')); ?>:</b>
	<?php echo CHtml::encode($data->returnRole()); ?>
	<br />
	<?php 
	if (Yii::app()->user->getState('role')==3 && Yii::app()->user->id==$data->id)
		echo CHtml::link("Szczegóły", array('view', 'id'=>$data->id)); 	
	if (Yii::app()->user->getState('role')==1 || Yii::app()->user->getState('role')==2)
		echo CHtml::link("Szczegóły", array('viewRada', 'id'=>$data->id)); 	
	?>
	
</div>
