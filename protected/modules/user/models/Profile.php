<?php

/**
 * This is the model class for table "{{profile}}".
 *
 * The followings are the available columns in table '{{profile}}':
 * @property string $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $uimage
 * @property string $about
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Profile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profile the static model class
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
		return '{{profile}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('user_id', 'length', 'max'=>10),
			array('firstname, lastname', 'length', 'max'=>50),
            array('uimage', 'file', 'allowEmpty'=>true, 'types'=>'jpg, jpeg, png', 'maxSize' => 4194304), // max 4Mb
            array('uimage', 'unsafe'),
            array('about', 'length', 'max'=>3000),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}
    
    /**
     * @return array behaviors for model
     */
    
    public function behaviors()
    {
        return array(            
            'SImageUploadBehavior'=>array(
                'class'=>'ext.SImageUploadBehavior.SImageUploadBehavior',
                'fileAttribute'=>'uimage',
                'nameAttribute'=>'i',
                'imagesRequired'=>array(
                    'width'=>140,
                    'height'=>140,
                    'folder'=>'users/'.Yii::app()->user->id,
                    'smartResize'=>true,
                ),
            ),

        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'UID',
			'firstname' => Yii::t('UserModule.user', 'Firstname'),
			'lastname' => Yii::t('UserModule.user', 'Lastname'),
			'uimage' => Yii::t('UserModule.user', 'User image'),
			'about' => Yii::t('UserModule.user', 'About'),
		);
	}
}