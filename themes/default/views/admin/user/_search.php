<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'htmlOptions'=>array(
        'class'=>'form-inline',
    ),
)); ?>

    <?php echo $form->textField($model,'email',array('class'=>'input-medium','maxlength'=>50,'placeholder'=>Yii::t('AdminModule.admin', 'E-mail'))); ?>
    
    <?php echo $form->dropDownList($model, 'role', array('ADMIN'=>Yii::t('AdminModule.admin', 'Admin'), 'MODERATOR'=>Yii::t('AdminModule.admin', 'Moderator'), 'USER'=>Yii::t('AdminModule.admin', 'User')),array('class'=>'span2')); ?>
    
    <?php echo $form->textField($model,'time_update',array('class'=>'input-medium','maxlength'=>30,'placeholder'=>Yii::t('AdminModule.admin', 'Time Update'))); ?>
    
    <?php echo $form->dropDownList($model,'enabled',array('0'=>Yii::t('AdminModule.admin', 'No active'), '1'=>Yii::t('AdminModule.admin', 'Active')),array('class'=>'span2')); ?>
    
    <?php echo $form->textField($model,'ip',array('class'=>'input-medium','maxlength'=>20,'placeholder'=>Yii::t('AdminModule.admin', 'IP address'))); ?>
    
    <?php echo CHtml::submitButton(Yii::t('AdminModule.admin', 'Search'), array('class'=>'btn')); ?>
    
<?php $this->endWidget(); ?>
<!-- search-form -->