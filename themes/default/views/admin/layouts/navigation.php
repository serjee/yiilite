<ul class="nav">
    <li>
        <?php echo CHtml::link(Yii::t('AdminModule.admin', 'Panel'),
                               array('/admin/main','token'=>Yii::app()->getRequest()->getCsrfToken()),
                               array(
                                    'title' => Yii::t('AdminModule.admin', 'Panel'),
                                    'csrf' => true,
                               )
                );
        ?>
    </li>
    <li>
        <?php echo CHtml::link(Yii::t('AdminModule.admin', 'Users'),
                               array('/admin/user','token'=>Yii::app()->getRequest()->getCsrfToken()),
                               array(
                                    'title' => Yii::t('AdminModule.admin', 'Users'),
                                    'csrf' => true,
                               )
                );
        ?>
    </li>
    <li>
        <?php echo CHtml::link(Yii::t('AdminModule.admin', 'Logout'),
                               array('/admin/auth/logout','token'=>Yii::app()->getRequest()->getCsrfToken()),
                               array(
                                    'title' => Yii::t('AdminModule.admin', 'Logout'),
                                    'csrf' => true,
                               )
                );
        ?>
    </li>
</ul>