<?php

Yii::import('zii.widgets.CPortlet');
 
class LogIn extends CPortlet
{
 public function init()
    {
        parent::init();
    }
    
    
    protected function renderContent()
    {
		echo CHtml::button('Zaloguj', array('submit' => array('site/login'),'class'=>'buttonMain')); 
  }

}
