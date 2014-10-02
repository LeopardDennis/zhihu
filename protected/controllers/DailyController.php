<?php

class DailyController extends Controller
{
	public $layout = '//layouts/daily';

	public function actionTestApi()
	{
		$service = new ApiService();
		$service->getLatestArticle();
	}
}