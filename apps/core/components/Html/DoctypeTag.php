<?php

namespace Phlame\Core\Components\Html;

use \Phalcon\Mvc\User\Component;
use \Phalcon\Text;
use \Phalcon\Registry;

class DoctypeTag extends Tag {

	protected $_tagName = 'doctype';
	protected $_tagDisplay = false;
	//protected $_tagSelfClose = false;
	
	//protected $_eol = true;
	
	//protected $_attributes = array(
	//	'class' => 'navbar navbar-inverse navbar-fixed-top'
	//);
	//protected $_children;
	
	public function getChildren() {
		return array($this->tag->getDocType());
	}
	
}
