<?php

// path to yiiframework [now used Yii Framework v.1.1.13]
$yii=dirname(__FILE__).'/../../yii/yii-1.1.13.e9e4a0/framework/yiilite.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// debug mode (for developers)
defined('YII_DEBUG') or define('YII_DEBUG', true);

// trace level for logs
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

// require yii
require_once($yii);

// run web application
Yii::createWebApplication($config)->run();