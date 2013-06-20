<h1><?php echo Yii::t('AdminModule.admin', 'Create new user'); ?></h1>

<?php if(Yii::app()->user->hasFlash('createMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('createMessage'); ?>
</div>
<?php else: ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php endif; ?>