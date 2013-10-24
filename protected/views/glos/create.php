<?php
/* @var $this GlosController */
/* @var $model Glos */

if($glosujacyConfirm==null) {
	$user2=User::model()->findByPk($czy->userId);
?>	

<div class=alertBox>
<div class=alertLine>Uwaga! Osoba o takich danych już głosowała w dniu  <?php echo $czy->data; ?>.  
	Osoba przyjmująca głos: <? echo $czy->user->imie . ' ' . $czy->user->nazwisko  ; ?>. Komisja: <? echo $czy->komisja->nazwa?></div>
</div>
<?php 
}
else if($glosujacyConfirm->id!=null) {

?>	

<div class=confirmationBox>
<div class=confirmationLine>Glos został zapisany. Głosujący został zapisany pod numerem ID: <?php echo $glosujacyConfirm->id; ?>. Aktualna ilość głosów: <? echo $glosowanie->getStatystyki(); ?></div>
</div>
<?php 
}
?>

<h1>Zapisz głos!</h1>
<p>Głosowanie: <strong><?php echo $glosowanie->nazwa; ?> </strong>
<br>Głosowanie otwarte między:<strong> <?php echo $glosowanie->dataOd . "</strong> a <strong>" . $glosowanie->dataDo ; ?></strong>
<br>Osoba przjmująca głos: <strong><?php echo User::model()->findByPk(Yii::app()->user->id)->fullName; ?></strong>

<?php 
$wybKm=Yii::app()->user->getState('wybKm');
if ($wybKm!=null)
	echo "<br>Komisja: <strong>" . Komisja::model()->findByPk($wybKm)->nazwa . "</strong> " . CHtml::link('Zmień', array('komisja/change'));

echo $this->renderPartial('_form', array('model'=>$model, 'komisje'=>$komisje, 'glosujacy'=>$glosujacy, 'glosowanie'=>$glosowanie, 'glosujacyConfim'=>$glosujacyConfirm, 'czy'=>$czy
)); ?>
