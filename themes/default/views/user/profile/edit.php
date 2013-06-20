<h1><?php echo Yii::t('UserModule.user', 'Edit Profile'); ?></h1>

<?php if(Yii::app()->user->hasFlash('editMessage')): ?>
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">?</button>
    <?php echo Yii::app()->user->getFlash('editMessage'); ?>
</div>
<?php endif; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>