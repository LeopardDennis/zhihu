<!DOCTYPE html>
<!--[if IE 8]>         <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/fonts.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/animate.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl;?>/css/main.css<?php echo '?v='.Yii::app()->clientScript->cssVersion;?>">
        <?php
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bootstrap.min.js', CClientScript::POS_HEAD);
            Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/main.js', CClientScript::POS_HEAD);
        ?>
        <title>知乎日报</title>
        <meta name="viewport" content="width=device-width">
        <!--[if lt IE 9]>
          <script src="//oss.maxcdn.com/libs/html5shiv/3.6.2/html5shiv.js"></script>
          <script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script>
            var baseUrl = '<?php echo Yii::app()->baseUrl; ?>';
            var absoluteUrl = location.protocol+'//'+location.host+baseUrl;
        </script>
	</head>
	<body>
		<?php echo $content; ?>
	</body>
</html>