<?php
/* @var $this KomisjaController */
/* @var $data Komisja */
?>

<div class="view">



	<b><?php echo CHtml::encode($data->getAttributeLabel('nazwa')); ?>:</b>
	<?php echo CHtml::encode($data->nazwa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adresId')); ?>:</b>
	<?php echo CHtml::encode($data->adres->fullAddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('radaId')); ?>:</b>
	<?php echo CHtml::encode($data->rada->nazwa); ?>
	<br />
	
	<?php 
	if (Yii::app()->user->getState('role')==1 || Yii::app()->user->getState('role')==2) {
		echo CHtml::link('Modyfikuj', array('updateRada', 'id'=>$data->id)) . "<br />"; 
		echo CHtml::link(CHtml::encode('Usuń Komisję'), array('delete', 'id'=>$data->id),
  array(
    'submit'=>array('delete', 'id'=>$data->id),
    'class' => 'delete','confirm'=>'Czy jesteś pewien, że chcesz usunąć komisję? Usunięte zostaną również wszystkie powiązane głosy (o ile takie są zapisane).'
			)
	);
}
?>
</div>
