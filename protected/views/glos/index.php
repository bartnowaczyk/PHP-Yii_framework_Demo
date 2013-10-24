<?php
/* @var $this GlosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gloses',
);

$this->menu=array(
	array('label'=>'Create Glos', 'url'=>array('create')),
	array('label'=>'Manage Glos', 'url'=>array('admin')),
);
?>

<h1>Gloses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
