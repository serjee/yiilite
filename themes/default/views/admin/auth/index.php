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

    <h2 class="form-signin-heading"><?php echo Yii::t('AdminModule.admin','Please sign in'); ?></h2>
    
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
        <?php echo $form->label($model,$form->checkBox($model,'rememberMe').' '.Yii::t('AdminModule.admin', 'Remember me next time'),array('class'=>'checkbox','wrapInput'=>true, 'for'=>' Login Form Remember Me')); ?>		
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>
    
    <?php echo CHtml::submitButton(Yii::t('AdminModule.admin','Auth'),array('class'=>'btn btn-large btn-primary')); ?>

<?php $this->endWidget(); ?>
<!-- form -->
