<?php

namespace Phlame\Core\Components\Html;

class DoctypeTag extends Tag {

	protected $_tagName = 'doctype';
	protected $_tagDisplay = false;
	//protected $_tagSelfClose = false;
	//protected $_eol = true;
	//protected $_attributes = array();
	//protected $_children;
	
	public function getChildren() {
		return array($this->tag->getDocType());
	}
	
}
