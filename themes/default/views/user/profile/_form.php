<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'class'=>'form-signin',
        'enctype'=>'multipart/form-data',
    ),
)); ?>

    <div class="alert alert-block">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo Yii::t('UserModule.user', 'Required fields');?>        
    </div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>50,'maxlength'=>50)); ?>
		<span class="help-inline"><?php echo $form->error($model,'firstname'); ?></span>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>50,'maxlength'=>50)); ?>
		<span class="help-inline"><?php echo $form->error($model,'lastname'); ?></span>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'uimage'); ?>
        <?php
          if ($model->uimage)
          {
            echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/users/'.$model->user_id.'/'.CHtml::encode($model->uimage), $model->firstname.' '.$model->lastname, array('class' => 'img-polaroid'));
            echo "<br>".CHtml::link(Yii::t('UserModule.user', 'Delete photo'), array('/user/profile/deletephoto'));
          }
          else
          {
            echo CHtml::image(Yii::app()->theme->baseUrl.'/web/img/nophoto.png', $model->firstname.' '.$model->lastname, array('class' => 'img-polaroid'));
          }
          echo "<br>";
        ?>
        <?php echo $form->fileField($model, 'uimage'); ?>
		<span class="help-inline"><?php echo $form->error($model,'uimage'); ?></span>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'about'); ?>
		<?php echo $form->textArea($model,'about',array('rows'=>6, 'cols'=>50)); ?>
		<span class="help-inline"><?php echo $form->error($model,'about'); ?></span>
	</div>

	<div class="control-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('UserModule.user', 'Create') : Yii::t('UserModule.user', 'Save'),array('class'=>'btn btn-large btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>
<!-- form -->