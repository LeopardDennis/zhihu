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

	public function actionDownloadArticles()
	{
		while($newsIdsModel = NewsIds::model()->find("deleted = 0")){
			$newsId = $newsIdsModel->news_id;
			$newsIdsModel->deleted = 1;
			$newsIdsModel->save();
			$service = new ApiService();
			$downloadedArticle = $service->downloadArticle($newsId);
			$downloadNewsId = isset($downloadedArticle['id']) ? $downloadedArticle['id'] : '';
			$article = Articles::model()->findByAttributes(array('news_id' => $downloadNewsId));
			if(empty($article))
				$article = new Articles();
			$article->news_id = $downloadNewsId;
			$article->title = $title = isset($downloadedArticle['title']) ? $downloadedArticle['title'] : '';
			$article->image_url = $imageUrl = isset($downloadedArticle['image']) ? $downloadedArticle['image'] : '';
			$article->body = $body = isset($downloadedArticle['body']) ? $downloadedArticle['body'] : '';
			$article->share_url = $shareUrl = isset($downloadedArticle['share_url']) ? $downloadedArticle['share_url'] : '';
			$article->image_source = $imageSource = isset($downloadedArticle['image_source']) ? $downloadedArticle['image_source'] : '';
			$article->section_id = $sectionId = isset($downloadedArticle['section_id']) ? $downloadedArticle['section_id'] : '';
			$article->section_name = $sectionName = isset($downloadedArticle['section_name']) ? $downloadedArticle['section_name'] : '';
			$article->js_url = $jsUrl = isset($downloadedArticle['js']) ? json_encode($downloadedArticle['js']) : '';
			$article->css_url = $cssUrl = isset($downloadedArticle['css']) ? json_encode($downloadedArticle['css']) : '';
			$article->type = $type = isset($downloadedArticle['type']) ? $downloadedArticle['type'] : '';
			$article->created = strtotime('today');
			$res = $article->save();
			$output =  $res ? 'Success' : 'Failure';
			echo $newsId.': '.$output.' '.date('Y-m-d h:i:s')."\n";
		}
	}
}