<?php
/**
 * AdminController Class
 */
class AdminController extends CController
{
	/**
	 * @var string layouts by default for the controller
	 */
    public $layout='main';
    
    /**
	 * @var string the pageTitle of the current page.
	 */
    public $pageTitle = "";
    
    /**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
}