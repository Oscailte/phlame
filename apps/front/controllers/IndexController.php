<?php

namespace Phlame\Front\Controllers;

use Phalcon\Events\Manager as EventsManager;
use Phlame\Core\Components\Store\Store;
use Phlame\Core\Components\Store\StoreListener;

//use Phlame\Core\Components\HtmlTag\Doc;
use Phlame\Core\Components\HtmlModel\HtmlModel;
use Phlame\Core\Components\HtmlModel\Doc;

class IndexController extends ControllerHtml
{

	public function indexAction()
	{

		//$this->tag->setTitle('testing');
		//$item = new Doc();
		$item = new Doc();
		//var_dump ($item);
		$item->setTitle('test 1 2 3');
		//$item->setDocType(\Phalcon\Tag::HTML401_STRICT);
		$item->setLang('de');
		$item->setMeta('charset', array('charset' =>'utf-8'));
		$item->setMeta('contenttype', array('http-equiv' => 'Content-Type', 'content' => 'text/html'));
		$item->setMeta('x_ua_compatible', array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge'));
		$item->setMeta('viewport', array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'));
		
		$item->registerCss('test', 'href-test', true, array('bootstrap'));
		$item->registerCss('test2', 'href-test2', true, array('bootstrap', 'test'));
		$item->registerCss('bootstrap', 'href-bootstrap', false, array('base'));
		$item->registerCss('base', 'href-base');
		
		//$item->useCss('test');
		echo '<hr/>';
		
		//$sequence = new \Phlame\Core\Components\Utils\Sequence();
		//$sequence->insert(array('B' => array('value' => 'B', 'after' => array('A'))));
		//$sequence->insert(array('C' => array('value' => 'C', 'after' => array('A'))));
		//$sequence->insert(array('A' => array('value' => 'A', 'after' => array())));
		
		//echo '<pre>';
		//while (!$sequence->isEmpty()) {
		//	$i = $sequence->extract();
		//	echo key($i).'<br/>';
		//}
		
		//foreach ($sequence as $s) {
		//	echo key($s).'<br/>';
		//}
		//var_dump ($sequence);
		//echo '</pre>';
		
		echo '<hr/>';
		//$item->addBefore('three', 'three');
		//$item->addBefore('two', 'two', array('three'));
		//$item->addBefore('one', 'one', array('two'));
		//var_dump($item->sequence);
		
		echo '<pre>';
		
		var_dump ($item->getCss());
		echo '</pre>';
		
		//var_dump($item->getTag()->getChild('html')->getChild('head')->getRoot()->getTagName());
		//$item->getTag()->getChild('html')->getChild('head')->prependChild(array('tagname'=>'test'));
		
		//var_dump ($doctag->getChild('html')->setAttribute('lang', 'gb'));
		echo '<pre><code>'.htmlentities($item).'</code></pre>';
		
		//////////
		
		echo 'front index index';

		// Create the store instance
		//$store   = new Store();

		// Bind the eventsManager to the instance
		//$store->setEventsManager($this->eventsManager);

		// Attach the listener to the EventsManager
		//$this->eventsManager->attach('store', new StoreListener());

		// Execute methods in the component
		//$store->someTask();

	}

}
