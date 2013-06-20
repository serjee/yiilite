<!-- HeadMenu  -->
<?php
$this->widget('Menu', array(
    'items' => array(
        array('label' => Yii::t('main', 'English'), 'url'=>array('/main/index')),
        array('label' => Yii::t('main', 'Profile'), 'url'=>array('/user/profile'), 'visible'=>!Yii::app()->user->isGuest),
        array('label' => Yii::t('main', 'Panel'), 'url'=>array('/admin/'), 'visible'=>Yii::app()->user->checkAccess('ADMIN')),
        array('label' => Yii::t('main', 'Login'), 'url'=>array('/user/account'), 'visible'=>Yii::app()->user->isGuest),
        array('label' => Yii::t('main', 'Logout'), 'url'=>array('/user/account/logout'), 'visible'=>!Yii::app()->user->isGuest),
    ),
    'htmlOptions' => array('class' => 'nav nav-pills pull-right'),
    'activeCssClass' => 'active',
    'itemTemplate' => '{menu}',
));
?>
<!-- /HeadMenu -->