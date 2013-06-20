<?php

class MainController extends AdminController
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
			array('allow',   // allow ADMIN users to perform 'index' actions
				'actions'=>array('index'),
				'roles'=>array('ADMIN'),
			),
			array('deny',    // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    /**
	 * Manages last news models.
	 */
    public function actionIndex()
    {
        $this->pageTitle=Yii::t('AdminModule.admin','Admin panel').' / '.Yii::app()->name ;
        
        $this->render('index',array('model'=>$model));
    }
    
}