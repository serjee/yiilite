<div class="container-fluid">
<h2><?=Yii::t('UserModule.user','Profile'); ?></h2>

<?php if(Yii::app()->user->hasFlash('editMessage')): ?>
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::app()->user->getFlash('editMessage'); ?>
</div>
<?php endif; ?>

  <div class="row-fluid">
    <div class="span4">
      <p>
      <?php
      if ($model->uimage)
      {
        echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/users/'.$model->user_id.'/'.CHtml::encode($model->uimage), $model->firstname.' '.$model->lastname, array('class' => 'img-polaroid'));
      }
      else
      {
        echo CHtml::image(Yii::app()->theme->baseUrl.'/web/img/nophoto.png', $model->firstname.' '.$model->lastname, array('class' => 'img-polaroid'));
      }
      ?>
      </p>
      <p>
        <ul class="nav nav-pills">
            <li><a href="<?php echo Yii::app()->createUrl('/user/profile/edit'); ?>"><?php echo Yii::t('UserModule.user','Change profile'); ?></a></li>
            <li><a href="<?php echo Yii::app()->createUrl('/user/profile/changepassword'); ?>"><?php echo Yii::t('UserModule.user','Change password'); ?></a></li>
        </ul>
      </p>
    </div>
    <div class="span8">      
      <p><strong><?php echo $model->firstname . ' ' . $model->lastname; ?></strong></p>
      <p><?php echo $model->about; ?></p>
    </div>
  </div>
</div>