<?php

class ArticleCommand extends CConsoleCommand
{
	public function actionGetLatestArticles()
	{
		Article::model()->saveLatestArticles();
	}

	public function actionGetHotArticles()
	{
		Article::model()->saveHotArticles();
	}

	public function actionGetBeforeArticles($date = null)
	{
		if(!is_null($date) && strlen($date) != 8)
			return false;
		
		Article::model()->saveBeforeArticles($date);
	}
}