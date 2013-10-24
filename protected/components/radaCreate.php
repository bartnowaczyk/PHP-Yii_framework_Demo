<?php

Yii::import('zii.widgets.CPortlet');
 
class RadaCreate extends CPortlet
{
 public function init()
    {
        parent::init();
    }
    
    
    protected function renderContent()
    {
		echo CHtml::button('Nowa rada', array('submit' => array('rada/create'))); 
  }

}
