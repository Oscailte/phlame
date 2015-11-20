<?php

/*
 * The HtmlModel components represent HTML objects
 * 
 * They should have an understanding of the structure and
 * combination of the tags
 * 
 * They can use the HtmlTag components
 * 
 * NOTE - I may need to have a _children or _tags
 *      - Perhaps a decorator pattern
 * 
*/

namespace Phlame\Core\Components\HtmlModel;

use Phlame\Core\Components\HtmlTag\HtmlTag;

use \Phalcon\Mvc\User\Component;
use \Phalcon\Text;
use \Phalcon\Registry;

class HtmlModel extends Component {

	public $_tag;

	public static function factory(array $properties = null) {
		$classname = __CLASS__;
		if (!empty($properties['tagname'])) {
			$cname = __NAMESPACE__.'\\'.Text::camelize($properties['tagname']);
			if (class_exists($cname)) {
				$classname = $cname;
			}
		}
		return new $classname($properties);
	}

	public function __construct(array $properties = null) {
		$this->setProperties($this->getDefault());
		if ($properties)
			$this->setProperties($properties);
	}

	public function getDefault() {
		return array();
	}

	public function setProperties($properties) {
		foreach ($properties as $property => $value) {
			$this->setProperty($property, $value);
		}
		return $this;
	}

	public function setProperty($property, $value) {
		$method_name = 'set'.Text::camelize($property);
		$this->{$method_name}($value);
		return $this;
	}

	public function setTag($tag) {
		//echo 'SET TAG:'.$tag.'<br/>';
		$this->_tag = $tag;
		return $this;
	}

	public function getTag() {
		return $this->_tag;
	}

	public function getContent() {
		//echo 'TAG:'.$this->_tag.'<br/>';
		if (!empty($this->_tag)) {
			return $this->_tag->getContent();
		}
	}

	public function __tostring() {
		return $this->getContent();
	}

}
