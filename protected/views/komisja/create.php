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

<h1>Nowa komisja</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'adres'=>$adres)); ?>
