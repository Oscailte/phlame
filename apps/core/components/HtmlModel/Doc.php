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
	protected $_js;

	public function __construct(array $properties = null) {
		//$this->assets->useImplicitOutput(false);
		$this->_css = new Sequence();
		$this->_js = new Sequence();
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
			->getChild('metaitems')
			->appendChild(array(
				'tagname' => 'meta',
				'attributes' => $meta
			), $name);
		return $this;
	}

	public function setImport($name, $import) {
		$attributes = array(
			'rel' => 'import',
			'href' => $this->url->get($import)
		);
		$this->getTag()
			->getChild('html')
			->getChild('head')
			->getChild('importitems')
			->appendChild(array(
				'tagname' => 'link',
				'tagSelfClose' => true,
				'attributes' => $attributes
			), $name);
		return $this;
	}
		
	public function registerCss($name, $src, $enable = false, array $require = array()) {
		$this->_css[$name] = array(
			'name' => $name,
			'src' => $src,
			'enable' => $enable,
			'require' => $require
		);
		return $this;
	}

	public function registerJs($name, $src, $enable = false, array $require = array(), $footer = false) {
		$this->_js[$name] = array(
			'name' => $name,
			'src' => $src,
			'footer' => $footer,
			'enable' => $enable,
			'require' => $require
		);
		return $this;
	}

	public function enableCss($name) {
		$this->_css->enable($name);
		return $this;
	}

	public function enableJs($name) {
		$this->_js->enable($name);
		return $this;
	}
	
	public function compileAssets() {
		//$this->di->assets = new \Phalcon\Assets\Manager();
		
		// Tell the assets manager not to output
		$this->assets->useImplicitOutput(false);
		
		// Create the footer js collection		
		$this->assets->collection('jsfooter');
		
		// Compile CSS into the assets manager
		foreach ($this->_css as $css) {
			if ($css['enable']) {
				$type = $this->assetType($css['src']);
				if ($type == 'inline') {
					$this->assets->addInlineCss($css['src']);
				} else {
					$this->assets->addCss($css['src'], ($type == 'local'));
				}
			}
		}

		// Compile JS into the assets manager
		foreach ($this->_js as $js) {
			if ($js['enable']) {
				$type = $this->assetType($js['src']);
				if ($type == 'inline') {
					$this->assets->addInlineJs($js['src']);
				} elseif ($js['footer']) {
					$this->assets->collection('jsfooter')->addJs($js['src'], ($type == 'local'));
				} else {
					$this->assets->addJs($js['src'], ($type == 'local'));
				}
			}
		}

		return $this;
	}
	
	public function assetType($src) {
		if (Text::startsWith($src, 'http')) return 'remote';
		if (Text::startsWith($src, 'files/')) return 'local';
		return 'inline';
	}
	
	public function getContent() {
		$this->compileAssets();
		return parent::getContent();
	}

}
