<?php

class UserController extends Controller
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
			array('allow',
				'actions'=>array('create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','index', 'indexRada','view', 'viewRada', 'updatePassword'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
	   if($obj = User::model()->findByPk($id)){
			$params = array('id'=>$obj->id);
			if(Yii::app()->user->checkAccess('userView', $params)) {
				$this->render('view',array(
				'model'=>$this->loadModel($id),
				));
			}
			else {
				throw new CHttpException(403,'Przepraszamy, ale nie masz uprawnień do wykonania tej akcji.');			
			}
		}
		else {
				throw new CHttpException(400,'Przepraszamy, brak danych.');					
		}
	}

	public function actionViewRada($id)
	{
		if ($obj = User::model()->findByPk($id)) {
			$params = array('rada'=>$obj->rada_id);
			if(Yii::app()->user->checkAccess('userViewRada', $params)) {
				$this->render('view',array(
				'model'=>$this->loadModel($id),
				));
			}
			else {
				throw new CHttpException(403,'Przepraszamy, ale nie masz uprawnień do wykonania tej akcji.');			
			}
		}
		else {
				throw new CHttpException(400,'Przepraszamy, niepoprawne dane.');			
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
			
			$model=new User;
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
			
			if(isset($_POST['User']))
			{
				$model->attributes=$_POST['User'];
				if($model->save()){
					Yii::app()->authManager->assign($model->rola, $model->id);
					if(Yii::app()->user->getState('rada')!=null){
						$this->redirect(array('indexRada','id'=>Yii::app()->user->getState('rada')));
					}
					else{
						$this->redirect(array('site/login?if=true'));
					}
				}
			}

			$this->render('create',array(
				'model'=>$model,
				
			));
		}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	 
	public function actionUpdate($id)
	{
	    if($obj = User::model()->findByPk($id)){
			$params = array('id'=>$obj->id);
			if(Yii::app()->user->checkAccess('userUpdate', $params)) {
				$model=$this->loadModel($id);

				// Uncomment the following line if AJAX validation is needed
				// $this->performAjaxValidation($model);

				if(isset($_POST['User']))
				{
					$model->attributes=$_POST['User'];
					if($model->save())
						$this->redirect(array('view','id'=>$model->id));
				}
			
				$this->render('update',array(
					'model'=>$model,
				));
			}
			else {
				throw new CHttpException(403,'Przepraszamy, ale nie masz uprawnień do wykonania tej akcji.');
			}
		}
		else {
				throw new CHttpException(400,'Przepraszamy, Nieprawidłowy paramertr.');
		}
	}

	public function actionUpdatePassword($id)
	{
	    if($obj = User::model()->findByPk($id)){
			$params = array('id'=>$obj->id);
			if(Yii::app()->user->checkAccess('userUpdate', $params)) {
				$model=$this->loadModel($id);
				$password=$model->haslo;
				// Uncomment the following line if AJAX validation is needed
				// $this->performAjaxValidation($model);

				if(isset($_POST['User']))
				{
					$model=$this->loadModel($id);
					$potw = $_POST['User']['initialPasswd'];
	
					if ($model->haslo === crypt($potw, $model->haslo)) {		
	//				if (md5(md5($potw).Yii::app()->params["bbb"])===$model->haslo){
						$model->haslo=$_POST['User']['newHaslo'];	
						if($model->save())		
						$this->redirect(array('view','id'=>$model->id));
					}
					else {
						throw new CHttpException(400,'Błąd');
					}
				}
			
				$this->render('updatePassword',array(
					'model'=>$model,
				));
			}
			else {
				throw new CHttpException(403,'Przepraszamy, ale nie masz uprawnień do wykonania tej akcji.');
			}
		}
		else {
				throw new CHttpException(400,'Przepraszamy, Nieprawidłowy paramertr.');
		}
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	 
	public function actionDelete($id)
	{
	    $obj = User::model()->findByPk($id);
		$params = array('id'=>$obj->id);
		if(Yii::app()->user->checkAccess('userDelete')) {
			$this->loadModel($id)->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//			if(!isset($_GET['ajax']))
//				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			redirect(array('user'));
		}
		else {
			throw new CHttpException(403,'Przepraszamy, ale nie masz uprawnień do wykonania tej akcji.');
		}

	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		if(Yii::app()->user->checkAccess('userIndex')) {
			$rada=Yii::app()->user->getState('rada');
			if($rada==null) {
				$dataProvider=new CActiveDataProvider('User');
			}
			else {
				$dataProvider=new CActiveDataProvider('User', array(
					'criteria'=>array(
						'condition'=>'rada_id='. $rada,		
					)
				));
			}
						$this->render('index',array(
				'dataProvider'=>$dataProvider,
			));
		}
		else {
			throw new CHttpException(403,'Przepraszamy, ale nie masz uprawnień do wykonania tej akcji.');			
		}
	}

	/**
	 * Lists all models.
	 */

	public function actionIndexRada($id)
	{
		if(Yii::app()->user->checkAccess('userIndex')) {
			$rada=Yii::app()->user->getState('rada');
			if($rada==null) {
				$dataProvider=new CActiveDataProvider('User');
			}
			else {
				$dataProvider=new CActiveDataProvider('User', array(
					'criteria'=>array(
						'condition'=>'rada_id='. $rada,		
						'order'=>'rola',
					)
				));
			}
						$this->render('index',array(
				'dataProvider'=>$dataProvider,
			));
		}
		else {
			throw new CHttpException(403,'Przepraszamy, ale nie masz uprawnień do wykonania tej akcji.');			
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	

}
