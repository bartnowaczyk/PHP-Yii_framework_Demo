<?php
/* @var $this RadaController */
/* @var $data Rada */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::encode($data->id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nazwa')); ?>:</b>
	<?php echo CHtml::encode($data->nazwa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gmina')); ?>:</b>
	<?php echo CHtml::encode($data->gmina); ?>
	<br />
	
	<?php echo CHtml::link('Więcej szczegółów', array('view', 'id'=>$data->id)); ?>
	<br />
	

</div>
