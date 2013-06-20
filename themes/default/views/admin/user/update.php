<h1><?php echo Yii::t('AdminModule.admin', 'Edit user with UID');?> <?php echo $model->uid; ?></h1>

<?php if(Yii::app()->user->hasFlash('updateMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('updateMessage'); ?>
</div>
<?php else: ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php endif; ?>