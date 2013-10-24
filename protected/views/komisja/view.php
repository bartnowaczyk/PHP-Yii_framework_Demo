<?php
/* @var $this KomisjaController */
/* @var $model Komisja */	
?>

<h1>Komisja: <?php echo $model->nazwa; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nazwa',
		array(
			'label'=> "Adres",
			'type'=>'raw',
			'value'=>CHtml::encode($model->adres->fullAddress),
		),	
		array(
			'label'=> "Rada",
			'type'=>'raw',
			'value'=>CHtml::encode($model->rada->nazwa),
		),	
/*		array(
			'label'=> "Członkowie komisji",
			'type'=>'raw',
			'value'=>$model->powiazaniLudzie,
		),				
*/		
	),
)); 

?>




















		
		
		
