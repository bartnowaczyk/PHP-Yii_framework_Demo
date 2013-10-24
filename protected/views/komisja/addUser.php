
<?php
/* @var $this KomisjaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Komisje',
);

$this->menu=array(
	array('label'=>'Dodaj nową komisję', 'url'=>array('create')),
);
?>

<h1>Komisje	rady z gminy <?php echo Rada::model()->findByPk(Yii::app()->user->getState('rada'))->gmina  ?> </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
