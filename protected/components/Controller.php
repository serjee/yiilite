<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string layouts by default for the controller
	 */
	public $layout='//layouts/main';
    
    /**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
    
    /**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    
    /**
	 * @var string the pageTitle of the current page.
	 */
    public $pageTitle = "";
    
    /**
	 * @var string the keywords of the current page.
	 */
    public $keywords = "";
    
    /**
	 * @var string the description of the current page.
	 */
    public $description = "";    

    /**
     * 
     */
    public function beforeAction($action)
    {
        // If application is using a theme, replace default layout controller variable that start with '//layouts/' with a theme link
        if(empty(Yii::app()->theme->name) == false && isset($this->layout) == true && strpos($this->layout, '//layouts/') === 0)
        {
            // Replace path with slash by dot.
            $sThemeLayout = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.'.str_replace('/', '.', substr($this->layout,10));

            // If theme override given layout, get it from theme
            if($this->getLayoutFile($sThemeLayout) !== false)
                $this->layout = $sThemeLayout;
        }
        return true;
    }
}