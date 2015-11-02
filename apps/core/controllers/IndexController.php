<?php

namespace Phlame\Core\Controllers;

use \Phlame\Core\Components\Bootstrap\Navbar;
use \Phlame\Core\Components\Html\Tag;
use \Phlame\Core\Components\Html\NavbarTag;

class IndexController extends ControllerBase
{
    
    public function testAction() {
		$this->dumpInfo();
	}

	public function indexAction() {
		
		$this->htmlDoc->setTitle('Phlame Framework');
		$this->htmlDoc->getHtml()->setAttribute('lang', 'en');
		$this->htmlDoc->addMeta(array(
			'charset' => 'utf-8'
		));
		$this->htmlDoc->addMeta(array(
			'http-equiv' => 'X-UA-Compatible',
			'content' => 'IE=edge'
		));
		$this->htmlDoc->addMeta(array(
			'name' => 'viewport',
			'content' => 'width=device-width, initial-scale=1'
		));
		
		$this->htmlDoc->addJavascript('files/jquery/js/jquery.min.js');
		$this->htmlDoc->addStylesheet('files/bootstrap/css/bootstrap.min.css');
		$this->htmlDoc->addJavascript('files/bootstrap/js/bootstrap.min.js');
		
		$navbar = new NavbarTag();
		
		$brand = $navbar->getChild(array('container', 'header', 'brand'));
		$brand->setChildren(array('Phlame Framework'));
		$brand->setAttribute('href', '#?id=2');
		
		$link_a = $navbar->getChild(array('container', 'collapse', 'nav', 'link_li_1', 'link_a_1'));
		$link_a->setChildren(array('First Link'))->setAttribute('href', 'http://www.google.com');
		
		
		$this->htmlDoc->getBody()->appendChild($navbar);
		
		$tag = new Tag(array(
			'tagName' => 'div',
			'attributes' => array(
				'class' => 'my-class',
				'id' => 'my-id'
			),
			'children' => array(
				array(
					'tagName' => 'p',
					'children' => array('text1')
				),
				'secondp' => array(
					'tagName' => 'p',
					'children' => array('text2')
				),
				array(
					'tagName' => 'p',
					'children' => array('text3')
				)
			)
		));
		$tag->getChild('secondp')->setAttribute('class', 'bold');
		$this->htmlDoc->getBody()->appendChild($tag);
		
		for ($i=1; $i<=50; $i++) {
			$this->htmlDoc->getBody()->appendChild('<p>Testing 1 2 3</p>');
		}
		
		$this->response->setContent($this->htmlDoc);
	}

	private function dumpInfo() {
		
		echo '<hr/>';
		echo 'Namespace: '.$this->dispatcher->getNamespaceName().'<br/>';
		echo 'Module: '.$this->dispatcher->getModuleName().'<br/>';
		echo 'Controller: '.$this->dispatcher->getControllerName().'<br/>';
		echo 'Action: '.$this->dispatcher->getActionName().'<br/>';
		echo 'Params: ';
		var_dump($this->dispatcher->getParams());
		echo '<br/>';

		echo 'Defaults: <pre>';
		var_dump($this->router->getDefaults());
		echo '</pre><br/>';

		echo 'MatchedRoute: <pre>';
		var_dump($this->router->getMatchedRoute());
		echo '</pre><br/>';
		echo 'RewriteUri: ';
		var_dump($this->router->getRewriteUri());
		echo '<br/>';
		
		echo '$_REQUEST:<br/>';
		echo '<pre>';
		print_r ($_REQUEST);
		echo '</pre>';
		
		echo '$_SERVER:<br/>';
		echo '<pre>';
		print_r ($_SERVER);
		echo '</pre>';
		
    }

}
