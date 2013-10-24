<?php
/* @var $this GlosowanieController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Głosowania',
);

if (Yii::App()->user->getState('role')<3) {
//if (Yii::App()->user->getState('rada')==$model->id) {

	$this->menu=array(
		array('label'=>'Stwórz nowe głosowanie', 'url'=>array('create')),
	);
}

?>

<h1>Głosowania zakończone </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
