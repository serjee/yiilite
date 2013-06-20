<?php

/**
 * RecoveryForm class.
 * RecoveryForm is the data structure for keeping
 * user recovery form data. It is used by the 'recovery' action of 'UserController'.
 */
class RecoveryForm extends CFormModel
{
    public $email;
    public $user_id;
    public $verifyCode;
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the recovery page
			'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xf5f5f5,
                'minLength' => 5,
                'maxLength' => 6,
                'testLimit' => 2,
                'width' => 160,
                'height' => 60,
                'transparent'=>false,
                'foreColor'=>0xE16020, //цвет символов
            ),
		);
	}
    
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		$rules = array(
			// username and password are required
			array('email', 'required'),
			array('email', 'email'),
			// password needs to be authenticated
			array('email', 'checkexists'),
		);
        if(extension_loaded('gd') && $this->verifyCode!==false && Yii::app()->user->isGuest){
            $rules[] = array('verifyCode','captcha','allowEmpty'=>false);
        }
        return $rules;
	}
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>Yii::t('UserModule.user', 'Your E-mail'),
		);
	}
	
    public function checkexists($attribute,$params)
    {
		if(!$this->hasErrors())  // we only want to authenticate when no input errors
		{
            $user=User::model()->findByAttributes(array('email'=>$this->email));
            
            if ($user)
            {
                $this->user_id=$user->uid;
            }
            else
            {
                $this->addError("email",Yii::t('UserModule.user', 'Invalid email'));
            }
		}
	}
	
}