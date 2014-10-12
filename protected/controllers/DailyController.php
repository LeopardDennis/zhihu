<?php

class DailyController extends Controller
{
	public $layout = '//layouts/daily';

	public function actionIndex()
	{
		$articles = Articles::model()->findAll('deleted = 0');
		$this->render('index', array('articles' => $articles));
	}

	public function actionGetArticles()
	{
		$articlesList = array();
		$articlesSum = Articles::model()->count('deleted = 0');
		$articlesList['total'] = $articlesSum;
		$articles = Articles::model()->findAll('deleted = 0');
		foreach ($articles as $index => $article) {
			$articlesList['result'][] = array(
				'image' => $article->image_url,
				'height' => 320,
				'title' => $article->title,
			);
		}
		echo json_encode($articlesList);
	}
}