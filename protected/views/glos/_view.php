<?php
/* @var $this GlosController */
/* @var $data Glos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('glosowanieId')); ?>:</b>
	<?php echo CHtml::encode($data->glosowanieId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('glosujacyId')); ?>:</b>
	<?php echo CHtml::encode($data->glosujacyId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('komisjaId')); ?>:</b>
	<?php echo CHtml::encode($data->komisjaId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data')); ?>:</b>
	<?php echo CHtml::encode($data->data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('czlonekId')); ?>:</b>
	<?php echo CHtml::encode($data->czlonekId); ?>
	<br />


</div>