<?php

namespace Phlame\Core\Components\Html;

use \Phalcon\Registry;

class Head extends Base {

	public function __construct() {
		parent::__construct();
		$this->addChild(new Title, 'title');
	}

	public function addMeta($attributes = array()) {
		$this->addChild(new Meta($attributes));
	}

	public function addStylesheet($url) {
		$this->assets->addCss($url);
		//$stylesheet = new Stylesheet();
		//$stylesheet->setUrl($url);
		//$this->addChild($stylesheet);
	}

	public function addJavascript($url) {
		$javascript = new Javascript();
		$javascript->setUrl($url);
		$this->addChild($javascript);
	}

	public function getTitle() {
		return $this->getChild('title');
	}

	public function printChildren() {
		$this->assets->useImplicitOutput(false);
		$src = parent::printChildren();
		$src .= $this->assets->outputCss();
		$src .= $this->assets->outputJs();
		return $src;
	}

}
