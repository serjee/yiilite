<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('AdminModule.admin', 'User Management');?></h1>

<hr />
<?php echo Yii::t('AdminModule.admin', 'Messages of fast filter');?>

<?php echo CHtml::link(Yii::t('AdminModule.admin', 'Show extend search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none;">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<hr />

<p>
<?php echo CHtml::link(Yii::t('AdminModule.admin', 'Create new user'),
    array('user/create','token'=>Yii::app()->getRequest()->getCsrfToken()),
    array(
        'class' => 'btn-large btn-success',
        'title' => Yii::t('AdminModule.admin', 'Create new user'),
        'csrf' => true,
    )
);
?>
</p>
<br>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'itemsCssClass' => 'table table-bordered',
    'htmlOptions' => array('class' => 'filter'),
	'columns'=>array(
		'uid',
		'email',
        array(
            'name'=>'role',
            'value'=>'$data->getRoleStringById($data->role)',
            'filter'=>array('ADMIN'=>Yii::t('AdminModule.admin', 'Admin'),'MODERATOR'=>Yii::t('AdminModule.admin', 'Moderator'),'USER'=>Yii::t('AdminModule.admin', 'User')),
        ),
		'time_update',
        array(
            'name'=>'enabled',
            'value'=>'$data->getStatusStringById($data->enabled)',
            'filter'=>array('0'=>Yii::t('AdminModule.admin', 'No'),'1'=>Yii::t('AdminModule.admin', 'Yes')),
        ),
        'ip',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}&nbsp;&nbsp;{delete}',
            'buttons'=>array
            (
                'update' => array
                (
                    'label'=>'<i class="icon-pencil icon-white"></i>',
                    'imageUrl'=>false,
                    'options'=>array('class'=>'btn btn-mini btn-primary','title'=>Yii::t('AdminModule.admin', 'Edit')),
                ),
                'delete' => array
                (
                    'label'=>'<i class="icon-trash icon-white"></i>',
                    'imageUrl'=>false,
                    'options'=>array('class'=>'btn btn-mini btn-danger','title'=>Yii::t('AdminModule.admin', 'Delete')),
                ),
            ),
		),
	),
)); ?>