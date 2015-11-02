<?php

namespace Phlame\Core\Components\Html;

use \Phalcon\Mvc\User\Component;
use \Phalcon\Text;
use \Phalcon\Registry;

abstract class Base extends Component {

	protected $_tagName = null;
	protected $_useTag = true;
	protected $_attributes = array();
	protected $_selfClose = false;
	protected $_eol = true;
	protected $_children;

	public function __construct($attributes = array(), $properties = array()) {
		$this->_children = new Registry();
		if ($this->_useTag && !$this->_tagName) {
			$this->_tagName = strtolower((new \ReflectionClass($this))->getShortName());
		}
		$this->setAttributes($attributes);
		$this->setProperties($properties);
	}

	public function setAttributes($attributes) {
		$this->_attributes = $attributes;
	}

	public function setProperties($properties) {
		foreach ($properties as $property => $value) {
			$this->setProperty($property, $value);
		}
	}

	public function setProperty($property, $value) {
		$method_name = 'set'.Text::camelize($property);
		return $this->{$method_name}($value);
	}

	public function setAttribute($attribute, $value) {
		$this->_attributes[$attribute] = $value;
	}

	public function getAttribute($attribute) {
		return $this->_attributes[$attribute];
	}

	public function getEol() {
		return $this->_eol;
	}

	public function printEol() {
		if ($this->_eol) return "\n";
	}

	public function addChild($child, $name = null) {
		//echo 'name:'.$name.'<br/>';
		if (!$name) $name = strval(count($this->getChildren()));
		//echo 'using name:'.$name.'<br/>';
		$this->_children[$name] = $child;
	}

	public function getChildren() {
		return $this->_children;
	}

	public function getChild($name) {
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
		if (substr($src, -1) != $this->printEol()) {
			$src .= $this->printEol();
		}
		return $src;
	}

	public function getContent() {
		$src = '';
		if ($this->_useTag) {
			$src .= $this->tag->tagHtml(
				$this->_tagName,
				$this->_attributes,
				$this->_selfClose,
				true,
				$this->_eol
			);
		}
		if (!$this->_selfClose) {
			$src .= $this->printChildren();
		}
		if (!$this->_selfClose & $this->_useTag) {
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
