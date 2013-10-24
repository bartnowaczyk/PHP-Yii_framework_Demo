<?php  $rola = Yii::app()->user->getState('role');?>
<?php
$zgloszenia = count(Rada::model()->findByPk(Yii::app()->user->getState('rada'))->zgloszenia);

?>

<p>Aktualne ustawienia:</p>
<ul>
	<li class=dd><?php echo CHtml::link('Panel głosowania', array('glos/start')) ?></li>
	<li></li>
    <li>Użytkownik: <strong><?php echo User::model()->findByPk(Yii::app()->user->id)->FullName  ?></strong></li>		
		<ul>
			<li class="bb"><? echo CHtml::link('Szczegóły', array('user/view/'. Yii::app()->user->id)); ?></li>
			<li class="bb"><? echo CHtml::link('Aktualizuj', array('user/update/'. Yii::app()->user->id)); ?></li>    
			<li class="bb"><? echo CHtml::link('Zmień hasło', array('user/updatePassword/'. Yii::app()->user->id)); ?></li>    
		</ul>
   
	</li>
    <li>Twoja  rada: <strong><?php echo Rada::model()->findByPk(Yii::app()->user->getState('rada'))->nazwa; ?></strong></li>
		<ul>
			<li class="bb"><? echo CHtml::link('Szczegóły', array('rada/view/'. Yii::app()->user->getState('rada'))); ?></li>
		<?php if ($rola==1) { ?>
			<li class="bb"><? echo CHtml::link('Aktualizuj', array('rada/update/'. Yii::app()->user->getState('rada'))); ?></li>    
		<? } ?>
		</ul>
    <li>Głosowania:</li>	
		<ul>
			<li class="bb"><? echo CHtml::link('Aktualne', array('glosowanie/indexRada/'.Yii::app()->user->getState('rada'))); ?></li>    
			<li class="bb"><? echo CHtml::link('Zakończone', array('glosowanie/indexRadaArchive/'.Yii::app()->user->getState('rada'))); ?></li>    
		<?php if ($rola==1 || $rola==2)  {?>
			<li class="bb"><? echo CHtml::link('Dodaj', array('glosowanie/create') ); ?></li>    				
		<? } ?>
		</ul>
	<li>Ludzie rady(<?php echo count(Rada::model()->findByPk(Yii::app()->user->getState('rada'))->czlonkowie); ?>):</li>	
		<ul>
			<li class="bb"><? echo CHtml::link('Pokaż', array('user/indexRada/'.Yii::app()->user->getState('rada'))); ?></li>    
		<?php if ($rola==1 || $rola==2) { ?>
			<li class="bb"><? echo CHtml::link('Dodaj', array('user/create')); ?></li>     			
		<? } ?>
		</ul>
	<li>Komisje (<?php echo count(Rada::model()->findByPk(Yii::app()->user->getState('rada'))->komisje)?>):</li>
		<ul>
			<li class="bb"><? echo CHtml::link('Pokaż', array('komisja/indexRada/'.Yii::app()->user->getState('rada'))); ?></li>    
		<?php if ($rola==1 || $rola==2) { ?>
			<li class="bb"><? echo CHtml::link('Nowa komisja', array('komisja/create')); ?></li>     			
		<? } ?>
		</ul>

</ul>
