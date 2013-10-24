<?php
/* @var $this GlosController */
/* @var $model Glos */

$this->breadcrumbs=array(
	'Gloses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Glos', 'url'=>array('index')),
	array('label'=>'Create Glos', 'url'=>array('create')),
	array('label'=>'View Glos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Glos', 'url'=>array('admin')),
);
?>

<h1>Update Glos <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>