<h1><?php echo Yii::t('UserModule.user', 'Registration');?></h1>

<?php if(Yii::app()->user->hasFlash('registrationMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('registrationMessage'); ?>
</div>
<?php else: ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reg-form',
    'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,
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
	</div>
    
    <div class="control-group">
		<?php echo $form->labelEx($model,'confirmPassword',array('class'=>'control-label')); ?>
		<?php echo $form->passwordField($model,'confirmPassword'); ?>
		<span class="help-inline"><?php echo $form->error($model,'confirmPassword'); ?></span>
	</div>
    
    <div class="control-group">
        <?php $this->widget('CCaptcha', array('buttonLabel' => '['.Yii::t('UserModule.user', 'new code').']<br>')); ?>
		<?php echo $form->textField($model,'verifyCode',array('placeholder'=>Yii::t('UserModule.user', 'Enter Code'))); ?>
        <span class="help-inline"><?php echo $form->error($model,'verifyCode'); ?></span>
	</div>
    
	<div class="control-group">
		<?php echo CHtml::submitButton(Yii::t('UserModule.user', 'Registration'),array('class'=>'btn btn-large btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>
<!-- form -->
<?php endif; ?>