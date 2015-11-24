<?php

namespace Phlame\Core\Components\HtmlTag;

class Footeritems extends HtmlTag {

	protected $_tagName = 'footeritems';
	protected $_tagDisplay = false;
	//protected $_tagSelfClose = false;
	//protected $_eol = true;
	//protected $_attributes = array();
	//protected $_children;
	
	public function getChildren() {
		return array(
			$this->assets->outputInlineJs(),
			$this->assets->outputJs('jsfooter')
		);
	}
	
}
