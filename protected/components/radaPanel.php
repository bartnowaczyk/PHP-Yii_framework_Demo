<?php

Yii::import('zii.widgets.CPortlet');
 
class RadaPanel extends CPortlet
{
 public function init()
    {
        parent::init();
    }
    
    
    protected function renderContent()
    {
			$this->render('radaPanel');

	}
}	
