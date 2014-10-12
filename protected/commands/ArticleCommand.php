<?php

class ArticleCommand extends CConsoleCommand
{
	public function actionGetLatestArticles()
	{
		Articles::model()->saveLatestArticles();
	}

	public function actionGetHotArticles()
	{
		Articles::model()->saveHotArticles();
	}

	public function actionGetBeforeArticles($date = null)
	{
		if(!is_null($date) && strlen($date) != 8)
			return false;
		
		Articles::model()->saveBeforeArticles($date);
	}

	public function actionGetAllArticles()
	{
		for($i = 1; $i <= 5000000; $i++)
		{
			$url = 'http://news-at.zhihu.com/api/3/news/'.$i;
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);
			$output = curl_exec($curl);
			$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);

			$newsIds = new NewsIds();
			$newsIds->news_id = $i;
			$newsIds->http_code = $httpCode;
			$newsIds->created = strtotime('today');
			$res = $newsIds->save();
			$output = $res ? 'Success' : 'Failure';

			echo 'News ID: '.$i.' '.$httpCode.' '.$output."\n";
		}
	}
}