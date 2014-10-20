<?php 
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/waterfall.css');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/waterfall.min.js', CClientScript::POS_HEAD);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/handlebars.js', CClientScript::POS_HEAD);
?>
<div id="zh-content">
	<script type="text/x-handlebars-template" id="waterfall-tpl">
	{{#result}}
	    <div class="zh-item" data-shareurl="{{shareUrl}}">
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
        maxPage: 5,
        checkImagesLoaded: false,
        isAnimated: true,
        callbacks: {
            loadingFinished: function($loading, isBeyondMaxPage) {
                if ( !isBeyondMaxPage ) {
                    $loading.fadeOut();
                } else {
                    $loading.hide();
                }
            },
            renderData: function (data, dataType) {
                var tpl,
                    template,
                    resultNum = data.total;
                if ( resultNum < 20) {
                    $('#zh-content').waterfall('pause', function() {

                    });
                }
                if ( dataType === 'json' ||  dataType === 'jsonp'  ) {
                    tpl = $('#waterfall-tpl').html();
                    template = Handlebars.compile(tpl);
                    return template(data);
                } else {
                    return data;
                }
            }
        },
	    path: function(page) {
	        return baseUrl + '/daily/getArticles/page/' + page;
	    },
	});

	$(function() {
		$('#zh-content').on('click', '.zh-item', function(){
			var shareUrl = $(this).data('shareurl');
			window.open(shareUrl);
		})
	});
</script>