<?php

class GlosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/layoutmain';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'start'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Ustawia zmienne dla głosów
	 * 
	 **/
	public function actionStart() {
		if(Yii::app()->user->checkAccess('glosStart')) {
			$model = new Glos;
			$dzis = date("Y-m-d");
			$id = Yii::app()->user->getState('rada'); 
			$criteria = new CDbCriteria; 
			$criteria->addCondition('dataDo > "'.$dzis.'" ');	
			$criteria->addCondition('radaId = "'.$id.'" ');
			$criteria2 = new CDbCriteria; 
			$criteria2->addCondition('radaId = "'.$id.'" ');
			$glosowania = Glosowanie::model()->findAll($criteria);
			$komisje = Komisja::model()->findAll($criteria2);
			if (count($komisje)==1 && count($glosowania==1)) {
				Yii::app()->user->setState('wybKm', $komisje[0]->id);
				$this->redirect(array('create','id'=>$glosowania[0]->id));
			}
			if(isset($_POST['Glos']))
			{
				Yii::app()->user->setState('wybKm', $_POST['Glos']['komisjaId']);
				$this->redirect(array('create','id'=>$_POST['Glos']['glosowanieId']));
			}
			$this->render('start', array('model'=>$model, 'glosowania'=>$glosowania, 'komisje'=>$komisje));
		}
		else {
			throw new CHttpException(403,'Przepraszamy, ale nie masz uprawnień do wykonania tej akcji.');			
		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
*/

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
		if(Yii::app()->user->checkAccess('glosStart')) {
			$model=new Glos;
			$glosujacy = new Glosujacy;
			$glosujacyConfirm = new Glosujacy;
			$glosowanie = Glosowanie::model()->findByPk($id);
			$model->glosowanieId=$id;
			$dzis = date("Y-m-d");
			$radaId = Yii::app()->user->getState('rada'); 
			$criteria2 = new CDbCriteria; 
			$criteria2->addCondition('radaId = "'.$radaId.'" ');
			$komisje = Komisja::model()->findAll($criteria2);
			$wybKm = Yii::app()->user->getState('wybKm');
			$czy = true;
			if ($glosowanie->radaId!=$radaId)
				throw new CHttpException(403,'Przepraszamy, ale nie masz uprawnień do wykonania tej akcji.');			
			if (isset($WybKm) && $WybKm->radaId!=$radaId)
				throw new CHttpException(403,'Przepraszamy, ale nie masz uprawnień do wykonania tej akcji.');			
			Yii::app()->user->setState('wybGl',$id);	
	
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
			if(isset($_POST['Glos']))
			{
				$model->attributes=$_POST['Glos'];
				$glosujacy->attributes=$_POST['Glosujacy'];
				$glosujacy->zmien();
//				var_dump($glosujacy);
//				if ($setId=$glosowanie->settingsId)
//					$settings=Settings::model()->findByPk($setId);
//				else {
//					$setId=Rada::model->findByPk($radaId)->settingsId;
//					$settings=Settings::model()->findByPk($setId);
//				}
//				$dalej=false;
//				$query = "SELECT g.`data` , u.`imie` , u.`nazwisko` , k.`nazwa` FROM `Glos` AS g JOIN `Glosujacy` AS gl ON g.`glosujacyId` = gl.`id` JOIN `User` AS u ON g.`userId` = u.`id` JOIN `Komisja` AS k ON g.`komisjaId` = k.`id` WHERE	 ";
//				$query .= $imie . $nazwisko . $pesel . $dokument . $glosowanie;
	
				$criteria3=new CDbCriteria;
				$criteria3->join='JOIN Glosujacy ON t.glosujacyId = Glosujacy.id JOIN User ON t.userId = User.id JOIN Komisja ON t.komisjaId = Komisja.id';	
				$criteria3->select=array('*');
				$criteria3->addCondition('Glosujacy.pesel = "'.$glosujacy->pesel.'"');	
				$criteria3->addCondition('Glosujacy.imie = "'.$glosujacy->imie.'"');	
				$criteria3->addCondition('Glosujacy.nazwisko = "'.$glosujacy->nazwisko.'"');	
				$criteria3->addCondition('Glosujacy.nrDokumentu = "'.$glosujacy->nrDokumentu.'"');
				$criteria3->addCondition('t.glosowanieId = "'.$model->glosowanieId.'"');
				
				$czy=Glos::model()->find($criteria3);

				if(count($czy)>0) {
							$model->glosowanieId=$id;	
							$this->render('create',array('model'=>$model, 'komisje'=>$komisje, 'glosujacy'=>$glosujacy, 'glosowanie'=>$glosowanie, 'glosujacyConfirm'=>NULL, 'czy'=>$czy));
							$czy=false;
				}
				else {
					$glosujacy->save();
					$model->glosowanieId=$id;	
					$model->glosujacyId=$glosujacy->id;
					$model->userId=Yii::app()->user->id;
					if ($model->komisjaId==null) 
						$model->komisjaId=$wybKm;

					if($model->save()){
						if(Yii::app()->user->getState('wybGl')!=$model->glosowanieId)
							Yii::app()->user->setState('wybGl',$model->glosowanieId);
							if($wybKm==null || ($wybKm!=null && $wybKm!=$model->komisjaId)) 
							Yii::app()->user->setState('wybKm',$model->komisjaId);	 	
						
						if($glosowanie->settingsId==null) {
							$settTemp = new Settings;
							$settTemp = clone Settings::model()->findByPk(Rada::model()->findByPk(Yii::app()->user->getstate('rada'))->settingsId);
							unset($settTemp->id);
							$settTemp->isNewRecord = true;
							$settTemp->save();	
							$glosowanie->settingsId=$settTemp->id;		
							$glosowanie->save();	
						}
						$glosujacyConfirm = clone $glosujacy;
						$model->unsetAttributes();
						$glosujacy->unsetAttributes();		 	
						$this->render('create',array('model'=>$model, 'komisje'=>$komisje, 'glosujacy'=>$glosujacy, 'glosowanie'=>$glosowanie, 'glosujacyConfirm'=>$glosujacyConfirm, 'czy'=>NULL));
						$czy=false;
					}
				}
			}
//			if ( $glosujacyConfirm==null)
			if ($czy)
				$this->render('create',array('model'=>$model, 'komisje'=>$komisje, 'glosujacy'=>$glosujacy, 'glosowanie'=>$glosowanie, 'glosujacyConfirm'=>$glosujacyConfirm, 'czy'=>NULL));
		}
		else {
			throw new CHttpException(403,'Przepraszamy, ale nie masz uprawnień do wykonania tej akcji.');			
		}
		
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Glos']))
		{
			$model->attributes=$_POST['Glos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	*/
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	*/
	/**
	 * Lists all models.
	 
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Glos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Glos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Glos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Glos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='glos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
