<?php
/* @var $this UserController */
/* @var $model User */


?>

<h1>Zmiana danych: <?php echo $model->fullName; ?></h1>

<?php echo $this->renderPartial('_formU', array('model'=>$model)); ?>
