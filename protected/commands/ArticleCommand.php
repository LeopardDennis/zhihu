<?php

class ArticleCommand extends CConsoleCommand
{
	public function actionGetLatestArticles()
	{
		Article::model()->saveLatestArticles();
	}
}