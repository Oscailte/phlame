<?php

namespace Phlame\Core\Components\Bootstrap;

use \Phlame\Core\Components\Html\Base;

class Navbar extends Base
{

	protected $_tagName = 'nav';

	public function __construct() {
		
		parent::__construct();
		
		//$this->setAttribute('class', 'navbar navbar-default');
		$this->setAttribute('class', 'navbar navbar-inverse navbar-fixed-top');
		
		$container_fluid = new Base(array('class' => 'container-fluid'), array(), 'div');
		$this->appendChild($container_fluid, 'container-fluid');
		
		$navbar_header = new Base(array('class' => 'navbar-header'), array(), 'div');
		$container_fluid->appendChild($navbar_header, 'navbar-header');
		
		$navbar_brand = new Base(array('class' => 'navbar-brand', 'href' => '#'), array(), 'a');
		$navbar_brand->appendChild('Phlame');
		$navbar_header->appendChild($navbar_brand, 'navbar-brand');
		
		$navbar_collapse = new Base(array('class' => 'collapse navbar-collapse'), array(), 'div');
		$container_fluid->appendChild($navbar_collapse, 'navbar-collapse');
		
		$navbar_nav = new Base(array('class' => 'nav navbar-nav'), array(), 'ul');
		$navbar_collapse->appendChild($navbar_nav, 'navbar-nav');
		
		$navbar_nav_li = new Base(array('class' => 'active'), array(), 'li');
		$navbar_nav_a = new Base(array('href' => '#'), array(), 'a');
		$navbar_nav_a->appendChild('Link 1');
		$navbar_nav_li->appendChild($navbar_nav_a);
		$navbar_nav->appendChild($navbar_nav_li);

		$navbar_nav_li = new Base(array(), array(), 'li');
		$navbar_nav_a = new Base(array('href' => '#'), array(), 'a');
		$navbar_nav_a->appendChild('Link 2');
		$navbar_nav_li->appendChild($navbar_nav_a);
		$navbar_nav->appendChild($navbar_nav_li);

		
		//$this->appendChild(new Body(), 'body');
	}

	//public function printChildren()
	//{
		//return $this->escaper->escapeHtml('body <content');
	//}

	//public function addJavascript($url) {
	//	$javascript = new Javascript();
	//	$javascript->setUrl($url);
	//	$this->appendChild($javascript);
	//}

}
