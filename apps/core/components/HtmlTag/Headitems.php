<?php

namespace Phlame\Core\Components\HtmlTag;

class Headitems extends HtmlTag {

	protected $_tagName = 'headitems';
	protected $_tagDisplay = false;
	//protected $_tagSelfClose = false;
	//protected $_eol = true;
	//protected $_attributes = array();
	//protected $_children;
	
	public function getChildren() {
		return array(
			$this->assets->outputCss(),
			$this->assets->outputInlineCss(),
			$this->assets->outputJs()
			// imports here
		);
	}
	
}
