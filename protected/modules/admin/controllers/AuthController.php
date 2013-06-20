<?php

class AuthController extends AdminController
{
    /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
            array('allow',  // allow auth users to perform 'index' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
            array('allow',  // allow auth users to perform 'logout' actions
				'actions'=>array('logout'),
				'users'=>array('@'),
			),
			array('deny',    // deny all users
				'users'=>array('*'),
			),
		);
	}
    
	/**
	 * Auth action for admin
	 */
    public function actionIndex()
    {
        $this->pageTitle=Yii::t('AdminModule.admin', 'Auth to Admin Panel').' / '.Yii::app()->name ;
        Yii::app()->clientScript->registerCoreScript('jquery');
        
        $model=new LoginForm;
        
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
        
        if (isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
            {
                // update last visit time and ip
                $uModel = AdminUser::model()->findByPk(Yii::app()->user->id);
                $uModel->time_update = new CDbExpression('NOW()');
                $uModel->ip = $_SERVER['REMOTE_ADDR'];
                $uModel->save();
                // redirect to user profile
                $this->redirect(array("/admin/main"));
            }
        }        
        // display the login form
		$this->render('index', array('model'=>$model));
    }

	/**
	 * Logout action for admin
	 */
    public function actionLogout($token)
    {
        if (Yii::app()->getRequest()->getCsrfToken() == $token && !Yii::app()->user->isGuest)
        {
            Yii::app()->user->logout();
        }
        $this->redirect(Yii::app()->createUrl('admin'));
    }
}