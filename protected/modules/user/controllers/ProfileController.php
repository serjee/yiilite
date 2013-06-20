<?php

class ProfileController extends Controller
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
				'actions'=>array('index','edit','changepassword','deletephoto'),
				'users'=>array('@'),
			),
			array('deny',    // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    /**
	 * Displays the index page
	 */
    public function actionIndex()
    {
	    $this->pageTitle=Yii::t('UserModule.user','Profile').' / '.Yii::app()->name;
        
        $this->render('index',array('model'=>$this->loadUserModel(),));
    }
    
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit()
	{
        $this->pageTitle=Yii::t('UserModule.user', 'Edit Profile').' / '.Yii::app()->name;
        Yii::app()->clientScript->registerPackage('bootstrap');
        
		$model=$this->loadUserModel();

		// AJAX validation
		$this->performAjaxValidation($model);

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
            
			if($model->save())
            {
                Yii::app()->user->setFlash('editMessage',Yii::t('UserModule.user', 'Your profile has been successful updated!'));
                $this->redirect(array('/user/profile'));
            }				
		}
		$this->render('edit',array('model'=>$model,));
	}
    
	/**
	 * Change password
	 */
	public function actionChangepassword()
    {
        $this->pageTitle=Yii::t('UserModule.user', 'Change Password').' / '.Yii::app()->name;
        Yii::app()->clientScript->registerPackage('bootstrap');
        
		$model = new ChangePassword;
        
		if (Yii::app()->user->id)
        {
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='changepwd-form ')
			{
				echo UActiveForm::validate($model);
				Yii::app()->end();
			}
			
			if(isset($_POST['ChangePassword']))
            {
                $new_password = User::model()->findbyPk(Yii::app()->user->id);
                
                $model->attributes=$_POST['ChangePassword'];
                $model->code=$new_password->salt;
                $model->md5pwd=$new_password->password;
                
				if($model->validate())
                {
                    $new_password->salt=$new_password->generateSalt();                    
					$new_password->password = md5($new_password->salt.$model->password);					
					
                    if($new_password->save())
                    {
                        Yii::app()->user->setFlash('editMessage',Yii::t('UserModule.user', 'New password is saved'));
                        $this->redirect(array("/user/profile"));
                    }
                    else
                    {
                        $model->addError('oldPassword', Yii::t('UserModule.user', 'Unknow error. Please contact with us by E-mail: {admin_email}', array('{admin_email}'=>Yii::app()->params['adminEmail'])));
                        $this->render("changepassword", array('model2' => $model));
                    }					
				}
			}
			$this->render('changepassword',array('model2'=>$model));
	    }
	}
    
	/**
	 * Change password
	 */
	public function actionDeletephoto()
    {
        if (Yii::app()->user->id)
        {
            $model=$this->loadUserModel();
            $model->scenario="deletePhoto"; // see action for delete in SImageUploadBehavior
            if($model->save())
            {
                Yii::app()->user->setFlash('editMessage',Yii::t('UserModule.user', 'Your image has been delted successfuly!'));
                $this->redirect(array("/user/profile/edit"));
            }
            else
            {
                $model->addError('uimage', Yii::t('UserModule.user', 'Error while delete image'));
                $this->render('edit',array('model'=>$model,));
            }
        }
    }
    
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Profile the loaded model
	 * @throws CHttpException
	 */
	public function loadUserModel()
	{
		$model=Profile::model()->findByPk(Yii::app()->user->id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
	/**
	 * Performs the AJAX validation.
	 * @param Profile $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}