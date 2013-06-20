<div class="footer">
    <p>
        <?=Yii::t('main', 'Project idea');?> &copy; <?=Yii::t('main', 'www.yiilite.com');?>, <?php echo date('Y') ?><br />
        <?=Yii::t('main', 'Powered by');?> <a rel="nofollow" href="http://<?=Yii::t('main', 'www.yiilite.com');?>/" target="_blank" title="<?=Yii::t('main', 'Company Name');?>"><?=Yii::t('main', 'www.yiilite.com');?></a><br />
        <?=Yii::t('main', 'Using the site, you agree to');?> <a href="#"><?=Yii::t('main', 'License');?></a><br />
        <!-- for debug -->
        <?=Yii::t('main', 'Generate time');?>: <?=sprintf('%0.5f',Yii::getLogger()->getExecutionTime())?>s. <?=Yii::t('main', 'Memory used');?>: <?=round(memory_get_peak_usage()/(1024*1024),2)."Mb"?><br />
        <!-- /for debug -->
    </p>
 </div>