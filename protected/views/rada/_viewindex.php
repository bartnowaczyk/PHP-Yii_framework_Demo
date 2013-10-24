<?php
/* @var $this RadaController */
/* @var $data Rada */
if (User::model()->findByPk(Yii::app()->user->id)->akcesRada->id!=null)
	$akces=User::model()->findByPk(Yii::app()->user->id)->akcesRada->id;

if ($data->id==Yii::app()->user->getState('rada')){ 
	echo '<div class="viewOwn">'; 
}
elseif ($data->id==$akces){
	echo  '<div class="viewAkces">';
	}
else {
	echo '<div class="view">';
}
	

//var_dump(Yii::app()->user->safeAttributeNames);
?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::encode($data->id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nazwa')); ?>:</b>
	<?php echo CHtml::encode($data->nazwa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gmina')); ?>:</b>
	<?php echo CHtml::encode($data->gmina); ?>
	<br />
	<? if ($data->id==Yii::app()->user->getState('rada')) 
		echo ''; 
	else if (Yii::app()->user->getState('rada')==null)
		echo CHtml::link('Zgłoś akces do tej rady', array('rada/akces', 'id'=>$data->id),  array(
    'submit'=>array('rada/akces', 'id'=>$data->id),
    'class' => '','confirm'=>'Zgłaszasz akces do rady. Jeśli administrator rady zaakceptuje twoje zgłoszenie, dołączysz do składu rady.')
		);
		
	elseif ($data->id==$akces){
		echo "<span> Zgłosiłeś chęć przyłączenia się do tej rady. Zgłoszenie czeka na decyzję administratora.</span>";
		
	}	
	else 
		echo CHtml::link('Zgłoś akces do tej rady', array('rada/akces', 'id'=>$data->id),  array(
    'submit'=>array('rada/akces', 'id'=>$data->id),
    'class' => '','confirm'=>'Czy jesteś pewien, że chcesz zgłosić swój akces do tej rady? Jeśli administrator rady zaakceptuje twoje zgłoszenie, twoje dotychczasowa afiliacja zostania usunięta')
); ?>
	<br />
	

</div>
