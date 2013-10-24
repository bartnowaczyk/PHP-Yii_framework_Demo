<?php
/* @var $this KomisjaController */
/* @var $model Komisja */

$this->breadcrumbs=array(
	'Komisje'=>array('index'),
	$model->nazwa=>array('view','id'=>$model->id),
	'Zmień',
);

$this->menu=array(
	array('label'=>'Wszystkie komisje', 'url'=>array('index')),
	array('label'=>'Stwórz nową komisje', 'url'=>array('create')),
	array('label'=>'Zobacz szczegóły', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Zmień dane komisji "<?php echo $model->nazwa; ?>"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'adres'=>$adres)); ?>
