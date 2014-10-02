<?php

class ArticleCommand extends CConsoleCommand
{
	public function actionLatestArticle()
	{
		Article::model()->saveLatestArticle();
	}
}