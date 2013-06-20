<html>
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
</head>
<table cellspacing="0" cellpadding="10" style="color:#666;font:13px Arial;line-height:1.4em;width:100%;">
	<tbody>
		<tr>
            <td style="color:#779438;font-size:22px;border-bottom: 2px solid #779438;">
				<?php echo CHtml::encode(Yii::app()->name); ?>
            </td>
		</tr>
		<tr>
            <td style="color:#777;font-size:16px;padding-top:5px;">
            	<?php if(isset($data['description'])) echo $data['description']; ?>
            </td>
		</tr>
		<tr>
            <td>
				<?php echo $content ?>
            </td>
		</tr>
		<tr>
            <td style="padding:15px 20px;text-align:right;padding-top:5px;border-top:solid 1px #dfdfdf">
				<a href="http://<?=Yii::t('main', 'www.yiilite.com');?>/"><?=Yii::t('main', 'www.yiilite.com');?></a>
			</td>
		</tr>
	</tbody>
</table>
</body>
</html>