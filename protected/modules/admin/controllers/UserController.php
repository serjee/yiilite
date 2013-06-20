<?php

class UserController extends AdminController
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
			array('allow',   // allow admin users to perform 'delete','create','update','index' actions
				'actions'=>array('delete','create','update','index'),
				'roles'=>array('ADMIN'),
			),
			array('deny',    // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    /**
	 * Manages all models.
	 */
	public function actionIndex()
	{
        $this->pageTitle=Yii::app()->name . Yii::t('AdminModule.admin', 'User Management');
        
        $model=new AdminUser('search');
        $model->unsetAttributes();    // clear any default values
        
        if(isset($_GET['AdminUser']))
            $model->attributes=$_GET['AdminUser'];
    
        $this->render('index',array('model'=>$model,));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $this->pageTitle=Yii::app()->name . Yii::t('AdminModule.admin', 'Create new user');
        
        $model=new AdminUser('createUser');
    
        // AJAX validation
        $this->performAjaxValidation($model);
    
        if(isset($_POST['AdminUser']))
        {
            $model->attributes=$_POST['AdminUser'];
                
            if($model->validate('createUser'))
            {
                if($model->save())
                {
                    // set empty profile for new user
                    $p_model = new Profile('regUser');
                    $p_model->user_id = $model->uid;
                    $p_model->save();
                        
                    Yii::app()->user->setFlash('createMessage',Yii::t('AdminModule.admin', 'The user has been created successfully!'));
                    $this->redirect(array("/admin/user/create"));
                }
                else
                {
                    $model->addError('email', Yii::t('AdminModule.admin', 'Unknow error. Please contact with us by E-mail: {admin_email}', array('{admin_email}'=>Yii::app()->params['adminEmail'])));
                    $this->render("create", array('model'=>$model));
                }
            }
        }
        $this->render('create',array('model'=>$model,));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        $this->pageTitle=Yii::t('AdminModule.admin', 'Edit user').' / '.Yii::app()->name;
        
        $model=$this->loadModel($id);
        $model->scenario='editPassword';
    
        // AJAX validation
        $this->performAjaxValidation($model);
    
        if(isset($_POST['AdminUser']))
        {
            $model->attributes=$_POST['AdminUser'];
            if($model->save())
            {
                Yii::app()->user->setFlash('updateMessage',Yii::t('AdminModule.admin', 'The user has been edited successfully!'));
                $this->redirect(array("/admin/user/update/id/".$id));
            }
            else
            {
                $model->addError('email', Yii::t('AdminModule.admin', 'Unknow error. Please contact with us by E-mail: {admin_email}', array('{admin_email}'=>Yii::app()->params['adminEmail'])));
                $this->render("update", array('model'=>$model));
            }
        }    
        $this->render('update',array('model'=>$model,));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();
    
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,Yii::t('AdminModule.admin', 'Invalid request. Please do not repeat this request again'));
	}	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
        $model=AdminUser::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('AdminModule.admin', 'The requested page does not exist'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
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
