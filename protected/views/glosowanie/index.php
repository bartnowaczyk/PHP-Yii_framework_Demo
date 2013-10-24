<?php
/* @var $this GlosowanieController */
/* @var $dataProvider CActiveDataProvider */



?>

<h1>Aktualne głosowania </h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
//	'settings'=>$settings;
	'itemView'=>'_view',
)); ?>
