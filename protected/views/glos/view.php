<?php
/* @var $this GlosController */
/* @var $model Glos */

$this->breadcrumbs=array(
	'Gloses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Glos', 'url'=>array('index')),
	array('label'=>'Create Glos', 'url'=>array('create')),
	array('label'=>'Update Glos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Glos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Glos', 'url'=>array('admin')),
);
?>

<h1>View Glos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'glosowanieId',
		'glosujacyId',
		'komisjaId',
		'data',
		'czlonekId',
	),
)); ?>
