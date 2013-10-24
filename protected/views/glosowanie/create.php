<?php
/* @var $this GlosowanieController */
/* @var $model Glosowanie */

$this->breadcrumbs=array(
	'Glosowania'=>array('index'),
	'Nowe',
);

$this->menu=array(
	array('label'=>'Aktualne głosowania', 'url'=>array('index')),
);
?>

<h1>Nowe głosowanie</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'settings'=>$settings)); ?>
