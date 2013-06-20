<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $uid
 * @property string $email
 * @property string $password
 * @property string $salt
 * @property string $role
 * @property string $time_create
 * @property string $time_update
 * @property integer $enabled
 */
class User extends CActiveRecord
{
    const ROLE_ADMIN = 'ADMIN';
    const ROLE_MODERATOR = 'MODERATOR';
    const ROLE_USER = 'USER';
    
    // for capcha
    public $verifyCode;
    
    // for repeat password
    public $confirmPassword;
    
    // for old attributes
    protected $_oldAttributes;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		$rules = array(
            array('email', 'required'),
            array('password, confirmPassword', 'required', 'on'=>'regUser'),
            array('password', 'compare', 'compareAttribute'=>'confirmPassword', 'on'=>'regUser', 'message'=>Yii::t('UserModule.user', 'Retype Password is incorrect.')),
            array('email', 'email', 'message'=>Yii::t('UserModule.user', 'Invalid email')),
            array('email', 'unique', 'message'=>Yii::t('UserModule.user', 'Email already exists')),
            array('email', 'length', 'max'=>50),
            array('password, salt', 'length', 'max'=>32),
		);
        if(extension_loaded('gd') && $this->verifyCode!==false && Yii::app()->user->isGuest){
            $rules[] = array('verifyCode','captcha','on'=>'regUser','allowEmpty'=>false);
        }
        return $rules;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'profile'=>array(self::HAS_ONE, 'Profile', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => 'UID',
			'email' => Yii::t('UserModule.user', 'E-mail'),
			'password' => Yii::t('UserModule.user', 'Password'),
            'confirmPassword' => Yii::t('UserModule.user', 'Confirm password'),			
		);
	}
    
    /**
     * This is invoked after find user
     */
    protected function afterFind()
    {
        $this->_oldAttributes = $this->attributes;
        return parent::afterFind();
    }
        
    /**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
            if($this->scenario=='regUser')
			{
                $this->salt = $this->generateSalt();
                $this->password = md5($this->salt.$this->password);
                $this->time_create = new CDbExpression('NOW()');
            }
            elseif($this->scenario=='createUser')
			{
                $this->salt = $this->generateSalt();
                $this->password = md5($this->salt.$this->password);
                $this->time_create = new CDbExpression('NOW()');
            }
            elseif ($this->scenario=='editPassword')
            {
                if ($this->password != '')
                {
                    $this->salt = $this->generateSalt();
                    $this->password = md5($this->salt.$this->password);
                }
                else
                {
                    $this->password = $this->_oldAttributes['password'];
                }
            }
			return true;
		}
		else
			return false;
	}
    
    /**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt)===$this->password;
	}
    
    /**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public function hashPassword($password,$salt)
	{
		return md5($salt.$password);
	}
    
    /**
	 * Generates a salt that can be used to generate a password hash.
	 * @return string the salt
	 */
	public function generateSalt()
	{
		return uniqid('',true);
	}    
}