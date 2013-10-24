<?php
/* @var $this GlosowanieController */
/* @var $data Glosowanie */
$dzis = date('Y-m-d');	
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nazwa')); ?>:</b>
	<?php echo CHtml::encode($data->nazwa); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('radaId')); ?>:</b>
	<?php echo CHtml::encode(Rada::model()->findByPk($data->radaId)->nazwa); ?>
	
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dataOd')); ?>:</b>
	<?php echo CHtml::encode($data->dataOd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dataDo')); ?>:</b>
	<?php echo CHtml::encode($data->dataDo); ?>
	<br />

	<b>Oddanych głosów:</b>
	<?php echo CHtml::encode($data->getStatystyki()); ?>
	<br />

	<?php echo CHtml::link('Szczegóły', array('view', 'id'=>$data->id)); ?>
	<br />
	<?php echo CHtml::link('Modyfikuj', array('update', 'id'=>$data->id)); ?>
	<br />
	<?php	
	if ($data->dataOd<=$dzis && $data->dataDo >=$dzis) {
		echo CHtml::link('Dodaj głos', array('glos/create', 'id'=>$data->id)); 
		echo "	<br />";
	}
	?>

	<?php echo CHtml::link(CHtml::encode('Usuń głosowanie'), array('delete', 'id'=>$data->id),
  array(
    'submit'=>array('delete', 'id'=>$data->id),
    'class' => 'delete','confirm'=>'Czy jesteś pewien, że chcesz usunąć głosowanie? Usunięte zostaną również wszystkie powiązane głosy (o ile takie są zapisane).'
  )
);
?>
</div>
