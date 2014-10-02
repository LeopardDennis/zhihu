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
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		$output = curl_exec($curl);
		if(curl_errno($curl))
		{
			echo 'Errno: '.curl_error($curl);
		}
		curl_close($curl);
		return $output;
	}

	public function downloadArticle($articleId)
	{	
		$this->generalCurl($articleId);
	}

	public function batchDownload($articleIds = array())
	{	
		if(!is_array($articleIds))
			return false;

		foreach($articleIds as $articleId)
		{
			$this->downloadArticle($articleId);
		}
	}

	public function getLatestArticle()
	{
		$urlSuffix = 'latest';
		$this->generalCurl($urlSuffix);
	}

	public function getHotArticle()
	{
		$urlSuffix = 'hot';
		$this->generalCurl($urlSuffix);
	}
}