<?php

namespace Phlame\Core\Components\HtmlTag;

class Title extends HtmlTag {

	protected $_tagName = 'title';
	protected $_tagDisplay = false;
	//protected $_tagSelfClose = false;
	//protected $_eol = true;
	//protected $_attributes = array();
	//protected $_children;
	
	public function getChildren() {
		return array($this->tag->getTitle());
	}
	
}
