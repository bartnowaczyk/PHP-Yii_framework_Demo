<?php
/* @var $this GlosController */
/* @var $model Glos */
?>

<p>Witaj w panelu głosowania. Ustaw wymagane wartości i rozpocznij rejestrację głosujących.</p>

<?php echo $this->renderPartial('_start',array('model'=>$model, 'glosowania'=>$glosowania, 'komisje'=>$komisje)); ?>
