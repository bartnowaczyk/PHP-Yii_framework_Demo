<?php
/* @var $this RadaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Rady',
);

$this->menu=array(
	array('label'=>'Stwórz nową radę', 'url'=>array('create')),
);
?>

<h1>Rady konsultacyjne:</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewindex',
	
)); ?>
