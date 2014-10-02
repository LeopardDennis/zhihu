<?php

class EClientScript extends CClientScript {
	
	public $cssVersion = 1;
	
	public $scriptVersion = 1;
	
	public function registerCssFile($url,$media=''){
		$url = (strpos($url,'?') === false) ? $url.'?v='.$this->cssVersion : $url.'&v='.$this->cssVersion;
		return parent::registerCssFile($url, $media);
	}
	
	public function registerScriptFile($url,$position=self::POS_HEAD,array $htmlOptions=array()){
		$url = (strpos($url,'?') === false) ? $url.'?v='.$this->scriptVersion : $url.'&v='.$this->scriptVersion;
		return parent::registerScriptFile($url, $position,$htmlOptions);
	}
	
}

