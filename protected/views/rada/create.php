<?php
/* @var $this RadaController */
/* @var $model Rada */
/* @var $settings Settings */

$this->breadcrumbs=array(
	'Rady'=>array('index'),
	'Stwórz',
);

$this->menu=array(
	array('label'=>'Pokaż wszystkie rady', 'url'=>array('index')),
);
?>

<h1>Nowa rada konsultacyjna</h1>

<?php 
	 
	if(Yii::App()->user->getState('rada')) {
			
			echo "Uwaga! Twoje id przypisane jest do innej Rady konsultacyjnej. Stworzenie nowej rady usunięte tamto przypisanie i stworzy nowe. Upewnij się, że chcesz kontynuować.";
	}
?>


<?php echo $this->renderPartial('_form', array('model'=>$model, 'settings'=>$settings)); ?>
