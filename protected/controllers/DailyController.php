<?php

class DailyController extends Controller
{
	public $layout = '//layouts/daily';

	public function actionIndex()
	{
		$articles = Article::model()->findAll('deleted = 0');
		$this->render('index', array('articles' => $articles));
	}
}