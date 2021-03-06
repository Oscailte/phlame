<?php

/*
 * The HtmlTag components represent HTML tags only
 * 
 * They should not be concerned with the meaning or structure
 * of the combination of the tags
 * 
*/

namespace Phlame\Core\Components\HtmlTag;

use \Phalcon\Mvc\User\Component;
use \Phalcon\Text;
use \Phalcon\Registry;

class HtmlTag extends Component {

	protected $_tagName = null;
	protected $_tagDisplay = true;
	protected $_tagSelfClose = false;
	protected $_eol = true;
	protected $_attributes = array();
	protected $_children = array();
	protected $_parent = null;

	public static function factory(array $properties = null, HtmlTag $parent = null) {
		$classname = __CLASS__;
		if (!empty($properties['tagname'])) {
			$cname = __NAMESPACE__.'\\'.Text::camelize($properties['tagname']);
			if (class_exists($cname)) {
				$classname = $cname;
			}
		}
		return new $classname($properties, $parent);
	}

	public function __construct(array $properties = null, HtmlTag $parent = null) {
		$this->setProperties($this->getDefault());
		//if ($tagName) {
		//	$this->_tagName = $tagName;
		//}
		//if ($this->_tagDisplay && !$this->_tagName) {
			//$this->_tagName = strtolower((new \ReflectionClass($this))->getShortName());
		//}
		if ($properties)
			$this->setProperties($properties);
		if ($parent)
			$this->setParent($parent);
	}

	public function getDefault() {
		return array();
	}

	public function setAttributes($attributes) {
		$this->_attributes = $attributes;
		return $this;
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

	public function getRoot() {
		$parent = $this->getParent();
		if (!$parent) {
			return $this;
		} else {
			return $parent->getParent();
		}
	}

	public function setParent($parent) {
		$this->_parent = $parent;
		return $this;
	}

	public function getParent() {
		return $this->_parent;
	}

	public function setTagName($tagName) {
		$this->_tagName = $tagName;
		return $this;
	}

	public function getTagName() {
		return $this->_tagName;
	}

	public function setTagDisplay($tagDisplay) {
		$this->_tagDisplay = $tagDisplay;
		return $this;
	}

	public function setTagSelfClose($tagSelfClose) {
		$this->_tagSelfClose = $tagSelfClose;
		return $this;
	}

	public function setAttribute($attribute, $value) {
		$this->_attributes[$attribute] = $value;
		return $this;
	}

	public function getAttribute($attribute) {
		return $this->_attributes[$attribute];
	}

	public function getEol() {
		return $this->_eol;
	}

	//public function printEol() {
	//	if ($this->_eol) return "\n";
	//}

	public function prependChild($child, $name = null) {
		if (is_array($child)) {
			array_unshift($this->_children, HtmlTag::factory($child, $name));
		} else {
			array_unshift($this->_children, $child);
		}
		return $this;
	}

	public function appendChild($child, $name = null) {
		//if (!is_string($name)) $name = strval(count($this->getChildren()));
		if (is_array($child)) {
			//$this->_children[$name] = new Tag($child);
			$this->_children[$name] = HtmlTag::factory($child, $this);
		} else {
			$this->_children[$name] = $child;
		}
		return $this;
	}

	public function setChildren($children) {
		return $this->appendChildren($children);
	}

	public function appendChildren($children) {
		foreach ($children as $name => $child) {
			$this->appendChild($child, $name);
		}
		return $this;
	}

	public function getChildren() {
		return $this->_children;
	}

	public function getChild($name) {
		if (is_array($name)) {
			$child = $this->_children[array_shift($name)];
			if (!empty($name)) {
				return $child->getChild($name);
			}
			return $child;
		}
		return $this->_children[$name];
	}

	public function printChildren() {
		$src = '';
		foreach ($this->getChildren() as $child) {
			if (is_array($child)) {
				foreach ($child as $cc) {
					$src .= $cc;
				}
			} else {
				$src .= $child;
			}
		};
		//if (substr($src, -1) != $this->printEol()) {
		//	$src .= $this->printEol();
		//}
		return $src;
	}

	public function getContent() {
		$src = '';
		if ($this->_tagName && $this->_tagDisplay) {
			$src .= $this->tag->tagHtml(
				$this->_tagName,
				$this->_attributes,
				$this->_tagSelfClose,
				true,
				$this->_eol
			);
		}
		if (!$this->_tagSelfClose) {
			$src .= $this->printChildren();
		}
		if ($this->_tagName && $this->_tagDisplay && !$this->_tagSelfClose) {
			$src .= $this->tag->tagHtmlClose(
				$this->_tagName,
				$this->_eol
			);
		}
		return $src;
	}

	public function __tostring() {
		return $this->getContent();
	}

}
