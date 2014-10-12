<?php 
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/waterfall.css');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/waterfall.min.js', CClientScript::POS_HEAD);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/handlebars.js', CClientScript::POS_HEAD);
?>
<div id="zh-content">
	<script type="text/x-handlebars-template" id="waterfall-tpl">
	{{#result}}
	    <div class="zh-item">
	    	<img src="{{image}}" height="{{height}}" />
	    	<div class="zh-item-title">{{title}}</div>
	    </div>
	{{/result}}
	</script>
</div>

<script>
	$('#zh-content').waterfall({
	    itemCls: 'zh-item',
	    colWidth: 320,
	    gutterWidth: 30,
	    gutterHeight: 30,
	    checkImagesLoaded: false,
	    isAnimated: true,
	    animationOptions: {
	    },
	    path: function(page) {
	        return baseUrl + '/daily/getArticles';
	    },
	});
</script>