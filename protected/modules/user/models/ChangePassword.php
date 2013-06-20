<?php
/**
 * ChangePassword class.
 * ChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action of 'UserController'.
 */
class ChangePassword extends CFormModel
{
	public $oldPassword;
	public $password;
	public $verifyPassword;
    
    public $code;
	public $md5pwd;
    
	public function rules()
    {
		return Yii::app()->controller->id == 'recovery' ? array(
			array('password, verifyPassword', 'required'),
			array('password, verifyPassword', 'length', 'max'=>128, 'min' => 4,'message' => Yii::t('UserModule.user', 'Incorrect password (minimal length 4 symbols).')),
			array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => Yii::t('UserModule.user', 'Retype Password is incorrect.')),
		) : array(
			array('oldPassword, password, verifyPassword', 'required'),
			array('oldPassword, password, verifyPassword', 'length', 'max'=>128, 'min' => 4,'message' => Yii::t('UserModule.user', 'Incorrect password (minimal length 4 symbols).')),
			array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => Yii::t('UserModule.user', 'Retype Password is incorrect.')),
			array('oldPassword', 'verifyOldPassword'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'oldPassword'=>Yii::t('UserModule.user', 'Old Password'),
			'password'=>Yii::t('UserModule.user', 'New password'),
			'verifyPassword'=>Yii::t('UserModule.user', 'Retype new password'),
		);
	}
	
	/**
	 * Verify Old Password
	 */
    public function verifyOldPassword($attribute, $params)
    {
        if ($this->md5pwd != md5($this->code.$this->$attribute))
            $this->addError($attribute, Yii::t('UserModule.user', 'Old Password is incorrect.'));
    }
}