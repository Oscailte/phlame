<?php

namespace Phlame\Core\Components\Html;

use \Phalcon\Text;

class Javascript extends Base {

	protected $_useTag = false;

	private $_url;

	public function setUrl($url) {
		$this->_url = $url;
		//$this->assets->addJs($url, $this->isLocal());
	}

	public function getUrl() {
		return $this->_url;
	}

	public function isLocal() {
		return !Text::startsWith($this->getUrl(), 'http');
	}

	public function getContent() {
		return $this->tag->javascriptInclude($this->getUrl(), $this->isLocal());
	}

}
