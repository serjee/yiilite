<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'base for your startup\'s using Yii&Bootstrap',
	'import'=>array(
		'ext.YiiMailer.YiiMailer',
	),
	// application components
	'components'=>array(
		'db' => require(dirname(__FILE__) . '/db.php'),
	),
);