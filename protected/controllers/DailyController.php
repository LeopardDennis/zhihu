<?php

class DailyController extends Controller
{
	public $layout = '//layouts/daily';

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionGetArticles()
	{
		$page = Yii::app()->request->getQuery('page', 1);
		$articlesList = array();
		$articles = Yii::app()->db->createCommand()
					->from('articles')
					->where("deleted = 0")
					->limit(30)
					->offset(($page-1) * 30)
					->order('news_id DESC')
					->queryAll();

		$articlesList['total'] = count($articles);
		foreach ($articles as $index => $article) {
			$articlesList['result'][] = array(
				'image' => $article['image_url'],
				'height' => 320,
				'title' => $article['title'],
				'shareUrl' => $article['share_url'],
			);
		}
		echo json_encode($articlesList);
	}
}