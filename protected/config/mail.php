<?php
return array(
    'viewPath' => 'webroot.themes.default.views.mail',
    'layoutPath' => 'webroot.themes.default.views.layouts',
    'baseDirPath' => 'webroot.themes.default.web.img.mail',
    'layout' => 'mail',
    'CharSet' => 'UTF-8',
    'AltBody' => Yii::t('mail','You need an HTML capable viewer to read this message.'),
    'language' => array(
		'authenticate'         => Yii::t('mail','SMTP Error: Could not authenticate.'),
		'connect_host'         => Yii::t('mail','SMTP Error: Could not connect to SMTP host.'),
		'data_not_accepted'    => Yii::t('mail','SMTP Error: Data not accepted.'),
		'empty_message'        => Yii::t('mail','Message body empty'),
		'encoding'             => Yii::t('mail','Unknown encoding: '),
		'execute'              => Yii::t('mail','Could not execute: '),
		'file_access'          => Yii::t('mail','Could not access file: '),
		'file_open'            => Yii::t('mail','File Error: Could not open file: '),
		'from_failed'          => Yii::t('mail','The following From address failed: '),
		'instantiate'          => Yii::t('mail','Could not instantiate mail function.'),
		'invalid_address'      => Yii::t('mail','Invalid address'),
		'mailer_not_supported' => Yii::t('mail',' mailer is not supported.'),
		'provide_address'      => Yii::t('mail','You must provide at least one recipient email address.'),
		'recipients_failed'    => Yii::t('mail','SMTP Error: The following recipients failed: '),
		'signing'              => Yii::t('mail','Signing Error: '),
		'smtp_connect_failed'  => Yii::t('mail','SMTP Connect() failed.'),
		'smtp_error'           => Yii::t('mail','SMTP server error: '),
		'variable_set'         => Yii::t('mail','Cannot set or reset variable: ')
    ),
);