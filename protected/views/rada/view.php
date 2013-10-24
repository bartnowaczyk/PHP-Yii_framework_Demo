<?php
/* @var $this RadaController */
/* @var $model Rada */
/* @var $settings Settings */

$this->breadcrumbs=array(
	'Rady'=>array('index'),
	$model->id,
);

if (Yii::App()->user->getState('rada')==$model->id) {

$this->menu=array(
	array('label'=>'Pokaż rady', 'url'=>array('index')),
	array('label'=>'Stwórz nową radę', 'url'=>array('create')),
	array('label'=>'Wprowadź zmiany', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Usuń radę', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);

}
else {
$this->menu=array(
	array('label'=>'Pokaż rady'.Yii::App()->user->getState('rada'), 'url'=>array('index')),
	array('label'=>'Stwórz nową radę', 'url'=>array('create')),
);	
	}

?>

<h1>Rada konsultacyjna, gmina <?php echo $model->gmina; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nazwa',
		'gmina',
		'dodatkoweInfo',
		array(
			'label'=>'komisje',
			'type'=>'raw',
			'value'=>$model->powiazaneKomisje,
		),	
		array(
			'label'=>'Głosowania',
			'type'=>'raw',
			'value'=>$model->powiazaneGlosowania,
		),
	),
)); ?>

<span class='tooltip' title='Poniższe ustawienia obowiązują domyślnie dla wszystkich głosowań, jednak istnieje możliwość ustawienia innych wartości dla poszczególnych głosowań.'>Ustawienia domyślne dla głosowań:</span>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$settings,
	'attributes'=>array(
		 array(
            'header' => 'czyPesel',
            'name' => 'czyPesel',
            'value' => ($settings->czyPesel == 1) ? "TAK" : "NIE"
        ),
		'ilePesel',
		 array(
            'header' => 'czyImie',
            'name' => 'czyImie',
            'value' => ($settings->czyImie == 1) ? "TAK" : "NIE"
        ),
		 array(
            'header' => 'czyNazwisko',
            'name' => 'czyNazwisko',
            'value' => ($settings->czyNazwisko == 1) ? "TAK" : "NIE"
        ),

		 array(
            'header' => 'czyDokument',
            'name' => 'czyDokument',
            'value' => ($settings->czyDokument == 1) ? "TAK" : "NIE"
        ),

	),
)); ?>
