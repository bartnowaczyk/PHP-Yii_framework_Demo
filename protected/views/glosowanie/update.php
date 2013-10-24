<?php
/* @var $this GlosowanieController */
/* @var $model Glosowanie */

$this->breadcrumbs=array(
	'Glosowania'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Zmień',
);

$this->menu=array(
	array('label'=>'Wszystkie głosowania', 'url'=>array('index')),
	array('label'=>'Stwórz nowe głosowanie', 'url'=>array('create')),
);

if ($model->voted!=true) {	


?>

<h1>Zmiana głosowania z dnia <?php echo $model->dataOd; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'settings'=>$settings)); ?>

<?
}
else {
?>	
<p>Zmiana ustawień dla tego głosowania nie jest możliwa ponieważ oddano już w nim głosy! </p>


<?

}
?>
