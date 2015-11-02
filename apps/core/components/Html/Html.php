<?php

namespace Phlame\Core\Components\Html;

class Html extends Base {

	public function __construct() {
		parent::__construct();
		$this->appendChild(new Head(), 'head');
		$this->appendChild(new Body(), 'body');
	}

	public function getHead() {
		return $this->getChild('head');
	}

	public function getBody() {
		return $this->getChild('body');
	}

}
