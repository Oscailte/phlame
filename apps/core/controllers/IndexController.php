<?php

namespace Phlame\Core\Controllers;
//use \Phlame\Core\Components\Html\Html;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
		echo '<hr />';
		//echo 'Index';
		//$this->tag->setDocType(\Phalcon\Tag::XHTML11);
		//var_dump ($this->html);
		//$html = new Html();
		//echo $this->htmlDoc->test;
		//echo '<br />';
		//$this->htmlDoc->test = 'hi<br />';
		//echo $this->htmlDoc->test;
		
		//$test = new \Phlame\Core\Components\Test();
		//$doc = $test->getHtml();
		
		$doc = $this->htmlDoc;
		//$doc->html->head->setTitleSeparator = '*';
		$doc->getDocType()->setDocType(\Phalcon\Tag::XHTML20);
		$doc->getHtml()->setAttribute('lang', 'en');
		$doc->getHtml()->getHead()->getTitle()->setTitle('Test Page');
		$doc->getHtml()->getHead()->addMeta(array(
			'charset' => 'utf-8'
		));
		$doc->getHtml()->getHead()->addMeta(array(
			'http-equiv' => 'Content-Type',
			'content' => 'text/html; charset=utf-8'
		));
		$doc->getHtml()->getHead()->addMeta(array(
			'http-equiv' => 'X-UA-Compatible',
			'content' => 'IE=edge'
		));
		$doc->getHtml()->getHead()->addMeta(array(
			'name' => 'keywords',
			'content' => 'php, phalcon'
		));
		$doc->getHtml()->getHead()->addStylesheet('http://www.google.com/styles.css');
		$doc->getHtml()->getHead()->addStylesheet('styles/local.css');
		$doc->getHtml()->getHead()->addJavascript('http://www.google.com/script.js');
		$doc->getHtml()->getHead()->addJavascript('scripts/local.js');

		echo '<pre><code>';
		echo htmlentities($doc);
		echo '</code></pre>';
		
		//echo $doc->tagName.'<br/>';
		//echo $doc->html->tagName.'<br/>';
		//echo $test->getHtml();
		
		//$this->dumpInfo();
    }
    
    public function aAction() {
		$this->dumpInfo();
	}

	public function bAction() {
		//var_dump($this->htmlDoc->getHtml());
		
		$this->htmlDoc->setTitle('Test Page');
		$this->htmlDoc->addMeta(array(
			'http-equiv' => 'Content-Type',
			'content' => 'text/html; charset=utf-8'
		));
		//$this->htmlDoc->getHtml()->getHead()->addTitle();
		//$this->htmlDoc->getHtml()->getHead()->getTitle()->setTitle('test app');
		$this->htmlDoc->addMeta(array(
			'name' => 'tags',
			'content' => 'phalcon, phlame, php'
		));
		$this->htmlDoc->addJavascript('js/local.js');
		$this->htmlDoc->addStylesheet('css/local.css');

		//var_dump ($this->htmlDoc->getHtml()->getHead()->getChildren());
		//echo '<pre>';
		//print_r ($this->htmlDoc->getContent());
		//echo '</pre>';
		
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
