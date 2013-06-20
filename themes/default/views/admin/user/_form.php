<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'class'=>'form-s-input max-w300',
    ),
)); ?>

    <div class="control-group">
        <?php echo $form->labelEx($model,'email'); ?>
    	<div class="input-prepend">
            <span class="add-on"><i class="icon-envelope"></i></span>
    		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50,'placeholder'=>Yii::t('AdminModule.admin', 'E-mail'),'class'=>'span3')); ?>    		
    	</div>
        <?php echo $form->error($model,'email',array('class'=>'text-error')); ?>
    </div>
    
    <div class="control-group">
        <?php echo $form->labelEx($model,'password'); ?>
    	<div class="input-prepend">
            <span class="add-on"><i class="icon-lock"></i></span>
    		<?php echo $form->textField($model,'password',array('maxlength'=>32,'placeholder'=>Yii::t('AdminModule.admin', 'Password'),'class'=>'span3','value'=>'')); ?>                		
    	</div>
        <?php if(!$model->isNewRecord) echo '<p class="muted small">'.Yii::t('AdminModule.admin', 'If you no want to change password').'</p>'; ?>
        <?php echo $form->error($model,'password',array('class'=>'text-error')); ?>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'role'); ?>
    	<div class="input-prepend">
            <span class="add-on"><i class="icon-pencil"></i></span>
            <?php echo $form->dropDownList($model, 'role', array('ADMIN'=>Yii::t('AdminModule.admin', 'Admin'), 'MODERATOR'=>Yii::t('AdminModule.admin', 'Moderator'), 'USER'=>Yii::t('AdminModule.admin', 'User')),array('class'=>'span3')); ?>    		
    	</div>
        <?php echo $form->error($model,'role',array('class'=>'text-error')); ?>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'enabled'); ?>
    	<div class="input-prepend">
            <span class="add-on"><i class="icon-eye-close"></i></span>
            <?php echo $form->dropDownList($model, 'enabled', array('0'=>Yii::t('AdminModule.admin', 'No active'), '1'=>Yii::t('AdminModule.admin', 'Active')),array('class'=>'span3')); ?>    		
    	</div>
        <?php echo $form->error($model,'enabled',array('class'=>'text-error')); ?>
    </div>

	<div align="center">
        <div class="controls">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('AdminModule.admin', 'Create') : Yii::t('AdminModule.admin', 'Save'), array('class'=>'btn btn-success')); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>
<!-- form -->