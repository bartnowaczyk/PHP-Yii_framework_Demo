<?php
/* @var $this UserController */
/* @var $model User */

Yii::import('application.extensions.juitip.EJuiTooltip', true);
$this->widget('EJuiTooltip', array('selector' => '.tooltip'));

$this->breadcrumbs=array(
	'Użytkownicy'=>array('index'),
	'Dodaj',
);

$this->menu=array(
);
if (Yii::app()->user->isGuest) { 
?>

<h1>Zarejestruj się</h1>

<h2>i uzyskaj dostęp do funkcjonalności systemu</h2>
<? 
}
else {
?>
<h1>Dodaj nowych użytkowników </h1>

<p>Dodani użytkownicy automatycznie przypisani są do zarządzanej przez Ciebie rady.</p>
<?
}
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
