<?php
/* @var $this UserController */
/* @var $data User */
?>


<ul>
		<li> <?php echo CHtml::encode($data->fullName); ?> - <? echo CHtml::button('Dodaj do komisji',array('submit'=>array('komisja/addUser/'. $data->id), 'class'=>"buttonek")) ?></li>
</ul>


	

