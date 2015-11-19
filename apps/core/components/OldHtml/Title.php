<?php

namespace Phlame\Core\Components\Html;

class Title extends Base {

	protected $_useTag = false;

	public function setTitle($title) {
		$this->tag->setTitle($title);
	}

	public function getTitle() {
		return $this->tag->getTitle();
	}

	public function getContent() {
		return $this->getTitle();
	}

}
