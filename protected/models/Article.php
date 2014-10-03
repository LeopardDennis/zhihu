<?php

Yii::import('application.models._base.BaseArticle');

class Article extends BaseArticle
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function saveLatestArticles()
	{
		$service = new ApiService();
		$latestArticleList = $service->getLatestArticles();
		$date = isset($latestArticleList['date']) ? strtotime($latestArticleList['date']) : strtotime('today');
		$stories = isset($latestArticleList['stories']) ? $latestArticleList['stories'] : array();
		$topStories = isset($latestArticleList['top_stories']) ? $latestArticleList['top_stories'] : array();
		$newsIds = array();

		foreach($stories as $story)
		{
			$newsIds[] = $story['id'];
		}

		$this->saveArticles($newsIds, $date);
	}

	public function saveHotArticles()
	{
		$service = new ApiService();
		$hotArticleList = $service->getHotArticles();
		$recent = isset($hotArticleList['recent']) ? $hotArticleList['recent'] : array();
		$newsIds = array();
		$date = strtotime('today');

		foreach($recent as $article)
		{
			$newsIds[] = $article['news_id'];
		}

		$this->saveArticles($newsIds, $date);
	}

	public function saveBeforeArticles($date)
	{
		$service = new ApiService();
		$beforeArticleList = $service->getBeforeArticles($date);
		$date = isset($beforeArticleList['date']) ? strtotime($beforeArticleList['date']) : strtotime('today');
		$stories = isset($beforeArticleList['stories']) ? $beforeArticleList['stories'] : array();
		$newsIds = array();
		
		foreach($stories as $story)
		{
			$newsIds[] = $story['id'];
		}

		$this->saveArticles($newsIds, $date);
	}

	private function saveArticles($newsIds = array(), $date)
	{
		if(!is_array($newsIds))
			return false;

		$service = new ApiService();
		$downloadedArticles = $service->batchDownload($newsIds);

		foreach($downloadedArticles as $downloadedArticle)
		{	
			$newsId = isset($downloadedArticle['id']) ? $downloadedArticle['id'] : '';
			$article = $this->findByAttributes(array('news_id' => $newsId));
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