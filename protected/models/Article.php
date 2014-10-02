<?php

Yii::import('application.models._base.BaseArticle');

class Article extends BaseArticle
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function saveLatestArticle()
	{
		$service = new ApiService();
		$latestArticleList = $service->getLatestArticle();
		$date = strtotime($latestArticleList['date']);
		$stories = $latestArticleList['stories'];
		$topStories = $latestArticleList['top_stories'];
		$newIds = array();

		foreach($stories as $story)
		{
			$newsIds[] = $story['id'];
		}

		$downloadedArticles = $service->batchDownload($newsIds);

		foreach($downloadedArticles as $downloadedArticle)
		{	
			$newsId = isset($downloadedArticle['id']) ? $downloadedArticle['id'] : '';
			$article = Article::model()->findByAttributes(array('news_id' => $newsId));
			if(empty($article))
				$article = new Article();
			$article->news_id = $newsId;
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
			$article->created = $date;
			$res = $article->save();
			$output =  $res ? 'Success' : 'Failure';
			echo $newsId.': '.$output.' '.date('Y-m-d h:i:s')."\n";
		}
	}
}