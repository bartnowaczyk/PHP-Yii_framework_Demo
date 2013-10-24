<?php
/* @var $this GlosowanieController */
/* @var $model Glosowanie */
?>

<h1>Głosowanie <?php echo $model->nazwa; ?> </h1>

<?php
if ($model->settingsId==null) {
 $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nazwa',
		'opis',
		array(
			'label'=> "Rada",
			'type'=>'raw',
			'value'=>CHtml::encode($model->rada->nazwa),
		),	
		'dataOd',
		'dataDo',
		array(
			'label'=> "Ilość oddanych głosów",
			'type'=>'raw',
			'value'=>CHtml::encode($model->getStatystyki()),
		),
		array(
			'label'=> "Pierwszy głos oddano",
			'type'=>'raw',
			'value'=>CHtml::encode($model->getFirstVote()),
		),
		array(
			'label'=> "Ostatni głos oddano",
			'type'=>'raw',
			'value'=>CHtml::encode($model->getLastVote()),
		),
		array(
			'label'=> "...",
			'type'=>'raw',
			'value'=>'Ustawienia domyślne dla całej rady:',
		),	

		array(
			'label'=> "Sprawdzać PESEL?",
			'type'=>'raw',
			'value'=>CHtml::encode($model->rada->settings->returnPesel()),
		),	
		array(
			'label'=> "Sprawdzać imię?",
			'type'=>'raw',
			'value'=>CHtml::encode($model->rada->settings->returnImie()),
		),	
		array(
			'label'=> "Sprawdzać nazwisko?",
			'type'=>'raw',
			'value'=>CHtml::encode($model->rada->settings->returnNazwisko()),
		),	
		array(
			'label'=> "Sprawdzać dodatkowy dokument?",
			'type'=>'raw',
			'value'=>CHtml::encode($model->rada->settings->returnDokument()),
		),	
	),
));	
	 
}
else {
 $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nazwa',
		'opis',
		array(
			'label'=> "Rada",
			'type'=>'raw',
			'value'=>CHtml::encode($model->rada->nazwa),
		),	
		'dataOd',
		'dataDo',
		array(
			'label'=> "Ilość oddanych głosów",
			'type'=>'raw',
			'value'=>CHtml::encode($model->getStatystyki()),
		),
		array(
			'label'=> "Pierwszy głos oddano",
			'type'=>'raw',
			'value'=>CHtml::encode($model->getFirstVote()),
		),
		array(
			'label'=> "Ostatni głos oddano",
			'type'=>'raw',
			'value'=>CHtml::encode($model->getLastVote()),
		),
		array(
			'label'=> "...",
			'type'=>'raw',
			'value'=>'Ustawienia dla danego głosowania:',
		),
		array(
			'label'=> "Sprawdzać PESEL?",
			'type'=>'raw',
			'value'=>CHtml::encode($model->settings->returnPesel()),
		),	
		array(
			'label'=> "Sprawdzać imię?",
			'type'=>'raw',
			'value'=>CHtml::encode($model->settings->returnImie()),
		),	
		array(
			'label'=> "Sprawdzać nazwisko?",
			'type'=>'raw',
			'value'=>CHtml::encode($model->settings->returnNazwisko()),
		),	
		array(
			'label'=> "Sprawdzać dodatkowy dokument?",
			'type'=>'raw',
			'value'=>CHtml::encode($model->settings->returnDokument()),
		),	
	),
));
}
 ?>
