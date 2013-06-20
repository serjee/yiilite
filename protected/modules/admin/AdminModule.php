<?php

class AdminModule extends CWebModule
{
    /**
     * @var array() assets files.
     */
    public $assets = array(
        'css' => array(
            'style.css',
        ),
    );

    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        $this->setImport(array(
                              'admin.models.*',
                              'admin.components.*',
                         ));
        $this->registerClientScripts();
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action))
        {
            /** my code here */
            return true;
        }
        else
            return false;
    }

    public function registerClientScripts()
    {
        $assetsPath = Yii::app()->getTheme()->viewPath.'/admin/web/';
        
        foreach($this->assets as $assetsType=>$files)
        {
            foreach($files as $file)
            {
                $urlScript = Yii::app()->assetManager->publish($assetsPath.$assetsType.'/'.$file);
                if($assetsType == 'js')
                {
                    Yii::app()->clientScript->registerScriptFile($urlScript, CClientScript::POS_HEAD);
                } else {
                    Yii::app()->clientScript->registerCssFile($urlScript);
                }
            }
        }
    }
}
