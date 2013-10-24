<?php

Yii::import('zii.widgets.CPortlet');
 
class SignIn extends CPortlet
{
 public function init()
    {
        parent::init();
    }
 
    protected function renderContent()
    {
		echo CHtml::button('Zarejestruj się', array('submit' => array('user/create'))); 
    }

}
