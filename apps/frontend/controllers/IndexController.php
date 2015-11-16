<?php

namespace Phlame\Frontend\Controllers;

use Phalcon\Events\Manager as EventsManager;
use Phlame\Core\Components\Store\Store;
use Phlame\Core\Components\Store\StoreListener;
use Phlame\Core\Components\Html\Tag;

class IndexController extends ControllerHtml
{

    public function indexAction()
    {

		// Create the store instance
		$store   = new Store();

		// Bind the eventsManager to the instance
		$store->setEventsManager($this->eventsManager);

		// Attach the listener to the EventsManager
		$this->eventsManager->attach('store', new StoreListener());

		// Execute methods in the component
		//$store->someTask();

		//$this->view->enable();
		//echo '<br/>index - polymer test<br/>';
		$this->htmlDoc->setTitle('Phlame01 Test');
		$this->htmlDoc->getBody()->appendChild('Here is my test');
		//$this->dumpInfo();

		//$this->view->disable();
		$this->response->setContent($this->htmlDoc);
		return $this->response;
		
    }
    
    public function aAction()
    {
		$this->dumpInfo();
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
