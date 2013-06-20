<?php

class MainController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        // view page title
        $this->pageTitle = Yii::app()->name.' - '.Yii::t('main', 'Project description');
        
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{	   
		if($error=Yii::app()->errorHandler->error)
		{
            // view page title
            $this->pageTitle=Yii::t('main', 'Error').' / '.Yii::app()->name;
            
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}