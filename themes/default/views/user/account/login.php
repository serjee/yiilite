<h1><?php echo Yii::t('UserModule.user', 'Login');?></h1>

<p><?php echo Yii::t('UserModule.user', 'Please fill out the following form with your login credentials');?>:</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions'=>array(
        'class'=>'form-signin',
    ),
)); ?>

    <div class="alert alert-block">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo Yii::t('UserModule.user', 'Required fields');?>        
    </div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'email'); ?>
		<span class="help-inline"><?php echo $form->error($model,'email'); ?></span>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'password',array('class'=>'control-label')); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<span class="help-inline"><?php echo $form->error($model,'password'); ?></span>
        <div><a href="<?=Yii::app()->createUrl('/user/account/registration') ?>"><?php echo Yii::t('UserModule.user', 'Registration');?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=Yii::app()->createUrl('/user/account/recovery') ?>"><?php echo Yii::t('UserModule.user', 'Lost password');?>?</a></div>
	</div>

	<div class="control-group">
        <?php echo $form->label($model,$form->checkBox($model,'rememberMe').' '.Yii::t('UserModule.user', 'Remember me next time'),array('class'=>'checkbox','wrapInput'=>true, 'for'=>' Login Form Remember Me')); ?>		
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>
    
	<div class="control-group">
		<?php echo CHtml::submitButton(Yii::t('UserModule.user', 'Auth'),array('class'=>'btn btn-large btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>
<!-- form -->
