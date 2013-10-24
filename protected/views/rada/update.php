<?php
/* @var $this RadaController */
/* @var $model Rada */

$this->breadcrumbs=array(
	'Rady'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Zmien',
);

$this->menu=array(
	array('label'=>'Pokaż rady', 'url'=>array('index')),
	array('label'=>'Stwórz nową radę', 'url'=>array('create')),
	array('label'=>'Zobacz szczegóły', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Podaj nowe dane, gmina <?php echo $model->gmina; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'settings'=>$settings)); ?>
