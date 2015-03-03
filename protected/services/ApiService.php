<?php

class ApiService
{
	private $apiUrl = 'http://news-at.zhihu.com/api/3/news/';

	private function generalCurl($urlSuffix)
	{	
		$url = $this->apiUrl.$urlSuffix;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		$output = curl_exec($curl);
		if(curl_errno($curl))
		{
			echo 'Errno: '.curl_error($curl);
		}
		curl_close($curl);
		return json_decode($output, true);
	}

	public function downloadArticle($articleId)
	{	
		return $this->generalCurl($articleId);
	}

	public function batchDownload($articleIds = array())
	{
		if(!is_array($articleIds))
			return false;

		$articlesList = array();

		foreach($articleIds as $articleId)
		{
			$articlesList[] = $this->downloadArticle($articleId);
		}

		return $articlesList;
	}

	public function getLatestArticles()
	{
		$urlSuffix = 'latest';
		return $this->generalCurl($urlSuffix);
	}

	public function getHotArticles()
	{
		$urlSuffix = 'hot';
		return $this->generalCurl($urlSuffix);
	}

	public function getBeforeArticles($date)
	{
		$urlSuffix = 'before/'.$date;
		return $this->generalCurl($urlSuffix);
	}
}