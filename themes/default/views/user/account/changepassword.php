<h1><?php echo Yii::t('UserModule.user', 'Change Password'); ?></h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changepwd-form',
    'htmlOptions'=>array(
        'class'=>'form-signin',
    ),
)); ?>

    <div class="alert alert-block">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo Yii::t('UserModule.user', 'Required fields');?>        
    </div>
    
	<div class="control-group">
		<?php echo $form->labelEx($model2,'oldPassword',array('class'=>'control-label')); ?>
		<?php echo $form->passwordField($model2,'oldPassword'); ?>
		<span class="help-inline"><?php echo $form->error($model2,'oldPassword'); ?></span>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model2,'password',array('class'=>'control-label')); ?>
		<?php echo $form->passwordField($model2,'password'); ?>
		<span class="help-inline"><?php echo $form->error($model2,'password'); ?></span>
	</div>
    
	<div class="control-group">
		<?php echo $form->labelEx($model2,'verifyPassword',array('class'=>'control-label')); ?>
		<?php echo $form->passwordField($model2,'verifyPassword'); ?>
		<span class="help-inline"><?php echo $form->error($model2,'verifyPassword'); ?></span>
	</div>
	
	<div class="control-group">
	<?php echo CHtml::submitButton(Yii::t('UserModule.user', 'Save'),array('class'=>'btn btn-large btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>
<!-- form -->