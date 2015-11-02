<?php

namespace Phlame\Core\Components\Html;

class Doc extends Base {

	protected $_useTag = false;

	public function __construct() {
		parent::__construct();
		$this->addChild(new DocType(), 'doctype');
		$this->addChild(new Html(), 'html');
	}

	public function getDocType() {
		return $this->getChild('doctype');
	}

	public function getHtml() {
		return $this->getChild('html');
	}

	public function getHead() {
		return $this->getHtml()->getHead();
	}

	public function getBody() {
		return $this->getHtml()->getBody();
	}

	public function setTitle($title) {
		return $this->getHead()->getTitle()->setTitle($title);
	}

	public function addMeta($attributes = array()) {
		return $this->getHead()->addMeta($attributes);
	}

	public function addStylesheet($url) {
		return $this->getHead()->addStylesheet($url);
	}

	public function addJavascript($url) {
		return $this->getHead()->addJavascript($url);
	}

}
