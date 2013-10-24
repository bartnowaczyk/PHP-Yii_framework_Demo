<?php
/* @var $this KomisjaController */
/* @var $model Komisja */
$this->breadcrumbs=array(
	'Komisje'=>array('index'),
	'Stwórz',
);

$this->menu=array(
	array('label'=>'Wszystkie komisje', 'url'=>array('index')),
);
?>

<h1>Wybierz odpowiednią komisję</h1>

<?php echo $this->renderPartial('_komisjaChange', array('komisje'=>$komisje, 'model'=>$model)); ?>
