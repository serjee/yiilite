<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=User::model()->find('LOWER(email)=?',array(strtolower($this->username)));
        
		if($user===null)
        {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
            $this->errorMessage = Yii::t('UserModule.user', 'Invalid email');
        }
		else if(!$user->validatePassword($this->password))
        {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
            $this->errorMessage = Yii::t('UserModule.user', 'Invalid password');
        }
		else
		{
			$this->_id=$user->uid;
            $this->setState('email', $user->email);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}