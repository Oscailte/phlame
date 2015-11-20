<?php

namespace Phlame\Core\Components\HtmlModel;

use Phlame\Core\Components\HtmlTag\HtmlTag;
//use Phlame\Core\Components\HtmlTag\Doc;

use \Phalcon\Mvc\User\Component;
use \Phalcon\Text;
use \Phalcon\Registry;

//use Phlame\Core\Components\Traits\Sequence;
use Phlame\Core\Components\Utils\Sequence;

class Doc extends HtmlModel {

	//use Sequence;

	protected $_css;

	public function __construct(array $properties = null) {
		$this->assets->useImplicitOutput(false);
		$this->_css = new Sequence();
		parent::__construct();
	}

	public function getDefault() {
		return array(
			'tag' => new \Phlame\Core\Components\HtmlTag\Doc()
		);
	}
	
	public function setTitle($title) {
		$this->tag->setTitle($title);
		return $this;
	}
	
	public function setDocType($doctype) {
		$this->tag->setDocType($doctype);
		return $this;
	}
	
	public function setLang($lang) {
		$this->getTag()->getChild('html')->setAttribute('lang', $lang);
		return $this;
	}
	
	public function setMeta($name, array $meta) {
		$this->getTag()
			->getChild('html')
			->getChild('head')
			->getChild('meta')
			->appendChild(array(
				'tagname' => 'meta',
				'attributes' => $meta
			), $name);
		return $this;
	}
	
	public function registerCss($name, $src, $use = false, array $require = array()) {
		//echo 'adding '.$name.'<br/>';
		$this->_css[$name] = array(
		//$this->_css->items[$name] = array(
			'name' => $name,
			'src' => $src,
			'use' => $use,
			'require' => $require
		);
		//$this->_css->sort();
		//if ($use || in_array($name, $this->_cssrequired)) {
		//	$this->useCss($name);
		//}
		//$this->_cssrequired += $require;
		//var_dump ($this->_cssrequired);
		return $this;
	}
	
	public function getCss($name = null) {
		if ($name) {
			return $this->_css->$name;
		} else {
			$result = array();
			//$this->_css->sort();
			//$this->_css->sort();
			foreach ($this->_css as $css) {
				$result[] = $css['name'];
			}
			return $result;
		}
	}
	
	public function useCss($name) {
		
		if (array_key_exists($name, $this->_css)) {
			$css = $this->_css[$name];
			if (!$css['use']) {
				$css['use'] = true;
				$this->_css[$name] = $css;
			}
			foreach ($css['require'] as $r) {
				if (!in_array($r, $this->_cssrequired)) {
					array_unshift($this->_cssrequired, $r);
				}
				$this->useCss($r);
			}
		}
		return $this;
	}
	
	public function getContent() {
		//foreach ($this->_css as $name => $css) {
		//	if (!empty($css['use'])) {
		//		if (!empty($css['require'])) {
		//			foreach ($css['require'] as $require) {
		//			}
		//		}
		//	}
		//}
		return parent::getContent();
	}

}
