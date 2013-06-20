<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language; ?>">
  <head>
    <meta charset="utf-8">
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/web/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/web/css/bootstrap-responsive.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    

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

    <div id="wrap">
    
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="/"><?php echo Yii::t('AdminModule.admin', 'Project name')?></a>
          <div class="nav-collapse collapse">
            <?php
            if($this->id!='login')
                $this->renderPartial('/layouts/navigation');
            ?>
          </div>
        </div>
      </div>
    </div>

    <div class="container page">
        <?php echo $content; ?>        
    </div> <!-- /container -->
    
    <div id="push"></div>
    </div>

    <div id="footer">
        <?php $this->renderPartial('/layouts/footer'); ?>
    </div>
    
  </body>
</html>