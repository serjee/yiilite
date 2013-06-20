<?php
return array (
	'class' => 'CDbConnection',
	'connectionString' => 'mysql:host=localhost;port=3306;dbname=<db_name>',
	'username' => '<username>',
	'password' => '<password>',
	'emulatePrepare' => true,
	'charset' => 'utf8',
	'enableParamLogging' => true,
	'enableProfiling' => true,
	'schemaCachingDuration' => 3600,
	'tablePrefix' => 'yii_',
);