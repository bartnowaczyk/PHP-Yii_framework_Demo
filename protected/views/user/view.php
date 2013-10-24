<?php
/* @var $this UserController */
/* @var $model User */

?>

<h1><?php echo $model->fullName; ?></h1>

<?php
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'login',
			'imie',
			'nazwisko',
			'email',
			array(
				'header' => 'rada',
				'name' => 'rada',
				'value' => 'Gmina ' . ($model->rada->gmina),
			),
			array(            
				'header' => 'rola',
				'name' => 'rola',
				'value' => ($model->returnRole()),
			),
	))); 
echo CHtml::link('Zmien', array('user/update/'. $model->id));

?>
