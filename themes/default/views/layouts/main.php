<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language; ?>">
  <head>
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta name="keywords" content="<?php echo $this->keywords; ?>">
    <meta name="description" content="<?php echo $this->description; ?>">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/web/css/bootstrap.min.css" rel="stylesheet">    
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/web/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/web/css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/favicon.ico"/>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <!--link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png"-->

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  </head>

  <body>

    <div class="container-narrow">

      <div class="masthead">
        <?php
            $this->beginClip('navigation');
            $this->renderPartial('//layouts/navigation');
            $this->endClip();
            $this->renderClip('navigation');
        ?>
        <a href="/"><h3 class="muted"><?php echo Yii::t('main', 'Project name');?></h3></a>
      </div>
      
      <hr>

      <?php echo $content; ?>

      <hr>

    <!-- ******************		FOOTER START ****************************** -->
    <?php $this->renderPartial('//layouts/footer'); ?>
    <!-- ******************		FOOTER END ******************************** --> 

    </div> <!-- /container -->

  </body>
</html>